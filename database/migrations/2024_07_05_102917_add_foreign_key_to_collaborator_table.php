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
        Schema::table('collaborator', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->foreign('unit_id')
                ->references('id')->on('units')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('collaborator', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->foreign('unit_id')
                ->references('id')->on('units');
        });
    }
};
