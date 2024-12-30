<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('feedback_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('feedback_id')->constrained()->onDelete('cascade');
            $table->enum('reaction', ['like', 'dislike']); // Reaction type
            $table->timestamps();

            $table->unique(['user_id', 'feedback_id']); // Ensure one reaction per user per feedback
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback_reactions');
    }
};
