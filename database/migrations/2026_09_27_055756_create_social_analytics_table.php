<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('social_analytics', function (Blueprint $table) {
            $table->id();

            $table->string('author')->nullable();
            $table->string('publisher')->nullable();

            $table->string('facebook_app_id')->nullable();
            $table->string('twitter_site')->nullable();

            $table->string('google_analytics_id')->nullable();
            $table->string('google_tag_manager_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_analytics');
    }
};
