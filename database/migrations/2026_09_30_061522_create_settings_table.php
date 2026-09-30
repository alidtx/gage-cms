<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();                 // site_name, contact_email, etc.
            $table->json('value')->nullable();               // Always JSON for flexibility
            $table->string('group')->default('general');     // general|header|footer|seo|social
            $table->string('type')->default('text');         // text|textarea|image|boolean|json
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index('group');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};