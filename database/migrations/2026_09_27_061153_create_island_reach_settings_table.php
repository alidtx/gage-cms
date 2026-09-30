<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('island_reach_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('atoll')->nullable();
            $table->text('description')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->enum('location_type', ['island', 'resort', 'city', 'airport', 'harbor', 'other'])
                  ->default('island');
            $table->boolean('is_featured')->default(false);
            $table->string('marker_color', 20)->default('#3388ff');
            $table->string('marker_icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'is_featured']);
            $table->index('atoll');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('island_reach_settings');
    }
};