<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_group_id')
                  ->constrained('programme_groups')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->unsignedSmallInteger('number');    // 1..10 — the "01", "02" badge
            $table->string('slug')->unique();          // 'safety-and-emergency-response'
            $table->string('name');                    // 'Safety & Emergency Response'
            $table->text('description')->nullable();   // card / listing intro paragraph

            // Division detail page hero (optional — only division 1 has one today)
            $table->string('hero_image_path')->nullable();
            $table->string('hero_alt')->nullable();

            // "View division" link target; null => enquiry-only
            $table->string('detail_url')->nullable();

            // CTA copy at bottom of division page (optional)
            $table->string('cta_heading')->nullable();
            $table->text('cta_body')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->unique('number');
            $table->index(['programme_group_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};