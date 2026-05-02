<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;

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
        Schema::defaultStringLength(191);
        Vite::prefetch(concurrency: 3);
        
        // Automatically create storage symlink if it doesn't exist
        $this->createStorageSymlink();
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