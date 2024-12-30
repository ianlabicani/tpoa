<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('destinations', function (Blueprint $table) {
            // Add columns for day and night images (file paths)
            $table->string('day_images')->nullable();
            $table->string('night_images')->nullable();
        });
    }

    public function down()
    {
        Schema::table('destinations', function (Blueprint $table) {
            // Remove the day and night image columns if the migration is rolled back
            $table->dropColumn(['day_images', 'night_images']);
        });
    }
};
