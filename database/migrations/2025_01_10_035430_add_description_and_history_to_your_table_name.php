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
            $table->text('description')->nullable()->after('longitude'); // Add description column
            $table->text('history')->nullable()->after('description');  // Add history column
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
            $table->dropColumn(['description', 'history']);
        });
    }
};
