<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Personas', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre')->nullable();
            $table->string('APaterno')->nullable();
            $table->string('AMaterno')->nullable();
            $table->string('CURP')->nullable();
            $table->string('RFC')->nullable();
            $table->string('ClaveElector')->nullable();
            $table->string('IdentificacionMigratoria')->nullable();
            $table->char('Sexo')->nullable();
            $table->integer('EstadoNacimientoId')->nullable();
            $table->string('CiudadNacimiento')->nullable();
            $table->date('FechaNacimiento')->nullable();
            $table->integer('GradoEstudiosId')->nullable();
            $table->integer('ColoniaId')->nullable();
            $table->string('Calle')->nullable();
            $table->string('Manzana')->nullable();
            $table->string('NoExt')->nullable();
            $table->string('NoInt')->nullable();
            $table->integer('EstadoId')->nullable();
            $table->integer('MunicipioId')->nullable();
            $table->integer('LocalidadId')->nullable();
            $table->integer('CP')->nullable();
            $table->string('TelefonoCelular')->nullable();
            $table->string('TelefonoCasa')->nullable();
            $table->string('Email')->nullable();
            $table->integer('EncuestadorId')->nullable();
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
        Schema::dropIfExists('Personas');
    }
}
