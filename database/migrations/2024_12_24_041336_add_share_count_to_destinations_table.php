<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->integer('share_count')->default(0);
        });
    }

    public function down()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('share_count');
        });
    }
};
