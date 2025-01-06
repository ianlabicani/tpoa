<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();  // Primary key for the event
            $table->string('name');  // Event name
            $table->text('description')->nullable();  // Description of the event
            $table->date('start_date')->nullable();  // Start date of the event
            $table->date('end_date')->nullable();  // End date of the event
            $table->string('image')->nullable();  // Path to event image
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // User who created the event (foreign key)
            $table->timestamps();  // Timestamps for created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
