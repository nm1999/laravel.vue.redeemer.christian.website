<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @php
            $settings = \App\Models\SiteSettings::query()->first(['site_name', 'site_favicon_url']);
            $siteName = $settings?->site_name ?: config('app.name', 'Redeemer Christian Church');
            $siteTitle = $siteName;
            $siteDescription = 'A warm church community for worship, growth, and service. Join Redeemer Christian Church this Sunday.';
            $siteImage = $settings?->site_favicon_url ?: url('/images/logo.jpg');

            if ($settings?->site_favicon_url
                && ! str_starts_with($settings->site_favicon_url, 'http://')
                && ! str_starts_with($settings->site_favicon_url, 'https://')
                && ! str_starts_with($settings->site_favicon_url, '/')) {
                $siteImage = \Illuminate\Support\Facades\Storage::disk('public')->url($settings->site_favicon_url);
            }

            $siteUrl = url()->current();
        @endphp

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="app-name" content="{{ $siteName }}">
        <meta name="description" content="{{ $siteDescription }}">
        <link rel="icon" type="image/png" href="{{ $siteImage }}">

        <link rel="canonical" href="{{ $siteUrl }}">

        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ $siteName }}">
        <meta property="og:title" content="{{ $siteTitle }}">
        <meta property="og:description" content="{{ $siteDescription }}">
        <meta property="og:image" content="{{ $siteImage }}">
        <meta property="og:url" content="{{ $siteUrl }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $siteTitle }}">
        <meta name="twitter:description" content="{{ $siteDescription }}">
        <meta name="twitter:image" content="{{ $siteImage }}">

        <title inertia>{{ $siteName }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        @inertia
    </body>
</html>
