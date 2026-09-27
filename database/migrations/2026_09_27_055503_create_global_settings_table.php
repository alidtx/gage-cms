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
        Schema::create('global_settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_name')->nullable();
            $table->text('site_description')->nullable();
            $table->text('site_keywords')->nullable();

            $table->foreignId('default_og_image')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->foreignId('default_twitter_image')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_settings');
    }
};
