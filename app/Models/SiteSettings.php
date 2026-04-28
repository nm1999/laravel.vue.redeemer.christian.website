<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $fillable = ['mission', 'vision', 'email', 'location', 'whatsapp_number', 'youtube_live_url', 'intro_video_url'];
}
