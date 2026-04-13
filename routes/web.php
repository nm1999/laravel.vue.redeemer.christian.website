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
        'image' => '/images/1.jpg',
        'body1' => 'Community worship creates space for healing, rest, and renewed vision. When we gather together, we remember that faith is both personal and shared.',
        'body2' => 'This week, discover practical ways to build quiet time, invite prayer into your routines, and serve your neighbors with hope.',
    ],
    [
        'slug' => 'hope-through-service',
        'title' => 'Hope Through Service',
        'excerpt' => 'How serving others shapes our church and brings faith to life in the local neighborhood.',
        'date' => 'April 2, 2026',
        'author' => 'Ministry Team',
        'image' => '/images/2.jpg',
        'body1' => 'Service is more than a one-time activity. It is a rhythm of caring that reflects the heart of our church and connects us with the needs around us.',
        'body2' => 'Join us for our next outreach event and help share support, meals, and encouragement with families in the community.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/3.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/4.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/1.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/2.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/3.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/4.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/1.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/2.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/3.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/4.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/1.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/2.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/3.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
    [
        'slug' => 'living-faith-daily',
        'title' => 'Living Faith Daily',
        'excerpt' => 'Faith is not just a Sunday message. Learn how to carry God’s love into each part of your week.',
        'date' => 'March 25, 2026',
        'author' => 'Youth Leader Maria',
        'image' => '/images/4.jpg',
        'body1' => 'From morning routines to conversations at work, faith grows when we intentionally include gratitude, service, and sincere prayer.',
        'body2' => 'Let these ideas inspire you to take small steps toward generosity, compassion, and spiritual growth this week.',
    ],
];

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/blog', function () use ($posts) {
    return Inertia::render('Blogs', ['posts' => $posts]);
})->name('blog.index');

Route::get('/blog/{slug}', function ($slug) use ($posts) {
    $post = collect($posts)->firstWhere('slug', $slug);

    if (! $post) {
        abort(404);
    }

    return Inertia::render('BlogPost', ['post' => $post]);
})->name('blog.show');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

require __DIR__.'/auth.php';
