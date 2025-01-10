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
            $table->string('service_image')->nullable()->after('service_offer'); // Add this after the 'service_offer' field
        });
    }
    
    public function down()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('service_image');
        });
    }
    
};
