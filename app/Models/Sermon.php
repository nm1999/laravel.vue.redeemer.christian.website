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
        'excerpt',
        'content',
        'image_path',
        'speaker',
        'preached_at',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'preached_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }
}
