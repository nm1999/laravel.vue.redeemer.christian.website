<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('whatsapp_number', 30)->nullable()->after('email');
            $table->string('youtube_live_url', 512)->nullable()->after('whatsapp_number');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['whatsapp_number', 'youtube_live_url']);
        });
    }
};
