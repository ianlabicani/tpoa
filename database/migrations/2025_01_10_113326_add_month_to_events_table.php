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
    Schema::table('events', function (Blueprint $table) {
        $table->unsignedTinyInteger('month')->after('end_date')->nullable()->comment('Month of the event (1=January, 12=December)');
    });
}

public function down()
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn('month');
    });
}

};
