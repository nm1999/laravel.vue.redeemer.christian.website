<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePublicDiskFallback();

        Schema::defaultStringLength(191);
        Vite::prefetch(concurrency: 3);
    }

    private function configurePublicDiskFallback(): void
    {
        $publicStoragePath = public_path('storage');
        $storagePublicPath = storage_path('app/public');

        if (is_link($publicStoragePath)) {
            return;
        }

        if (! is_dir($publicStoragePath)) {
            @mkdir($publicStoragePath, 0755, true);
        }

        config([
            'filesystems.disks.public.root' => $publicStoragePath,
            'filesystems.link_type' => 'copy',
        ]);

        if (! is_dir($storagePublicPath)) {
            return;
        }

        $syncMarker = $publicStoragePath.DIRECTORY_SEPARATOR.'.storage_synced';

        if (is_file($syncMarker)) {
            return;
        }

        try {
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($storagePublicPath, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($iterator as $item) {
                $targetPath = $publicStoragePath.DIRECTORY_SEPARATOR.$iterator->getSubPathName();

                if ($item->isDir()) {
                    if (! is_dir($targetPath)) {
                        @mkdir($targetPath, 0755, true);
                    }

                    continue;
                }

                if (! is_file($targetPath)) {
                    @copy($item->getPathname(), $targetPath);
                }
            }

            @file_put_contents($syncMarker, now()->toDateTimeString());
        } catch (Throwable) {
            // Do not break requests when fallback sync cannot run.
        }
    }
}
