<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            // Remover a chave estrangeira existente
            $table->dropForeign(['flag_id']);
            
            // Adicionar a chave estrangeira com a deleção em cascata
            $table->foreign('flag_id')
                ->references('id')->on('flag')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            // Reverter a alteração se necessário
            $table->dropForeign(['flag_id']);
            $table->foreign('flag_id')
                ->references('id')->on('flag');
        });
    }
};
