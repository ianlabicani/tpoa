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
            $table->text('social_media')->nullable()->change();
            $table->text('service_offer')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->string('social_media', 5000)->nullable()->change();
            $table->string('service_offer', 5000)->nullable()->change();
        });
    }
};
