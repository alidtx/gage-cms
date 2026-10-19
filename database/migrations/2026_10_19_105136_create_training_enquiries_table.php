<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_enquiries', function (Blueprint $table) {
            $table->id();

            // Programme is required in the form; keep nullable for the general
            // "Not sure which programme fits?" CTA at the bottom of the listing.
            $table->foreignId('programme_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Snapshot the programme name in case the catalogue changes later
            $table->string('programme_label')->nullable();

            $table->string('full_name');
            $table->string('organisation');
            $table->string('email');
            $table->string('phone', 32);

            $table->unsignedSmallInteger('participants')->nullable();

            // on_site | male_weekends | virtual  (see enum below)
            $table->string('delivery_preference', 32)->nullable();

            $table->text('notes')->nullable();
            $table->string('status', 20)->default('new');   // new|contacted|quoted|closed
            $table->string('source_page')->nullable();      // URL for attribution
            $table->ipAddress('submitted_ip')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('programme_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_enquiries');
    }
};