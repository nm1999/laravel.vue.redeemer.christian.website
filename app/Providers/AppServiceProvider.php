<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
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
        
        // Automatically create storage symlink if it doesn't exist
        $this->createStorageSymlink();
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

    /**
     * Create storage symlink if it does not exist.
     *
     * @return void
     */
    protected function createStorageSymlink(): void
    {
        $publicStoragePath = public_path('storage');
        $storageAppPublicPath = storage_path('app/public');

        // Check if symlink doesn't exist
        if (!file_exists($publicStoragePath) && !is_link($publicStoragePath)) {
            try {
                // Try to create symlink
                Artisan::call('storage:link');
            } catch (\Exception $e) {
                // Silently fail - symlink creation might not be supported on all servers
                // The /storage-link route can be used as fallback
            }
        }
    }
}
