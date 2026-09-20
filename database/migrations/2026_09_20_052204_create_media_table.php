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
         Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('src');
            $table->string('extension')->nullable();
            $table->enum('type', ['image', 'pdf', 'document', 'other'])->nullable();
            $table->nullableMorphs('fileable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
