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
        Schema::create('residential_block', function (Blueprint $table) {
            $table->string('code_block', 20)->primary();
            $table->unsignedBigInteger('id_residential')->nullable();
            $table->string('name_block', 20);
            $table->timestamps();
        
            $table->foreign('id_residential')->references('id')->on('residential');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residential_block');
    }
};
