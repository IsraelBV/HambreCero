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
            $table->string('Nombre');
            $table->string('APaterno');
            $table->string('AMaterno');
            $table->string('CURP');
            $table->string('RFC');
            $table->string('ClaveElector');
            $table->string('IdentificacionMigratoria');
            $table->char('Sexo');
            $table->integer('EstadoNacimientoId');
            $table->string('CiudadNacimiento');
            $table->date('FechaNacimiento');
            $table->integer('GradoEstudiosId');
            $table->integer('ColoniaId');
            $table->string('Calle');
            $table->integer('Manzana');
            $table->integer('NoExt');
            $table->integer('NoInt');
            $table->integer('EstadoId');
            $table->integer('MunicipioId');
            $table->integer('LocalidadId');
            $table->integer('CP');
            $table->string('TelefonoCelular');
            $table->string('TelefonoCasa');
            $table->string('Email');
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
