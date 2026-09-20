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
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->foreignId('news_category_id')
                ->nullable()
                ->constrained('news_categories')
                ->nullOnDelete();

            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();

            $table->foreignId('featured_image_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->foreignId('author_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('published_at')->nullable();

            $table->enum('status', [
                'draft',
                'published',
                'archived'
            ])->default('draft');

            $table->boolean('is_featured')->default(false);

            /*
    |--------------------------------------------------------------------------
    | Hero
    |--------------------------------------------------------------------------
    */
            $table->string('hero_eyebrow')->nullable();
            $table->string('hero_heading')->nullable();
            $table->text('hero_description')->nullable();

            /*
    |--------------------------------------------------------------------------
    | SEO
    |--------------------------------------------------------------------------
    */
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('canonical_url')->nullable();

            $table->foreignId('og_image_id')
                ->nullable()
                ->constrained('media')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
