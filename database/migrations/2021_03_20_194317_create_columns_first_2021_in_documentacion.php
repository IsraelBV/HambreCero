<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnsFirst2021InDocumentacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documentacion', function (Blueprint $table) {
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
        Schema::table('documentacion', function (Blueprint $table) {
            $table->dropColumn('idCentroEntrega');
            $table->dropColumn('idPeriodoEntrega');
        });
    }
}
