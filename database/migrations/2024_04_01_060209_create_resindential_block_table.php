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
        Schema::create('resindential_block', function (Blueprint $table) {
            $table->string('code_block', 20)->primary();
            $table->unsignedBigInteger('id_resindential');
            $table->string('name_block',20);
            $table->timestamps();
        
            $table->foreign('id_resindential')->references('id')->on('resindential');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resindential_block');
    }
};
