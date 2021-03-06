<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacoraColumnsInEntregas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entregas', function (Blueprint $table) {
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
            $table->string('Lote')->nullable();
            $table->string('NoExt')->nullable();
            $table->string('NoInt')->nullable();
            $table->integer('EstadoId')->nullable();
            $table->integer('MunicipioId')->nullable();
            $table->integer('LocalidadId')->nullable();
            $table->integer('CP')->nullable();
            $table->string('TelefonoCelular')->nullable();
            $table->string('TelefonoCasa')->nullable();
            $table->string('Email')->nullable();
            $table->integer('GrupoSocialId')->nullable();
            $table->integer('EstadoCivilId')->nullable();

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
            $table->dropColumn('Nombre');
            $table->dropColumn('APaterno');
            $table->dropColumn('AMaterno');
            $table->dropColumn('CURP');
            $table->dropColumn('RFC');
            $table->dropColumn('ClaveElector');
            $table->dropColumn('IdentificacionMigratoria');
            $table->dropColumn('Sexo');
            $table->dropColumn('EstadoNacimientoId');
            $table->dropColumn('CiudadNacimiento');
            $table->dropColumn('FechaNacimiento');
            $table->dropColumn('GradoEstudiosId');
            $table->dropColumn('ColoniaId');
            $table->dropColumn('Calle');
            $table->dropColumn('Manzana');
            $table->dropColumn('Lote');
            $table->dropColumn('NoExt');
            $table->dropColumn('NoInt');
            $table->dropColumn('EstadoId');
            $table->dropColumn('MunicipioId');
            $table->dropColumn('LocalidadId');
            $table->dropColumn('CP');
            $table->dropColumn('TelefonoCelular');
            $table->dropColumn('TelefonoCasa');
            $table->dropColumn('Email');
            $table->dropColumn('GrupoSocialId');
            $table->dropColumn('EstadoCivilId');

            $table->dropColumn('Pregunta_26');
            $table->dropColumn('Pregunta_27');
            $table->dropColumn('Pregunta_28');
            $table->dropColumn('Pregunta_29');
            $table->dropColumn('Pregunta_30');
            $table->dropColumn('Pregunta_31');
            $table->dropColumn('Pregunta_32');
            $table->dropColumn('Pregunta_33');
            $table->dropColumn('Pregunta_34');
            $table->dropColumn('Pregunta_35');
            $table->dropColumn('Pregunta_36');
            $table->dropColumn('Pregunta_37');
            $table->dropColumn('Pregunta_38');
            $table->dropColumn('Pregunta_39');
            $table->dropColumn('Pregunta_40');
            $table->dropColumn('Pregunta_41');
            $table->dropColumn('Pregunta_42');
            $table->dropColumn('Pregunta_43');
            $table->dropColumn('Pregunta_44');
            $table->dropColumn('Pregunta_45');
            $table->dropColumn('Pregunta_46');
            $table->dropColumn('Pregunta_47');
            $table->dropColumn('Pregunta_48');
            $table->dropColumn('Pregunta_49');
            $table->dropColumn('Pregunta_50');
            $table->dropColumn('Pregunta_51');
            $table->dropColumn('Pregunta_52');
            $table->dropColumn('Pregunta_53');
            $table->dropColumn('Pregunta_54');
            $table->dropColumn('Pregunta_55');
            $table->dropColumn('Pregunta_56');
            $table->dropColumn('Pregunta_57');
            $table->dropColumn('Pregunta_58');
            $table->dropColumn('Pregunta_59');
            $table->dropColumn('Pregunta_60');
            $table->dropColumn('Pregunta_61');
            $table->dropColumn('Pregunta_62');
            $table->dropColumn('Pregunta_63');
            $table->dropColumn('Pregunta_64');
            $table->dropColumn('Pregunta_65');
            $table->dropColumn('Pregunta_66');
            $table->dropColumn('Pregunta_67');
            $table->dropColumn('Pregunta_68');
            $table->dropColumn('Pregunta_69');
            $table->dropColumn('Pregunta_70');
            $table->dropColumn('Pregunta_71');
            $table->dropColumn('Pregunta_72');
            $table->dropColumn('Pregunta_73');
            $table->dropColumn('Pregunta_74');
            $table->dropColumn('Pregunta_75');
            $table->dropColumn('Pregunta_76');
            $table->dropColumn('Pregunta_77');
            $table->dropColumn('Pregunta_78');
            $table->dropColumn('Pregunta_79');
            $table->dropColumn('Pregunta_80');
            $table->dropColumn('Pregunta_81');
            $table->dropColumn('Pregunta_82');
            $table->dropColumn('Pregunta_83');
            $table->dropColumn('Pregunta_84');
            $table->dropColumn('Pregunta_85');
            $table->dropColumn('Pregunta_86');
            $table->dropColumn('Pregunta_87');
            $table->dropColumn('Pregunta_88');
            $table->dropColumn('Pregunta_89');
            $table->dropColumn('Pregunta_90');
            $table->dropColumn('Pregunta_91');
            $table->dropColumn('Pregunta_92');
            $table->dropColumn('Pregunta_93');
            $table->dropColumn('Pregunta_94');
            $table->dropColumn('Pregunta_95');
            $table->dropColumn('Pregunta_96');
            $table->dropColumn('Pregunta_97');
            $table->dropColumn('Pregunta_98');
            $table->dropColumn('Pregunta_99');
            $table->dropColumn('Pregunta_100');
            $table->dropColumn('Pregunta_101');
        });
    }
}
