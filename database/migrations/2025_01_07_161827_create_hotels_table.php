<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->decimal('price_per_night', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('cover')->nullable(); // For hotel image
            $table->json('social_media')->nullable(); // JSON field for social media links
            $table->string('services')->nullable(); // Services offered
            $table->boolean('availability')->default(true); // Availability status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
