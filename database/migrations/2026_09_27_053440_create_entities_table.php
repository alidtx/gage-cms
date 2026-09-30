<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();

            // ==== Core identifiers ====
            $table->string('name');                          // GAGE Security
            $table->string('slug')->unique();                // gage-security
            $table->string('category');                      // security|safety|training|retail|consulting|marine
            // ==== Media ====
            $table->foreignId('media_id')->nullable()->constrained('media')->nullOnDelete(); 
            // ==== Display flags ====
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);

            // ==== THE CONTENT (everything in here) ====
            // Holds: hero, about, sections[], programmes, sectors,
            // categories, team, partners, faqs, testimonials, gallery,
            // cta_section, contact
            $table->json('content')->nullable();

            // ==== META / SEO / theme ====
            // Holds: tagline, badge_text, badge_icon, short_description,
            // icon, icon_type, primary_color, secondary_color,
            // meta_title, meta_description, meta_keywords
            $table->json('meta')->nullable();

            // ==== Analytics ====
            // $table->unsignedBigInteger('views')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // ==== Indexes ====
            $table->index(['category', 'is_active']);
            $table->index(['is_active', 'sort_order']);
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};