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
        Schema::create('device', function (Blueprint $table) {
            $table->id();
            $table->string('code_device', 20)->unique();
            $table->unsignedBigInteger('id_residential_block');
            $table->string('owner_device', 20)->nullable();
            $table->string('house_number', 10)->nullable();
            $table->boolean('access')->default(false);
            $table->timestamps();

            $table->foreign('id_residential_block')->references('id')->on('residential_block');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device');
    }
};
