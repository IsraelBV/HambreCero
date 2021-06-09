<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Encuestas', function (Blueprint $table) {
            $table->id();
            $table->boolean('Pregunta_26')->nullable();
            $table->string('Pregunta_27')->nullable();
            $table->boolean('Pregunta_28')->nullable();
            $table->boolean('Pregunta_29')->nullable();
            $table->integer('Pregunta_30')->nullable();
            $table->boolean('Pregunta_31')->nullable();
            $table->integer('Pregunta_32')->nullable();
            $table->integer('Pregunta_33')->nullable();
            $table->integer('Pregunta_34')->nullable();
            $table->integer('Pregunta_35')->nullable();
            $table->integer('Pregunta_36')->nullable();
            $table->string('Pregunta_37')->nullable();
            $table->integer('Pregunta_38')->nullable();
            $table->boolean('Pregunta_39')->nullable();
            $table->string('Pregunta_40')->nullable();
            $table->integer('Pregunta_41')->nullable();
            $table->boolean('Pregunta_42')->nullable();
            $table->string('Pregunta_43')->nullable();
            $table->integer('Pregunta_44')->nullable();
            $table->integer('Pregunta_45')->nullable();
            $table->integer('Pregunta_46')->nullable();
            $table->boolean('Pregunta_47')->nullable();
            $table->boolean('Pregunta_48')->nullable();
            $table->boolean('Pregunta_49')->nullable();
            $table->boolean('Pregunta_50')->nullable();
            $table->boolean('Pregunta_51')->nullable();
            $table->boolean('Pregunta_52')->nullable();
            $table->boolean('Pregunta_53')->nullable();
            $table->boolean('Pregunta_54')->nullable();
            $table->boolean('Pregunta_55')->nullable();
            $table->boolean('Pregunta_56')->nullable();
            $table->boolean('Pregunta_57')->nullable();
            $table->boolean('Pregunta_58')->nullable();
            $table->string('Pregunta_59')->nullable();
            $table->boolean('Pregunta_60')->nullable();
            $table->boolean('Pregunta_61')->nullable();
            $table->integer('Pregunta_62')->nullable();
            $table->integer('Pregunta_63')->nullable();
            $table->string('Pregunta_64')->nullable();
            $table->boolean('Pregunta_65')->nullable();
            $table->boolean('Pregunta_66')->nullable();
            $table->integer('Pregunta_67')->nullable();
            $table->boolean('Pregunta_68')->nullable();
            $table->integer('Pregunta_69')->nullable();
            $table->boolean('Pregunta_70')->nullable();
            $table->integer('Pregunta_71')->nullable();
            $table->boolean('Pregunta_72')->nullable();
            $table->string('Pregunta_73')->nullable();
            $table->integer('Pregunta_74')->nullable();
            $table->boolean('Pregunta_75')->nullable();
            $table->boolean('Pregunta_76')->nullable();
            $table->string('Pregunta_77')->nullable();
            $table->integer('Pregunta_78')->nullable();
            $table->boolean('Pregunta_79')->nullable();
            $table->boolean('Pregunta_80')->nullable();
            $table->boolean('Pregunta_81')->nullable();
            $table->boolean('Pregunta_82')->nullable();
            $table->boolean('Pregunta_83')->nullable();
            $table->boolean('Pregunta_84')->nullable();
            $table->boolean('Pregunta_85')->nullable();
            $table->boolean('Pregunta_86')->nullable();
            $table->boolean('Pregunta_87')->nullable();
            $table->string('Pregunta_88')->nullable();
            $table->boolean('Pregunta_89')->nullable();
            $table->string('Pregunta_90')->nullable();
            $table->boolean('Pregunta_91')->nullable();
            $table->boolean('Pregunta_92')->nullable();
            $table->boolean('Pregunta_93')->nullable();
            $table->integer('Pregunta_94')->nullable();
            $table->boolean('Pregunta_95')->nullable();
            $table->boolean('Pregunta_96')->nullable();
            $table->string('Pregunta_97')->nullable();
            $table->boolean('Pregunta_98')->nullable();
            $table->boolean('Pregunta_99')->nullable();
            $table->boolean('Pregunta_100')->nullable();
            $table->boolean('Pregunta_101')->nullable();
            $table->boolean('Pregunta_102')->nullable();
            $table->integer('PersonaId');
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
        Schema::dropIfExists('Encuestas');
    }
}
