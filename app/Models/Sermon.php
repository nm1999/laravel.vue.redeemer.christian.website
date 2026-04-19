<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'speaker',
        'preached_at',
        'excerpt',
        'content',
        'video_url',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'preached_at' => 'date',
            'is_published' => 'boolean',
        ];
    }
}
