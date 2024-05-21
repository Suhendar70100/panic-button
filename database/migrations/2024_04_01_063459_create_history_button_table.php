<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_button', function (Blueprint $table) {
            $table->id();
            $table->string('guid', 20);
            $table->boolean('state');
            $table->date('date');
            $table->time('time');
            $table->timestamps();

            $table->foreign('guid')->references('guid')->on('device');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_button');
    }
};
