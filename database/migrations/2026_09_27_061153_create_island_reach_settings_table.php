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
       Schema::create('island_reach_settings', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('atoll')->nullable();
            $table->text('description')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->string('location_type')->nullable();

            $table->boolean('is_featured')->default(false);

            $table->string('marker_color')->nullable();
            $table->string('marker_icon')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('island_reach_settings');
    }
};
