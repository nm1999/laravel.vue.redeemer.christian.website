<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

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
        $this->ensureStorageLink();
    }

    /**
     * Ensure the public/storage symlink exists so uploaded files are accessible.
     * This is called on every request but performs work only when the symlink is missing.
     */
    private function ensureStorageLink(): void
    {
        $publicStorage = public_path('storage');

        // Symlink already exists – nothing to do.
        if (is_link($publicStorage)) {
            return;
        }

        // A real directory exists (e.g. FILESYSTEM_LINK_TYPE=copy mode or pre-created
        // by the server). Files uploaded in copy mode go directly into this directory
        // and are already accessible, so we leave it alone.
        if (is_dir($publicStorage)) {
            return;
        }

        try {
            Artisan::call('storage:link');
        } catch (\Throwable) {
            // Silently ignore on restricted environments; the symlink may be
            // created via the post-install-cmd composer script instead.
        }
    }
}
