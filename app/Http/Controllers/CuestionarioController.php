<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\C_Pregunta;
use App\Models\C_Alimento;
use App\Models\C_Colonia;
use App\Models\C_Estado;
use App\Models\C_GradoDeEstudio;
use App\Models\C_Municipio;
use App\Models\C_SSInstitucion;
use App\Models\C_TipoDeViolencia;
use App\Models\C_TipoMaterial;
use App\Models\C_Localidad;
use App\Models\Persona;
use App\Models\Encuesta;
use App\Models\C_GrupoSocial;


class CuestionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        // var_dump(C_Localidad::findMany([57,249]));

        Return view('cuestionario.index',[
            'preguntas'=> C_Pregunta::all(),
            'estados'=> C_Estado::all(),
            'alimentos'=> C_Alimento::all(),
            'estudios'=> C_GradoDeEstudio::all(),
            'ss'=> C_SSInstitucion::all(),
            'violencias'=> C_TipoDeViolencia::all(),
            'materiales'=> C_TipoMaterial::all(),
            //'colonias'=> C_Colonia::where("LocalidadId","=", '57')->where("LocalidadId","=", '100')->get(),
            'colonias'=> C_Colonia::all(),
            'localidades'=> C_Localidad::findMany([57,249]),   
            'municipios'=> C_Municipio::findMany([5,4]),
            'gruposociales'=> C_GrupoSocial::all(),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $persona = new Persona();
        $persona->Nombre = $request->get('nombre');
        $persona->APaterno = $request->get('apellido_p');
        $persona->AMaterno = $request->get('apellido_m');
        $persona->CURP = $request->get('curp');
        $persona->RFC = $request->get('rfc');
        $persona->ClaveElector = $request->get('clave_elector');
        $persona->IdentificacionMigratoria = $request->get('extranjero');
        $persona->Sexo = $request->get('sexo');
        $persona->EstadoNacimientoId = $request->get('estado_nac');
        $persona->CiudadNacimiento = $request->get('ciudad_nac');
        $persona->FechaNacimiento = $request->get('fecha_na');
        $persona->GradoEstudiosId = $request->get('grado_estudios');
        $persona->ColoniaId = $request->get('colonia');
        $persona->Calle = $request->get('calle');
        $persona->Manzana = $request->get('manzana');
        $persona->Lote = $request->get('lote');
        $persona->NoExt = $request->get('num_exterior');
        $persona->NoInt = $request->get('num_interior');
        $persona->EstadoId = $request->get('estado');
        $persona->MunicipioId = $request->get('municipio');
        $persona->LocalidadId = $request->get('localidad');
        $persona->CP = $request->get('cod_postal');
        $persona->TelefonoCelular = $request->get('tel_cel');
        $persona->TelefonoCasa = $request->get('tel_casa');
        $persona->Email = $request->get('correo_ele');
        $persona->GrupoSocialId = $request->get('gruposocial');
        $persona->save();

        $pregunta37 = "";
        if(!empty($request->get('si_cuantos'))){
            $pregunta37 .= $request->get('si_cuantos')."#";
        }
        if(!empty($request->get('no_cuantos'))){
            $pregunta37 .= $request->get('no_cuantos');
        }

        $pregunta59 = "";
        if(!empty($request->get('Tipo_material_A'))){
            $pregunta59 .= $request->get('Tipo_material_A')."#";
        }
        if(!empty($request->get('Tipo_material_B'))){
            $pregunta59 .= $request->get('Tipo_material_B')."#";
        }
        if(!empty($request->get('Tipo_material_C'))){
            $pregunta59 .= $request->get('Tipo_material_C')."#";
        }
        if(!empty($request->get('Tipo_material_D'))){
            $pregunta59 .= $request->get('Tipo_material_D');
        }

        $pregunta88 = "";
        if(!empty($request->get('alimentos_opcion1'))){
            $pregunta88 .= $request->get('alimentos_opcion1')."#";
        }
        if(!empty($request->get('alimentos_opcion2'))){
            $pregunta88 .= $request->get('alimentos_opcion2')."#";
        }
        if(!empty($request->get('alimentos_opcion3'))){
            $pregunta88 .= $request->get('alimentos_opcion3')."#";
        }
        if(!empty($request->get('alimentos_opcion4'))){
            $pregunta88 .= $request->get('alimentos_opcion4')."#";
        }
        if(!empty($request->get('alimentos_opcion5'))){
            $pregunta88 .= $request->get('alimentos_opcion5')."#";
        }
        if(!empty($request->get('alimentos_opcion6'))){
            $pregunta88 .= $request->get('alimentos_opcion6')."#";
        }
        if(!empty($request->get('alimentos_opcion7'))){
            $pregunta88 .= $request->get('alimentos_opcion7')."#";
        }
        if(!empty($request->get('alimentos_opcion8'))){
            $pregunta88 .= $request->get('alimentos_opcion8')."#";
        }
        if(!empty($request->get('alimentos_opcion9'))){
            $pregunta88 .= $request->get('alimentos_opcion9')."#";
        }
        if(!empty($request->get('alimentos_opcion10'))){
            $pregunta88 .= $request->get('alimentos_opcion10')."#";
        }
        if(!empty($request->get('alimentos_opcion11'))){
            $pregunta88 .= $request->get('alimentos_opcion11')."#";
        }
        if(!empty($request->get('alimentos_opcion12'))){
            $pregunta88 .= $request->get('alimentos_opcion12');
        }

        $pregunta97 = "";
        if(!empty($request->get('violencia_tipoA'))){
            $pregunta97 .= $request->get('violencia_tipoA')."#";
        }
        if(!empty($request->get('violencia_tipoB'))){
            $pregunta97 .= $request->get('violencia_tipoB')."#";
        }
        if(!empty($request->get('violencia_tipoC'))){
            $pregunta97 .= $request->get('violencia_tipoC')."#";
        }
        if(!empty($request->get('violencia_tipoD'))){
            $pregunta97 .= $request->get('violencia_tipoD')."#";
        }
        if(!empty($request->get('violencia_tipoE'))){
            $pregunta97 .= $request->get('violencia_tipoE')."#";
        }
        if(!empty($request->get('violencia_tipoF'))){
            $pregunta97 .= $request->get('violencia_tipoF');
        }

        
        //$pregunta37 = $request->get('si_cuantos')."#".$request->get('no_cuantos');
        //$pregunta59 = $request->get('Tipo_material_A')."#".$request->get('Tipo_material_B')."#".$request->get('Tipo_material_C')."#".$request->get('Tipo_material_D');
        // $pregunta88 = $request->get('alimentos_opcion1')."#".$request->get('alimentos_opcion2')."#".$request->get('alimentos_opcion3')."#".$request->get('alimentos_opcion4')."#".$request->get('alimentos_opcion5')."#".$request->get('alimentos_opcion6')."#".$request->get('alimentos_opcion7')."#".$request->get('alimentos_opcion8')."#".$request->get('alimentos_opcion9')."#".$request->get('alimentos_opcion10')."#".$request->get('alimentos_opcion11')."#".$request->get('alimentos_opcion12');
        // $pregunta97 = $request->get('violencia_tipoA')."#".$request->get('violencia_tipoB')."#".$request->get('violencia_tipoC')."#".$request->get('violencia_tipoD')."#".$request->get('violencia_tipoE')."#".$request->get('violencia_tipoF');
        $idpersona = $persona::latest('id')->first();

        // echo $pregunta37;
        // echo "------------------------";
        // echo $pregunta59;
        // echo "------------------------";
        // echo $pregunta88;
        // echo "------------------------";
        // echo $pregunta97;
        // echo "------------------------";
        // var_dump($request->input());
        // echo"</pre>";

        $encuesta = new Encuesta();
        $encuesta->Pregunta_26 = $request->get('cuenta_apoyo_dependencia');
        $encuesta->Pregunta_27 = $request->get('nombre_dependencia');
        $encuesta->Pregunta_28 = $request->get('casa_propia');
        $encuesta->Pregunta_29 = $request->get('paga_renta');
        $encuesta->Pregunta_30 = $request->get('renta_mensual');
        $encuesta->Pregunta_31 = $request->get('casa_credito');
        $encuesta->Pregunta_32 = $request->get('cuanto_paga_credito');
        $encuesta->Pregunta_33 = $request->get('cuantas_per_viven_casa');
        $encuesta->Pregunta_34 = $request->get('dependientes_economicos');
        $encuesta->Pregunta_35 = $request->get('menores_12');
        $encuesta->Pregunta_36 = $request->get('personas_12a18');
        $encuesta->Pregunta_37 = $pregunta37;
        $encuesta->Pregunta_38 = $request->get('adultos_mayores');
        $encuesta->Pregunta_39 = $request->get('trabaja');
        $encuesta->Pregunta_40 = $request->get('problema_no_trabaja');
        $encuesta->Pregunta_41 = $request->get('cuantos_aportan_recursos');
        $encuesta->Pregunta_42 = $request->get('otros_ingresos');
        $encuesta->Pregunta_43 = $request->get('cuales');
        $encuesta->Pregunta_44 = $request->get('cto_asc_ing_extra');
        $encuesta->Pregunta_45 = $request->get('cto_asc_ing_men_fam_total');
        $encuesta->Pregunta_46 = $request->get('cto_asc_gast_men_fam_total');
        $encuesta->Pregunta_47 = $request->get('luz');
        $encuesta->Pregunta_48 = $request->get('agua');
        $encuesta->Pregunta_49 = $request->get('drenaje');
        $encuesta->Pregunta_50 = $request->get('piso_firme');
        $encuesta->Pregunta_51 = $request->get('tv');
        $encuesta->Pregunta_52 = $request->get('internet');
        $encuesta->Pregunta_53 = $request->get('tv_paga');
        $encuesta->Pregunta_54 = $request->get('refrigerador');
        $encuesta->Pregunta_55 = $request->get('microondas');
        $encuesta->Pregunta_56 = $request->get('computadora');
        $encuesta->Pregunta_57 = $request->get('celular');
        $encuesta->Pregunta_58 = $request->get('automovil');
        $encuesta->Pregunta_59 = $pregunta59;
        $encuesta->Pregunta_60 = $request->get('servicios_salud');
        $encuesta->Pregunta_61 = $request->get('seguro_social');
        $encuesta->Pregunta_62 = $request->get('institucion');
        $encuesta->Pregunta_63 = $request->get('num_discapacidad');
        $encuesta->Pregunta_64 = $request->get('tipo_discapacidad');
        $encuesta->Pregunta_65 = $request->get('permanente');
        $encuesta->Pregunta_66 = $request->get('hipertenso');
        $encuesta->Pregunta_67 = $request->get('cuantos_h');
        $encuesta->Pregunta_68 = $request->get('diabetico');
        $encuesta->Pregunta_69 = $request->get('cuantos_d');
        $encuesta->Pregunta_70 = $request->get('obesidad');
        $encuesta->Pregunta_71 = $request->get('cuantos_ob');
        $encuesta->Pregunta_72 = $request->get('otra_enfermedad');
        $encuesta->Pregunta_73 = $request->get('cual_tiene');
        $encuesta->Pregunta_74 = $request->get('temas_salud');
        $encuesta->Pregunta_75 = $request->get('Practica_alguna_actividad');
        $encuesta->Pregunta_76 = $request->get('realiza_actividad');
        $encuesta->Pregunta_77 = $request->get('actividades_practican');
        $encuesta->Pregunta_78 = $request->get('horas_dia');
        $encuesta->Pregunta_79 = $request->get('puede_practicarlo');
        $encuesta->Pregunta_80 = $request->get('perdio_empleo');
        $encuesta->Pregunta_81 = $request->get('reducio_ingresos');
        $encuesta->Pregunta_82 = $request->get('tres_meses_comida_acabara');
        $encuesta->Pregunta_83 = $request->get('tres_meses_quedaron_comida');
        $encuesta->Pregunta_84 = $request->get('tres_meses_sin_dinero_alimentacion_sana_variada');
        $encuesta->Pregunta_85 = $request->get('quedo_desayunar_comer_cenar');
        $encuesta->Pregunta_86 = $request->get('disminuyo_cantidad_dcc');
        $encuesta->Pregunta_87 = $request->get('acosto_hambre');
        $encuesta->Pregunta_88 = $pregunta88;
        $encuesta->Pregunta_89 = $request->get('interesa_curso_capacitacion');
        $encuesta->Pregunta_90 = $request->get('que_tipo');
        $encuesta->Pregunta_91 = $request->get('aprender_nuevas_tecnologias');
        $encuesta->Pregunta_92 = $request->get('alguna_aprender_nuevas_tecnologias');
        $encuesta->Pregunta_93 = $request->get('cuenta_espacio_huerto');
        $encuesta->Pregunta_94 = $request->get('metros_cuadrados');
        $encuesta->Pregunta_95 = $request->get('pondria_huerto_hogar');
        $encuesta->Pregunta_96 = $request->get('sabe_tipos_violencia');
        $encuesta->Pregunta_97 = $pregunta97;
        $encuesta->Pregunta_98 = $request->get('saber_tema');
        $encuesta->Pregunta_99 = $request->get('escuchado_adicciones_prevencion');
        $encuesta->Pregunta_100 = $request->get('denunciar_tipo_violencia');
        $encuesta->Pregunta_101 = $request->get('siente_seguro_vivienda');
        $encuesta->PersonaId =  $idpersona["id"];
        $encuesta->Intentos = 3;
        $encuesta->EncuestadorId = 0;
        $encuesta->save();

        // return redirect('/saved');
        return 'Datos Guardados';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
