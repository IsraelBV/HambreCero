<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentacion', function (Blueprint $table) {
            $table->id();
            $table->integer('PersonaId');
            $table->boolean('CuestionarioCompleto')->nullable();
            $table->boolean('F1SolicitudApoyo')->nullable();
            $table->boolean('Identificacion')->nullable();
            $table->boolean('CURP')->nullable();
            $table->boolean('ComprobanteDomicilio')->nullable();
            $table->boolean('Anexo17')->nullable();
            $table->boolean('Comprobante')->nullable();
            $table->integer('EncuestadorId')->nullable();
            $table->boolean('Donado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentacion');
    }
}
