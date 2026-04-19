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
        'request',
        'is_private',
        'status',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'is_private' => 'boolean',
            'reviewed_at' => 'datetime',
        ];
    }
}
