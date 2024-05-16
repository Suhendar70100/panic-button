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
            $table->string('guid', 20)->unique();
            $table->string('code_block_residential', 20)->nullable();
            $table->string('house_number', 10)->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('access')->default(false);
            $table->timestamps();

            $table->foreign('code_block_residential')->references('code_block')->on('residential_block');
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
