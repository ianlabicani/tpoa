<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToVisitorLogs extends Migration
{
    public function up()
    {
        Schema::table('visitor_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('ip_address');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('visitor_logs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
