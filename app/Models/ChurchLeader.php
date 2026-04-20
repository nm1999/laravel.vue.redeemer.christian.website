<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ChurchLeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'image',
        'bio',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        $url = Storage::disk('public')->url($this->image);
        $path = parse_url($url, PHP_URL_PATH);

        return $path ?: $url;
    }
}
