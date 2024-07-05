<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('flag', function (Blueprint $table) {
            // Remover a chave estrangeira existente
            $table->dropForeign(['grupo_economico_id']);
            
            // Adicionar a chave estrangeira com a deleção em cascata
            $table->foreign('grupo_economico_id')
                ->references('id')->on('economic_groups')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('flag', function (Blueprint $table) {
            // Reverter a alteração se necessário
            $table->dropForeign(['grupo_economico_id']);
            $table->foreign('grupo_economico_id')
                ->references('id')->on('economic_groups');
        });
    }
};
