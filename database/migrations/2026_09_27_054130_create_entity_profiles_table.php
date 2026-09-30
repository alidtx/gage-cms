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

    
            $table->string('name');                          // GAGE Security
            $table->string('slug')->unique();                // gage-security
            $table->string('category');                      // security|safety|training|retail|consulting|marine

            // ==== Display flags ====
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);

            $table->json('content')->nullable();
            $table->foreignId('media_id')->nullable()->constrained('media')->nullOnDelete();

            $table->json('meta')->nullable();

            $table->unsignedBigInteger('views')->default(0);

            $table->timestamps();
            $table->softDeletes();

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