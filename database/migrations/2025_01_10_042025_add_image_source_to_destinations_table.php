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
        $table->string('image_source')->nullable()->after('description'); // Add the column after 'description'
    });
}

public function down()
{
    Schema::table('destinations', function (Blueprint $table) {
        $table->dropColumn('image_source');
    });
}

};
