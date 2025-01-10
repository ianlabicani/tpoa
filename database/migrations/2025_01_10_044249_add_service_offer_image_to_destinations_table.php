<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->json('service_offer_image')->nullable(); // Add the new column as JSON type
        });
    }
    
    public function down()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('service_offer_image'); // Drop the column if rolling back
        });
    }
    
};
