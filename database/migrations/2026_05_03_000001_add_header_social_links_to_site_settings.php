<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('facebook_url', 512)->nullable()->after('youtube_live_url');
            $table->string('youtube_url', 512)->nullable()->after('facebook_url');
            $table->string('twitter_url', 512)->nullable()->after('youtube_url');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['facebook_url', 'youtube_url', 'twitter_url']);
        });
    }
};
