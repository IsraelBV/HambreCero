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
            $table->boolean('Pregunta_103')->nullable();
            $table->integer('idCentroEntrega')->nullable();
            $table->integer('idPeriodoEntrega')->nullable();
            $table->boolean('idTipoBeneficiario')->nullable();
            $table->integer('comentarioEntrega')->nullable();
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
            $table->dropColumn('Pregunta_103');
            $table->dropColumn('idCentroEntrega');
            $table->dropColumn('idPeriodoEntrega');
            $table->dropColumn('idTipoBeneficiario');
            $table->dropColumn('comentarioEntrega');
        });
    }
}
