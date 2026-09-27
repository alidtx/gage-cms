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
        Schema::create('site_maps', function (Blueprint $table) {
            $table->id();
            $table->string('content_type');
            $table->boolean('include')->default(true);
            $table->decimal('priority', 2, 1)->default(0.5);
            $table->string('change_frequency')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_maps');
    }
};
