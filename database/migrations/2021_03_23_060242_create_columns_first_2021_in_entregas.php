<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnsFirst2021InEntregas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entregas', function (Blueprint $table) {
            $table->boolean('Pregunta_102')->nullable();
            $table->integer('idCentroEntrega')->nullable();
            $table->integer('idPeriodoEntrega')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entregas', function (Blueprint $table) {
            $table->dropColumn('Pregunta_102');
            $table->dropColumn('idCentroEntrega');
            $table->dropColumn('idPeriodoEntrega');
        });
    }
}
