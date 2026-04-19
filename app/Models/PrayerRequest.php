<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'request_text',
        'is_private',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_private' => 'boolean',
        ];
    }
}
