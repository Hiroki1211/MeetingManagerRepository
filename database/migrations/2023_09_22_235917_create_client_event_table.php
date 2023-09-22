<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_event', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('clients');
            $table->dateTime('start')->nullable();
            $table->integer('register')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_event');
    }
};
