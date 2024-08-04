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
        Schema::create('emergency_report', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_emergency_state');
            $table->text('description');
            $table->timestamps();

            $table->foreign('id_emergency_state')->references('id')->on('emergency_state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_report');
    }
};
