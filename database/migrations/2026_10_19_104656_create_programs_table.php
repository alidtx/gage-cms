<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            // "1.1" → sequence = 1, sub_sequence = 1
            // "1.10" → sequence = 1, sub_sequence = 10
            $table->unsignedSmallInteger('sequence');       // group within division (1..10)
            $table->unsignedSmallInteger('sub_sequence');   // item within group (1..n)

            $table->string('code')->nullable();             // 'SEC 101', 'INV 220', 'OSHA 1994'
            $table->string('title');                        // 'Basic First Aid Training Course'

            // Short metadata shown in the collapsed row:
            //   "1 training day · Max 15", "15–25 participants", "6 hours"
            $table->string('meta_line')->nullable();

            // Pre-lowercased haystack for the live search box
            // (data-search="basic first aid training course")
            $table->text('search_text')->nullable();

            // Where the row links to. Null => scroll to enquiry form.
            $table->string('link_url')->nullable();
            $table->string('link_anchor')->nullable();      // e.g. '#programme-1-1'

            // ---- Expanded detail content (all nullable) ----
            $table->string('duration')->nullable();         // "10 days — 7 at resort, 3 at MNDF"
            $table->string('class_size')->nullable();       // "10 to 15"
            $table->string('prerequisite')->nullable();     // "Basic Fire Awareness Training"
            $table->text('aim')->nullable();
            $table->longText('description')->nullable();
            $table->text('participants')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->unique(['division_id', 'sequence', 'sub_sequence']);
            $table->index(['division_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};