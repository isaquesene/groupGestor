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
        Schema::create('flag', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->unsignedBigInteger('grupo_economico_id');
            $table->timestamps();

            $table->foreign('grupo_economico_id')->references('id')->on('economic_groups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flag');
    }
};
