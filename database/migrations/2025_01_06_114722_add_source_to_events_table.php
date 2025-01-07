<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('source', 255)->nullable(); // Add 'source' column
        });
    }
    
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('source'); // Remove 'source' column if rolled back
        });
    }
    
};
