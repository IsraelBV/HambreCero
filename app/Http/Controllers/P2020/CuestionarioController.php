<?php

namespace App\Http\Controllers\P2020;

use App\Http\Controllers\Controller;

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
use App\Models\C_EstadoCivil;
use Faker\Provider\ar_JO\Person;

use Auth;

use Illuminate\Support\Facades\DB;


class CuestionarioController extends Controller
{

    public function __construct(){
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (session()->has('periodo')) {
                if (session('periodo') != 3) {
                    return view('2020.cuestionario.index');        
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/periodo');
            }
        } else {
            // return view('2020.cuestionario.index');     
            return redirect('/');   
        }
    }

    public function findPersona(Request $request){

        $curp = $request->get('curp');
        
        if (isset($curp)) {
         
            return  DB::table('personas')
            ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
            ->leftJoin('c_municipios', 'personas.MunicipioId', '=', 'c_municipios.id')
            ->leftJoin('c_localidades', 'personas.LocalidadId', '=', 'c_localidades.id')
            ->select('personas.id', 'personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','c_colonias.Descripcion as colonia','c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad')
            ->where("personas.CURP", $curp)
            ->get();
            
        } else {
   
            return  DB::table('personas')
            ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
            ->leftJoin('c_municipios', 'personas.MunicipioId', '=', 'c_municipios.id')
            ->leftJoin('c_localidades', 'personas.LocalidadId', '=', 'c_localidades.id')
            ->select('personas.id', 'personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','c_colonias.Descripcion as colonia','c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad')
            ->where("personas.Nombre", $request->get('nombre'))
            ->where("personas.APaterno", $request->get('apellido_p'))
            ->where("personas.AMaterno", $request->get('apellido_m'))
            ->get();
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if(session('periodo') == 1){

            // var_dump(C_Localidad::findMany([57,249]));
   
            return view('2020.cuestionario.encuesta2020',[
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
               'estadosCiviles' => C_EstadoCivil::all(),
               ]);
        } else {
            return view('2020.cuestionario.encuesta2020bis',[
                'preguntas'=> C_Pregunta::all(),
                'estados'=> C_Estado::all(),
                'colonias'=> C_Colonia::all(),
                'localidades'=> C_Localidad::findMany([57,249]),   
                'municipios'=> C_Municipio::findMany([5,4]),
                'estadosCiviles' => C_EstadoCivil::all(),
                'estudios'=> C_GradoDeEstudio::all(),
                ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if (count($this->findPersona($request)) > 0) {
            return 0;
        }

        if(session('periodo') == 1){//2020
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
            $persona->EstadoCivilId = $request->get('estadocivil');
            $persona->EncuestadorId = (Auth::check())?Auth::user()->id:0;
            $persona->Intentos = 0;
            


            $pregunta37 = "";
            if(!empty($request->get('si_cuantos'))){
                $pregunta37 .= $request->get('si_cuantos');
            }
            $pregunta37 .="#";
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
            $encuesta->EncuestadorId = (Auth::check())?Auth::user()->id:0;

            $persona->save();// guarda los datos de la persona

            $idpersona = $persona::latest('id')->first(); //busca el id del ultimo registro persona guardado
            $encuesta->PersonaId =  $idpersona["id"];

            $encuesta->save(); // guarda las encuestas

            return [1,$idpersona["id"]];
        } else {//2020bis
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
            $persona->EstadoCivilId = $request->get('estadocivil');
            $persona->EncuestadorId = (Auth::check())?Auth::user()->id:0;
            $persona->Intentos = 0;
           
            $encuesta = new Encuesta();
            $encuesta->Pregunta_33 = $request->get('cuantas_per_viven_casa');
            $encuesta->EncuestadorId = (Auth::check())?Auth::user()->id:0;

            $persona->save();// guarda los datos de la persona

            $idpersona = $persona::latest('id')->first(); //busca el id del ultimo registro persona guardado
            $encuesta->PersonaId =  $idpersona["id"];

            $encuesta->save(); // guarda las encuestas

            return [1,$idpersona["id"]];

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if(session('periodo') == 1){ //2020
            $personaCollection = DB::table('personas')
            ->join('encuestas', 'personas.id', '=', 'encuestas.personaId')
            ->select('personas.*','encuestas.Pregunta_26','encuestas.Pregunta_27','encuestas.Pregunta_28','encuestas.Pregunta_29','encuestas.Pregunta_30','encuestas.Pregunta_31','encuestas.Pregunta_32','encuestas.Pregunta_33','encuestas.Pregunta_34','encuestas.Pregunta_35','encuestas.Pregunta_36','encuestas.Pregunta_37','encuestas.Pregunta_38','encuestas.Pregunta_39','encuestas.Pregunta_40','encuestas.Pregunta_41','encuestas.Pregunta_42','encuestas.Pregunta_43','encuestas.Pregunta_44','encuestas.Pregunta_45','encuestas.Pregunta_46','encuestas.Pregunta_47','encuestas.Pregunta_48','encuestas.Pregunta_49','encuestas.Pregunta_50','encuestas.Pregunta_51','encuestas.Pregunta_52','encuestas.Pregunta_53','encuestas.Pregunta_54','encuestas.Pregunta_55','encuestas.Pregunta_56','encuestas.Pregunta_57','encuestas.Pregunta_58','encuestas.Pregunta_59','encuestas.Pregunta_60','encuestas.Pregunta_61','encuestas.Pregunta_62','encuestas.Pregunta_63','encuestas.Pregunta_64','encuestas.Pregunta_65','encuestas.Pregunta_66','encuestas.Pregunta_67','encuestas.Pregunta_68','encuestas.Pregunta_69','encuestas.Pregunta_70','encuestas.Pregunta_71','encuestas.Pregunta_72','encuestas.Pregunta_73','encuestas.Pregunta_74','encuestas.Pregunta_75','encuestas.Pregunta_76','encuestas.Pregunta_77','encuestas.Pregunta_78','encuestas.Pregunta_79','encuestas.Pregunta_80','encuestas.Pregunta_81','encuestas.Pregunta_82','encuestas.Pregunta_83','encuestas.Pregunta_84','encuestas.Pregunta_85','encuestas.Pregunta_86','encuestas.Pregunta_87','encuestas.Pregunta_88','encuestas.Pregunta_89','encuestas.Pregunta_90','encuestas.Pregunta_91','encuestas.Pregunta_92','encuestas.Pregunta_93','encuestas.Pregunta_94','encuestas.Pregunta_95','encuestas.Pregunta_96','encuestas.Pregunta_97','encuestas.Pregunta_98','encuestas.Pregunta_99','encuestas.Pregunta_100','encuestas.Pregunta_101')
            ->where("personas.id", $id)
            ->get();

            if (Auth::check()) { //se utiliza para que siempre que haya alguein loggeado pueda editar la encuesta abiertamente
                $personaCollection[0]->Intentos = 1;
            }

            return view('2020.cuestionario.encuestaUpdate2020',[
                'preguntas'=> C_Pregunta::all(),
                'estados'=> C_Estado::all(),
                'alimentos'=> C_Alimento::all(),
                'estudios'=> C_GradoDeEstudio::all(),
                'ss'=> C_SSInstitucion::all(),
                'violencias'=> C_TipoDeViolencia::all(),
                'materiales'=> C_TipoMaterial::all(),
                'colonias'=> C_Colonia::all(),
                'localidades'=> C_Localidad::findMany([57,249]),   
                'municipios'=> C_Municipio::findMany([5,4]),
                'gruposociales'=> C_GrupoSocial::all(),
                'estadosCiviles' => C_EstadoCivil::all(),
                'persona'=>$personaCollection
                ]);
        } else {//2020 bis
            $personaCollection = DB::table('personas')
            ->leftjoin('encuestas', 'personas.id', '=', 'encuestas.personaId')
            ->select('personas.*', 'encuestas.Pregunta_33')
            ->where('personas.id', $id)
            ->get();

            if (Auth::check()) { //se utiliza para que siempre que haya alguein loggeado pueda editar la encuesta abiertamente
                $personaCollection[0]->Intentos = 1;
            }

            return view('2020.cuestionario.encuestaUpdate2020bis',[
                'preguntas'=> C_Pregunta::all(),
                'estados'=> C_Estado::all(),
                'colonias'=> C_Colonia::all(),
                'localidades'=> C_Localidad::findMany([57,249]),   
                'municipios'=> C_Municipio::findMany([5,4]),
                'estadosCiviles' => C_EstadoCivil::all(),
                'estudios'=> C_GradoDeEstudio::all(),
                'persona'=>$personaCollection
                ]);
        }

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

        if(session('periodo') == 1){// para 2020
            $persona = Persona::find($id);

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
            $persona->EstadoCivilId = $request->get('estadocivil');
            $persona->EncuestadorId = (Auth::check())?Auth::user()->id:0;
            $persona->Intentos = 0;

            $pregunta37 = "";
            if(!empty($request->get('si_cuantos'))){
                $pregunta37 .= $request->get('si_cuantos');
            }
            $pregunta37 .="#";
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


            $encuesta = Encuesta::where('PersonaId',$id)->first();

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
            $encuesta->EncuestadorId = (Auth::check())?Auth::user()->id:0;

            $persona->save();//actualiza los registros de persona

            $encuesta->save();//actualiza las encuestas

            return 'Datos Actualizados';
        } else { //para 2020 bis
            $persona = Persona::find($id);

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
            $persona->EstadoCivilId = $request->get('estadocivil');
            $persona->EncuestadorId = (Auth::check())?Auth::user()->id:0;
            $persona->Intentos = 0;            

            $encuesta = Encuesta::where('PersonaId',$id)->first();
            
            $encuesta->Pregunta_33 = $request->get('cuantas_per_viven_casa');
            $encuesta->EncuestadorId = (Auth::check())?Auth::user()->id:0;

            $persona->save();//actualiza los registros de persona

            $encuesta->save();//actualiza las encuestas

            return 'Datos Actualizados';
        }
        
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

    public function imprimir($id){
        setlocale(LC_TIME, "spanish");
        if(session('periodo') == 1){//2020
            
            $preguntas = C_Pregunta::all();
            $estados = C_Estado::all();
            $alimentos = C_Alimento::all();
            $estudios = C_GradoDeEstudio::all();
            $ss = C_SSInstitucion::all();
            $violencias = C_TipoDeViolencia::all();
            $materiales = C_TipoMaterial::all();
            $colonias = C_Colonia::all();
            $localidades = C_Localidad::findMany([57,249]);
            $municipios = C_Municipio::findMany([5,4]);
            $gruposociales = C_GrupoSocial::all();
            $estadosCiviles = C_EstadoCivil::all();
            $persona = DB::table('personas')
                ->join('encuestas', 'personas.id', '=', 'encuestas.personaId')
                ->select('personas.*', 'encuestas.*')
                ->where("personas.id", $id)
                ->get();
    
            $pdf = \PDF::loadView('2020.cuestionario.formato2020', compact('preguntas','persona','estados','alimentos','estudios','ss','violencias','materiales','colonias','localidades','municipios','gruposociales','estadosCiviles'));
            $pdf->setPaper('letter', 'portrait');
            return $pdf->stream("Cuestionario.pdf");//, array("Attachment" => 0)); 
            // return $pdf->download('Cuestionario.pdf');
        }else{//2020bis

            $preguntas = C_Pregunta::all();
            $estados = C_Estado::all();
            $colonias = C_Colonia::all();
            $localidades = C_Localidad::findMany([57,249]);
            $municipios = C_Municipio::findMany([5,4]);
            $estadosCiviles = C_EstadoCivil::all();
            $estudios = C_GradoDeEstudio::all();
            $persona = DB::table('personas')
                ->join('encuestas', 'personas.id', '=', 'encuestas.personaId')
                ->select('personas.*', 'encuestas.*')
                ->where("personas.id", $id)
                ->get();
    
            $pdf = \PDF::loadView('2020.cuestionario.formato2020bis', compact('preguntas','persona','estados','colonias','localidades','municipios','estadosCiviles','estudios'));
            $pdf->setPaper('letter', 'portrait');
            return $pdf->stream("Cuestionario.pdf");//, array("Attachment" => 0)); 
            // return $pdf->download('Cuestionario.pdf');
        }
       
   }
}
