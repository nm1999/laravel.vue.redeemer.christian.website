<?php
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

$posts = [
    [
        'slug' => 'finding-peace',
        'title' => 'Finding Peace in a Busy World',
        'excerpt' => 'Simple faith practices for calm, purpose, and deep community connection.',
        'date' => 'April 9, 2026',
        'author' => 'Pastor Grace',
        'image' => 'https://images.unsplash.com/photo-1511453801697-181b14f6d7ba?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'Community worship creates space for healing, rest, and renewed vision. When we gather together, we remember that faith is both personal and shared.',
        'body2' => 'This week, discover practical ways to build quiet time, invite prayer into your routines, and serve your neighbors with hope.',
    ],
    [
        'slug' => 'hope-through-service',
        'title' => 'Hope Through Service',
        'excerpt' => 'How serving others shapes our church and brings faith to life in the local neighborhood.',
        'date' => 'April 2, 2026',
        'author' => 'Ministry Team',
        'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'Service is more than a one-time activity. It is a rhythm of caring that reflects the heart of our church and connects us with the needs around us.',
        'body2' => 'Join us for our next outreach event and help share support, meals, and encouragement with families in the community.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => 'https://images.unsplash.com/photo-1483652915605-4aa2c4fc8cda?auto=format&fit=crop&w=1200&q=80',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
];

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/blog', function () use ($posts) {
    return Inertia::render('Blogs', ['posts' => $posts]);
});

Route::get('/blog/{slug}', function ($slug) use ($posts) {
    $post = collect($posts)->firstWhere('slug', $slug);

    if (! $post) {
        abort(404);
    }

    return Inertia::render('BlogPost', ['post' => $post]);
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

require __DIR__.'/auth.php';
