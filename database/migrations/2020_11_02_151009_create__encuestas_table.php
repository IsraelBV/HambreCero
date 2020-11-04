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
            $table->boolean('Pregunta_26');
            $table->string('Pregunta_27');
            $table->boolean('Pregunta_28');
            $table->boolean('Pregunta_29');
            $table->integer('Pregunta_30');
            $table->boolean('Pregunta_31');
            $table->integer('Pregunta_32');
            $table->integer('Pregunta_33');
            $table->integer('Pregunta_34');
            $table->integer('Pregunta_35');
            $table->integer('Pregunta_36');
            $table->string('Pregunta_37');
            $table->integer('Pregunta_38');
            $table->boolean('Pregunta_39');
            $table->string('Pregunta_40');
            $table->integer('Pregunta_41');
            $table->boolean('Pregunta_42');
            $table->string('Pregunta_43');
            $table->integer('Pregunta_44');
            $table->integer('Pregunta_45');
            $table->integer('Pregunta_46');
            $table->boolean('Pregunta_47');
            $table->boolean('Pregunta_48');
            $table->boolean('Pregunta_49');
            $table->boolean('Pregunta_50');
            $table->boolean('Pregunta_51');
            $table->boolean('Pregunta_52');
            $table->boolean('Pregunta_53');
            $table->boolean('Pregunta_54');
            $table->boolean('Pregunta_55');
            $table->boolean('Pregunta_56');
            $table->boolean('Pregunta_57');
            $table->boolean('Pregunta_58');
            $table->string('Pregunta_59');
            $table->boolean('Pregunta_60');
            $table->boolean('Pregunta_61');
            $table->integer('Pregunta_62');
            $table->integer('Pregunta_63');
            $table->string('Pregunta_64');
            $table->boolean('Pregunta_65');
            $table->boolean('Pregunta_66');
            $table->integer('Pregunta_67');
            $table->boolean('Pregunta_68');
            $table->integer('Pregunta_69');
            $table->boolean('Pregunta_70');
            $table->integer('Pregunta_71');
            $table->boolean('Pregunta_72');
            $table->string('Pregunta_73');
            $table->integer('Pregunta_74');
            $table->boolean('Pregunta_75');
            $table->boolean('Pregunta_76');
            $table->string('Pregunta_77');
            $table->integer('Pregunta_78');
            $table->boolean('Pregunta_79');
            $table->boolean('Pregunta_80');
            $table->boolean('Pregunta_81');
            $table->boolean('Pregunta_82');
            $table->boolean('Pregunta_83');
            $table->boolean('Pregunta_84');
            $table->boolean('Pregunta_85');
            $table->boolean('Pregunta_86');
            $table->boolean('Pregunta_87');
            $table->string('Pregunta_88');
            $table->boolean('Pregunta_89');
            $table->string('Pregunta_90');
            $table->boolean('Pregunta_91');
            $table->boolean('Pregunta_92');
            $table->boolean('Pregunta_93');
            $table->boolean('Pregunta_94');
            $table->boolean('Pregunta_95');
            $table->boolean('Pregunta_96');
            $table->string('Pregunta_97');
            $table->boolean('Pregunta_98');
            $table->boolean('Pregunta_99');
            $table->boolean('Pregunta_100');
            $table->boolean('Pregunta_101');
            $table->integer('PersonaId');
            $table->integer('Intentos');
            $table->integer('EncuestadorId');


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
