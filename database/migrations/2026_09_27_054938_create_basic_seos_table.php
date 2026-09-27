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
        Schema::create('basic_seos', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('keywords')->nullable();

            $table->string('og_title')->nullable();
            $table->string('og_type')->nullable();
            $table->text('og_description')->nullable();

            $table->foreignId('media_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->string('canonical_url')->nullable();

            $table->string('schema_type')->nullable();
            $table->json('custom_schema')->nullable();

            $table->string('twitter_title')->nullable();
            $table->string('twitter_card_type')->nullable();
            $table->text('twitter_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basic_seos');
    }
};
