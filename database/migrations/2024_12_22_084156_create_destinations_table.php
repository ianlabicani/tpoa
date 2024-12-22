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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('cover')->nullable();
            $table->decimal('entrance_fee', 8, 2)->nullable();
            $table->boolean('availability')->default(true);
            $table->text('service_offer')->nullable();
            $table->text('events')->nullable();
            $table->json('social_media')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
