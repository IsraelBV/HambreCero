<?php

namespace App\Http\Controllers\P2022;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\C_Pregunta;
use App\Models\C_Colonia;
use App\Models\C_Estado;
use App\Models\C_GradoDeEstudio;
use App\Models\C_Municipio;
use App\Models\C_Localidad;
use App\Models\Persona;
use App\Models\Encuesta;
use App\Models\C_EstadoCivil;
use App\Models\C_PeriodosDeEntrega;
use App\Models\StockDespensa;

use App\Http\Controllers\P2022\Admin\EntregaController;
use App\Models\c_tipo_beneficiario;
use App\Models\Documentacion;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

use Auth;

use Illuminate\Support\Facades\DB;
use Svg\Tag\Path;

use function PHPUnit\Framework\isNull;

use Carbon\Carbon;

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
    public function index(){
        if (Auth::check()) {
            if (session()->has('periodo')) {

                $now = Carbon::now();

                $entregas = DB::table('entregas')
                ->select('id')
                ->where('idCentroEntrega', '=',session('centroEntrega'))
                ->where('created_at','>=', $now->toDateString().' 05:00:00')
                ->get();
                $entregasCount = $entregas->count();

                session(['NumeroDeEntregas' => $entregasCount]);

                return view('2022.cuestionario.index');
            } else {
                return redirect('/periodo');
            }
        } else {
            return view('2022.cuestionario.index');
        }
    }

    public function findPersona(Request $request){

        $curp = $request->get('curp');

        $persona = DB::table('personas')
            ->select('personas.password','personas.id','personas.CURP')
            ->where("personas.CURP", $curp)
            ->get();

            if ($persona->count() > 0) {
                if ($persona->count() == 1) {
                    if (Auth::check()) { // verifica que sea un usuario con cuenta o un usuario publico
                        return $this->edit($persona[0]->id);
                    } else {
                        if ($request->has('pass')) {
                            $pass = $request->get('pass');

                            if(is_null($persona[0]->password)){

                                // if ($pass == $persona[0]->CURP) {
                                    return $this->editPasswordPersona($persona[0]->id);
                                    // //return redirect("/2022/registro/pass/{$persona[0]->id}/edit");
                                // } else {
                                //     return view('2022.cuestionario.index',[
                                //         'errmsg'=> 'CURP o Contraseña incorrectos',
                                //         'curp'=> $curp
                                //         ]);
                                // }
                            } else {
                                if (Hash::check($pass, $persona[0]->password)) {// verificar que sea la contraseña
                                    return $this->edit($persona[0]->id);
                                    //return redirect("/2022/registro/{$persona[0]->id}/edit");
                                } else {
                                    return view('2022.cuestionario.index',[
                                        'errmsg'=> 'CURP o Contraseña incorrectos',
                                        'verify'=> 1,
                                        'curp'=> $curp
                                        ]);
                                }
                            }
                        } else {
                            return view('2022.cuestionario.index',[
                                'curp'=> $curp,
                                'verify'=> 1,
                                'scssmsg'=> 'Verificado, ingrese su contraseña'
                                ]);
                        }
                    }
                } else {
                    return view('2022.cuestionario.index',[
                        'errmsg'=>  "La persona registrada con este CURP presenta un inconveniente, favor de reportarlo",
                        'curp'=> $curp
                    ]);
                }
            } else {
                //BLOQUEDO POR VEDA ELECTORAL
                // return view('2022.cuestionario.index',[
                //     'errmsg'=> 'Esta curp no se encuentra registrada dentro del padron.',
                //     'curp'=> $curp
                //     ]);
                // if (Auth::check() && Auth::user()->tipoUsuarioId == 0) {

                //// se abrio registro 28-01-2022
                // if (Auth::check()) {
                    return $this->create($curp);//redirecciona a crate pero con la curp
                // } else {
                //     return view('2022.cuestionario.index',[
                //         'errmsg'=> 'Esta curp no se encuentra registrada dentro del padron.',
                //         'curp'=> $curp
                //     ]);
                // }
            }
    }

    public function editPasswordPersona($id){

            $persona = Persona::find($id);
            if (is_null($persona->password)) {
                return view('2022.cuestionario.editPasswordPersona',['usuario'=> $id]);
            } else {
                return redirect('/2022/registro');
            }

    }

    public function updatePasswordPersona(Request $request, $id){

        $persona = Persona::where('id',$id)->first();

        if (is_null($persona->password)) {

            Validator::make($request->all(), [
                'contraseña' => ['required', 'string', 'min:8', 'confirmed'],
            ])->validate();

            $persona->password = Hash::make($request->get('contraseña'));
            $persona->save();

            return view('2022.cuestionario.index',[
                'scssmsg'=>  'Se ha cambiado la contraseña del usuario, vuelva a ingresar.',
                'curp'=> $persona->CURP,
                'verify'=> 1
                ]);

        } else {
            return redirect('/2022/registro');
        }
    }

    public function passwordRecover(Request $request){
        $curp = $request->get('persona');

        $persona = Persona::where('CURP',$curp)->first();

        if ($persona->TelefonoCelular == $request->get('phone')|| $persona->TelefonoCasa == $request->get('phone')) {
            $persona->password = null;
            $persona->save();

            return $this->editPasswordPersona($persona->id);
        } else {
            return view('2022.cuestionario.index',[
                'curp'=> $curp,
                'verify'=> 1,
                'errmsg'=> 'Informacion incorrecta, pongase en contacto con los encargados del programa.'
                ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($curp = NULL)
    {
        // if (Auth::check() && Auth::user()->tipoUsuarioId == 0) {//cambio por entregas navideñas
        // if (Auth::check()) {//cambio por entregas navideñas

            $colonias = null;
            // $colonias = DB::table('c_colonias')
            // ->select('c_colonias.*')
            // ->leftjoin('c_localidades', 'c_colonias.LocalidadId', '=', 'c_localidades.id')
            // // ->whereIn('c_colonias.LocalidadId', [326,68,330,1,66,347])
            // ->where('c_colonias.status', '=',1)
            // ->where('c_localidades.status', '=',1)
            // ->orderBy('c_colonias.Descripcion', 'ASC')
            // ->get();

            $localidades = null;
            // $localidades = DB::table('c_localidades')
            // ->select('c_localidades.*')
            // ->leftjoin('c_municipios', 'c_localidades.MunicipioId', '=', 'c_municipios.id')
            // ->where('c_localidades.status', '=',1)
            // ->orderBy('c_localidades.Descripcion', 'ASC')
            // ->get();

            // dd(DB::getQueryLog());

            return view('2022.cuestionario.encuesta',[
                'preguntas'=> C_Pregunta::all(),
                'estados'=> C_Estado::all(),
                'colonias'=> $colonias,
                // 'colonias'=> C_Colonia::all(),
                'localidades'=> $localidades,
                // 'localidades'=> C_Localidad::where('status', 1)->get(),
                // 'localidades'=> C_Localidad::findMany([57,249]),
                'municipios'=> C_Municipio::where('status', 1)->get(),
                // 'municipios'=> C_Municipio::findMany([5,4]),
                'estadosCiviles' => C_EstadoCivil::all(),
                'estudios'=> C_GradoDeEstudio::all(),
                'tiposbeneficiario'=> c_tipo_beneficiario::all(),
                'curp' => $curp
                ]);
        // } else {
        //     return view('2022.cuestionario.index',[
        //         'errmsg'=> 'Esta curp no se encuentra registrada dentro del padron.',
        //         'curp'=> $curp
        //     ]);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curpExiste = $this->findCurp($request->get('curp'));

        // if(Auth::check() && Auth::user()->tipoUsuarioId == 0) {
        // if(Auth::check()) {

            if($curpExiste->count() >= 2) {
                return [0,"Error: 101, El CURP que intenta actualizar tiene un inconveniente, favor de reportar ."];
            } else {
                if ($curpExiste->count() > 0) {
                    return [0,"Error: 102, La persona que intenta registrar ya existe. </br> Por Favor regrese a la vista principal o espere la redireccion."];
                }
            }

            Validator::make($request->all(), [
                'contraseña' => ['required', 'string', 'min:8'],
            ])->validate();

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
            $persona->password = Hash::make($request->get('contraseña'));
            $persona->PeriodoId = 4;//<-- AQUI HAY QUE REGRESARLO A PERIODO 3 CUANDO SE SUBA LA ACTUALIZACION


            $encuesta = new Encuesta();
            $encuesta->Pregunta_33 = $request->get('cuantas_per_viven_casa');
            $encuesta->Pregunta_102 = $request->get('menores_sin_acta');
            $encuesta->Pregunta_103 = $request->get('considera_indigena');
            $encuesta->idTipoBeneficiario = ($request->has('benef_type'))?$request->get('benef_type'):1;
            $encuesta->EncuestadorId = (Auth::check())?Auth::user()->id:0;

            $persona->save();// guarda los datos de la persona

            $idpersona = $persona::latest('id')->first(); //busca el id del ultimo registro persona guardado
            $encuesta->PersonaId =  $idpersona["id"];

            $encuesta->save(); // guarda las encuestas

            return [1,$idpersona["id"]];

        // } else {
        //     return view('2022.cuestionario.index',[
        //         'errmsg'=> 'Esta curp no se encuentra registrada dentro del padron.',
        //         'curp'=> $request->get('curp')
        //     ]);
        // }

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
        // if (Auth::check()) {// cambio por beda electoral

            $personaCollection = DB::table('personas')
            ->leftjoin('encuestas', 'personas.id', '=', 'encuestas.personaId')
            ->select('personas.*', 'encuestas.idTipoBeneficiario','encuestas.Pregunta_33', 'encuestas.Pregunta_102', 'encuestas.Pregunta_103')
            ->where('personas.id', $id)
            ->get();


            if (Auth::check()) { // para diferenciar entra usuario y publico y proporcionarles la informacion correcta o que deben tener de colonias , localidades y municipios

                $colonias = DB::table('c_colonias')
                ->select('*')
                ->where('LocalidadId', '=',$personaCollection[0]->LocalidadId)
                ->orWhere('id', '=', $personaCollection[0]->ColoniaId)
                ->orderBy('Descripcion', 'ASC')
                ->get();

                $localidades =  DB::table('c_localidades')
                ->select('*')
                ->whereIn('status', [1, 2])
                ->where('MunicipioId', $personaCollection[0]->MunicipioId)
                ->orWhere('id', '=', $personaCollection[0]->LocalidadId)
                ->orderBy('Descripcion', 'ASC')
                ->get();

                $municipios = DB::table('c_municipios')
                ->select('*')
                ->orderBy('Descripcion', 'ASC')
                ->get();

                $stock = StockDespensa::where('idCentroEntrega', session('centroEntrega'))->get();
            } else {
                // DB::enableQueryLog();
                $colonias = DB::table('c_colonias')
                ->select('*')
                ->where('LocalidadId', '=',$personaCollection[0]->LocalidadId)
                ->where('status', '=',1)
                ->orWhere('id', '=', $personaCollection[0]->ColoniaId)
                ->orderBy('Descripcion', 'ASC')
                ->get();
                // dd(DB::getQueryLog());

                $localidades = DB::table('c_localidades')
                ->select('*')
                ->where('status', 1)
                ->where('MunicipioId', $personaCollection[0]->MunicipioId)
                ->orWhere('id', '=', $personaCollection[0]->LocalidadId)
                ->orderBy('Descripcion', 'ASC')
                ->get();

                $municipios = DB::table('c_municipios')
                ->select('*')
                ->where('status', 1)
                ->orWhere('id', '=', $personaCollection[0]->MunicipioId)
                ->orderBy('Descripcion', 'ASC')
                ->get();

                $stock = null;
            }

            $personaCollection[0]->Intentos = 1;

            // $fechaEmpaDisor = explode(" ",$personaCollection[0]->created_at);
            // $fechaEmpadArray = explode("-",$fechaEmpaDisor[0]);
            // $fechaEmpadronamiento = "$fechaEmpadArray[2]-$fechaEmpadArray[1]-$fechaEmpadArray[0]";

            // $personaCollection[0]->created_at = $fechaEmpadronamiento;


            // DB::enableQueryLog();

            $listaentregas = DB::table('documentacion') //lista de entregados
            ->leftJoin('entregas', 'entregas.DocumentacionId', '=', 'documentacion.id')
            ->leftJoin('c_periodos', 'entregas.PeriodoId', '=', 'c_periodos.id')
            ->leftJoin('c_municipios', 'entregas.MunicipioId', '=', 'c_municipios.id')
            ->leftJoin('c_localidades', 'entregas.LocalidadId', '=', 'c_localidades.id')
            ->leftJoin('c_centrosdeentrega', 'documentacion.idCentroEntrega', '=', 'c_centrosdeentrega.id')
            ->leftJoin('c_centrosdeentrega AS ce', 'entregas.idCentroEntrega', '=', 'ce.id')
            ->leftJoin('c_periodosdeentrega', 'entregas.idPeriodoEntrega', '=', 'c_periodosdeentrega.id')
            ->select('entregas.id as idEntrega','documentacion.id as idDocumentacion','c_periodos.Descripcion as periodo','entregas.Direccion', 'c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad','c_centrosdeentrega.Descripcion as centroentrega','ce.Descripcion as centroentregaentrega','c_centrosdeentrega.Direccion as direccioncentroentrega','entregas.comentarioEntrega as comentario',DB::raw('DATE_SUB(entregas.created_at, INTERVAL 5 HOUR) as fechaEntrega'),'c_periodosdeentrega.Descripcion as periodoEntrega','entregas.Donado as donado')
            ->where('documentacion.PersonaId',$id)
            ->get();

            // dd(DB::getQueryLog());


            // $documentacion = Documentacion::where('PersonaId',$id)->orderBy('id', 'DESC')->first();
            // $entrega = Entrega::where('DocumentacionId',$documentacion->id)->first();
            $listo = null;
            $entregacontroller = new EntregaController;

            foreach($listaentregas as $entrega ) {
               if ($entrega->idEntrega == null) {
                    $listo = [
                        "completo" => $entregacontroller->verifyRequiredDocuments($entrega->idDocumentacion,$id),
                        "folio" => $entrega->idDocumentacion
                    ];
               }
            }

            return view('2022.cuestionario.encuestaUpdate',[
                'preguntas'=> C_Pregunta::all(),
                'estados'=> C_Estado::all(),
                'colonias'=> $colonias,
                // 'colonias'=> C_Colonia::all(),
                'localidades'=> $localidades,
                // 'localidades'=> C_Localidad::findMany([57,249]),
                'municipios'=> $municipios,
                // 'municipios'=> C_Municipio::findMany([5,4]),
                'estadosCiviles' => C_EstadoCivil::all(),
                'estudios'=> C_GradoDeEstudio::all(),
                'tiposbeneficiario'=> c_tipo_beneficiario::all(),
                'persona'=>$personaCollection,
                'listaentregas'=>$listaentregas,
                'listo'=>$listo,
                'stock'=>$stock,
                // 'ultimadocumentacion'=>$documentacion
                ]);
        // } else {
        //     return view('2022.cuestionario.index');
        // }
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
        $curpExiste = $this->findCurp($request->get('curp'));

        if($curpExiste->count() > 0){//si es mayor a cero quiere decir que la curp nueva que pusieron si existe dentro de la base
            if($curpExiste->count() >= 2) {
                return [0,"Error: 101, El CURP que intenta actulizar tiene un inconveniente, favor de reportar ."];
            } else {
                if ($curpExiste[0]->id != $id) {
                    return [0,"Error: 102, El CURP que intenta actulizar tiene un inconveniente, favor de reportar."];
                }
            }
        }

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
        $encuesta->Pregunta_102 = $request->get('menores_sin_acta');
        $encuesta->Pregunta_103 = $request->get('considera_indigena');
        if ($request->has('benef_type')) {
            $encuesta->idTipoBeneficiario = $request->get('benef_type');
        }

        $encuesta->EncuestadorId = (Auth::check())?Auth::user()->id:0;

        $persona->save();//actualiza los registros de persona

        $encuesta->save();//actualiza las encuestas

        return [1,'Datos Actualizados'];

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

            $pdf = \PDF::loadView('2022.cuestionario.formato', compact('preguntas','persona','estados','colonias','localidades','municipios','estadosCiviles','estudios'));
            $pdf->setPaper('letter', 'portrait');
            return $pdf->stream("Cuestionario.pdf");//, array("Attachment" => 0));
            // return $pdf->download('Cuestionario.pdf');


    }







    public function storeDocumentacion(Request $request, $id){

        $this->validateDocumentFormat($request);

        $okEntrega = 0;//variable sirve para validar si aun tiene disponibilidad para crear otra documetacion o ya tiene las despensas maximas a la fecha

        $idperiodoEntregaActual = C_PeriodosDeEntrega::where('status','=',1)->get()[0]->id;//obtiene el periodo de entrega activo

        $idTipoBeneficiario = DB::table('encuestas')
                    ->select('idTipoBeneficiario')
                    ->where('PersonaId', $id)
                    ->get()[0]
                    ->idTipoBeneficiario;

        $despensasCorrespondenEnElbimestre = DB::table('c_tipos_beneficiarios')//cuantas entregas recibe por bimestre
                ->select('despensasPorPeriodo')
                ->where('id', $idTipoBeneficiario)
                ->get()[0]
                ->despensasPorPeriodo;

        $entregasEnElBimestreActual = DB::table('entregas') // busca si existe una entrega con ese id de persona y en ese periodo de entrega
            ->select('id')
            ->where('PersonaId', $id)
            ->where('idPeriodoEntrega', $idperiodoEntregaActual)
            ->get()
            ->count();

            //compara las entregas que tenga de el bimestre activo y las despensas que le tocan por el tipo de beneficiario que es para saber si aun tiene disponibles,
            //si tiene mas (que deberia ser imposible) o igual cantidad de despensas entonces entra a una segunda validacion
        if ($entregasEnElBimestreActual >= $despensasCorrespondenEnElbimestre) {
            if ($idTipoBeneficiario == 1 || $idTipoBeneficiario == 3) {//valida si son los tipos de usuario que pueden reclamar una despensa que no hayan pedido en bimestres anteriores
                $hdc = $despensasCorrespondenEnElbimestre; //holdDespensasCorresponden ->variable para guardar el total de entregas que le corresponden | se inicializa con las que ya se tienen del bimestre actual.
                $hde = $entregasEnElBimestreActual; //holdDespensasEntrgadas ->variable para guardar el total de entregas hechas | se inicializa con las que ya se tienen del bimestre actual.
                $listaPeriodosEntrega = DB::table('c_periodosdeentrega')// obtiene la lista de los bimestres que pertenecen al periodo anual seleccionado y sean menores que el periodo de entrega activo.
                    ->select('id')
                    ->where('idPeriodoPrograma',session('periodo'))
                    ->where('id','<',$idperiodoEntregaActual)
                    ->orderBy('id', 'DESC')
                    ->get();

                foreach ($listaPeriodosEntrega as $periodoEntrega) {//itera la lista de los bimestres para verificar uno a uno e ir sumando las entregas que deberian tener y las que les corresponden

                    $entregasxperiodo = DB::table('entregas') // obtiene las entregas correspondientes al bimestre de la iteracion
                    ->select('id','idTipoBeneficiario')
                    ->where('PersonaId', $id)
                    ->where('idPeriodoEntrega', $periodoEntrega->id)
                    ->orderBy('id', 'DESC')
                    ->get();

                    $totalEntregasEstePeriodo = $entregasxperiodo->count(); //total de entregas en el bimestre

                    $hde += $totalEntregasEstePeriodo;//siempre se suma el total de entregas hechas en el bimestre parta al final tener el total de entregas hechas
                    if ($totalEntregasEstePeriodo < 1) {//si no tiene entregas
                        $hdc ++; //suma 1 a las que le corresponderian
                    } else {
                        $ecbeb = null; //entregas que corresponden al beneficiario en ese bimestre

                        //para ahorrar el paso de consultar siempre las despensas correspondientes segun su tipo de beneficiario,
                        //se verifica si la ultima entrega de ese bimestre tiene el mismo tipo de beneficiario que la del bimestre activo
                        if ($entregasxperiodo[0]->idTipoBeneficiario == $idTipoBeneficiario) {//si lo tiene toma la consulta principal
                            $ecbeb = $despensasCorrespondenEnElbimestre;
                        } else { //si no lo tiene consulta la cantidad de despensas para ese tipo de beneficiario
                            $ecbeb = DB::table('c_tipos_beneficiarios')
                            ->select('despensasPorPeriodo')
                            ->where('id', $entregasxperiodo[0]->idTipoBeneficiario)
                            ->get()[0];
                        }

                        //si las entregas que le corresponden al usuario en ese bimestre son menos que las entregas hechas en ese periodo, se toma las que la correspondian en ese bimestre
                        //(se descartan las que son extras en ese bimestre ya que pueden ser entregas que no fue a buscar en su momento y lo que estamos buscando es hacer la suma del total de despensas que le corresponderian hasta la fecha)
                        if ($ecbeb < $totalEntregasEstePeriodo) {
                            $hdc += $ecbeb;
                        } else { //si son mas las entregas que le correspondian en ese bimestre se toman en cuenta las que fueron hechas ya que son las que tomo en ese bimestre,
                                //si tomamos en cuenta las que en teoria le correspondian se estaria agregando despensas extra.
                            $hdc += $totalEntregasEstePeriodo;
                        }
                    }
                }
                if ($hde < $hdc) {//si las entregas totales son menos de las que le corresponden a la fecha entonces da ok a la entrega
                    $okEntrega = 1;
                }
            }
        } else {
            $okEntrega = 1;
        }


        // $documentacionExistente = DB::table('documentacion') // busca si existe una documentacion con ese id de persona y en ese periodo de entrega
        // ->select('documentacion.id')
        // ->where('documentacion.PersonaId', $id)
        // ->where('documentacion.idPeriodoEntrega', $idperiodoEntregaActual)
        // ->get();


        // if ($documentacionExistente->count() > 0) {
        // if (($idTipoBeneficiario[0]->idTipoBeneficiario == 2 && $documentacionExistente->count() >= 8) || ($idTipoBeneficiario[0]->idTipoBeneficiario == 1 && $documentacionExistente->count() > 1)) {

        if ($okEntrega == 0) {
            return $this->buildListaEntregas($id);
        } else {

            $centroEntrega = DB::table('personas')
                    ->leftjoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
                    ->select('c_colonias.CentroEntregaId')
                    ->where('personas.id', $id)
                    ->get()[0]
                    ->CentroEntregaId;

            $documentacion = new Documentacion();

            $documentacion->PersonaId = $id;
            $documentacion->idCentroEntrega = $centroEntrega;
            $documentacion->idPeriodoEntrega = $idperiodoEntregaActual;

            $documentacion->save();

            $this->storeDocuments($request, $documentacion->id); // se utilza para actualizar los documentos pero su funcion es recibir los documentos y guardarlos

            return $this->buildListaEntregas($id);
        }
    }

    public function buildListaEntregas($id){

        $listaentregas = DB::table('documentacion') //lista de entregados
        ->leftJoin('entregas', 'entregas.DocumentacionId', '=', 'documentacion.id')
        ->leftJoin('c_periodos', 'entregas.PeriodoId', '=', 'c_periodos.id')
        ->leftJoin('c_municipios', 'entregas.MunicipioId', '=', 'c_municipios.id')
        ->leftJoin('c_localidades', 'entregas.LocalidadId', '=', 'c_localidades.id')
        ->leftJoin('c_centrosdeentrega', 'documentacion.idCentroEntrega', '=', 'c_centrosdeentrega.id')
        ->leftJoin('c_centrosdeentrega AS ce', 'entregas.idCentroEntrega', '=', 'ce.id')
        ->leftJoin('c_periodosdeentrega', 'entregas.idPeriodoEntrega', '=', 'c_periodosdeentrega.id')
        ->select('entregas.id as idEntrega','documentacion.id as idDocumentacion','c_periodos.Descripcion as periodo','entregas.Direccion', 'c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad','c_centrosdeentrega.Descripcion as centroentrega','ce.Descripcion as centroentregaentrega','c_centrosdeentrega.Direccion as direccioncentroentrega','entregas.comentarioEntrega as comentario',DB::raw('DATE_SUB(entregas.created_at, INTERVAL 5 HOUR) as fechaEntrega'),'c_periodosdeentrega.Descripcion as periodoEntrega','entregas.Donado as donado')
        ->where('documentacion.PersonaId',$id)
        ->get();

        // $persona = Persona::find($id);

        // $fechaEmpaDisor = explode(" ",$persona->created_at);
        // $fechaEmpadArray = explode("-",$fechaEmpaDisor[0]);
        // $fechaEmpadronamiento = "$fechaEmpadArray[2]-$fechaEmpadArray[1]-$fechaEmpadArray[0]";

        // <td colspan="10" style="text-align: center; padding-top: 2px; padding-bottom: 0; color: black;"><h4> FECHA DE EMPADRONAMIENTO: '.$fechaEmpadronamiento.'</h4></td>
        if (count($listaentregas) > 0) {
            $listaentregasstring =
                '<h5 class="card-title" align="center">LISTA DE ENTREGAS</h5>
                    <br>
                    <table class="table">';
                        if (count($listaentregas) > 1 || $listaentregas[0]->idEntrega !== null) {
                            $listaentregasstring .='<tr class="table-dark">
                        </tr>
                        <tr>
                            <th>FOLIO</th><th>MUNICIPIO - LOCALIDAD</th><th>DIRECCION</th><th>DONADA</th><th>BIMESTRE</th><th>FECHA ENTREGA</th><th>PERIODO</th><th>CENTRO DE ENTREGA</th><th>OBSERVACIÓN</th><th>FOTO</th>
                        </tr>';
                        }

                        $validatelastent = 1;

                        foreach ($listaentregas as $entrega ) {

                            if ($entrega->idEntrega !== null){
                                $listaentregasstring .='
                                <tr>
                                    <td> '.($entrega->idDocumentacion != null ? $entrega->idDocumentacion : "N/D").' </td>
                                    <td> '.($entrega->municipio != null ? $entrega->municipio : "N/D").' - '.($entrega->localidad != null ? $entrega->localidad : "N/D").' </td>
                                    <td> '.($entrega->Direccion != null? $entrega->Direccion : "N/D").'</td>
                                    <td> '.($entrega->donado == 1 ? 'Donado' : 'Pagado').' </td>
                                    <td> '.($entrega->periodoEntrega != null ? $entrega->periodoEntrega : "N/D").'</td>
                                    <td> '.($entrega->fechaEntrega != null ? $entrega->fechaEntrega : "N/D").'</td>
                                    <td> '.($entrega->periodo != null ? $entrega->periodo : "N/D").'</td>
                                    <td> '.($entrega->centroentregaentrega != null ? $entrega->centroentregaentrega : "N/D").'</td>
                                    <td> '.($entrega->comentario != null ? $entrega->comentario : "N/D").'</td>
                                    <td> '.(($entrega->periodo == 2021 || $entrega->periodo == 2022) ?'<a role="button" href="/2022/documentacion/download/fotoentrega/'.$id.'/'.$entrega->idDocumentacion.'" class="btn btn-primary" target="_blank"><span style="font-size: 1.2em; color: white;" class="fa fa-eye"></span></a></td>':'N/D' ).'</td>
                                </tr>';

                            }else{
                                $listaentregasstring .='
                                <tr>
                                    <td colspan="7">
                                        Folio: '.$entrega->idDocumentacion.'
                                    </td>
                                    <td colspan="3">
                                        <button style="color: white" id="editarDoc" class="btn btn-warning mb-1" data-folio="'.$entrega->idDocumentacion.'">Documentacion</button>';
                                        //3 lineas arriba
                                        // Folio: '.$entrega->idDocumentacion.' - Centro de Entrega: <strong>'.$entrega->centroentrega.'</strong> - Direcccion: '.$entrega->direccioncentroentrega.'
                                        if (Auth::check()){
                                            $entregacontroller = new EntregaController;
                                            if($entregacontroller->verifyRequiredDocuments($entrega->idDocumentacion) == 1){
                                                $listaentregasstring .='<button style="color: white" id="entregaenupdatebtn" class="btn btn-success mb-1" data-folio="'.$entrega->idDocumentacion.'">Entrega</button>';
                                                // if (Auth::user()->tipoUsuarioId == 0) {
                                                    $listaentregasstring .='<button style="color: white" id="entregaenupdatedocbtn" class="btn btn-info mb-1" data-folio="'.$entrega->idDocumentacion.'">Entrega Posterior</button>';
                                                // }
                                            }
                                        }
                                    $listaentregasstring .='</td>
                                </tr>
                                <tr class="table-dark">
                                    <td colspan="10"></td>
                                </tr>
                                <tr>
                                    <td colspan="10">
                                        <p>Para recoger su apoyo alimentario por favor esté pendiente de las fechas y horarios de entrega en su municipio y acuda al centro de entrega abierto más cercano a su domicilio.<br>
                                        Podrá verificar la ubicación de los centros de entrega abiertos en la página oficial del Programa Hambre Cero en el PASO 4 y los datos bancarios de la cuenta donde deberá realizar el pago de la cuota de recuperación en el PASO 3.<br>
                                        Recuerde presentarse al centro de entrega con los documentos originales que registró en la plataforma de Hambre Cero, únicamente para el cotejo de información.<br>
                                        El recibo de pago de cuota de recuperación lo deberá presentar también en original y éste se quedará en el centro de entrega.</p>
                                        <p>Página oficial del Programa Hambre Cero:<a href="https://qroo.gob.mx/sedeso/hambreceroquintanaroo">https://qroo.gob.mx/sedeso/hambreceroquintanaroo</a></p>
                                        <p>Redes sociales oficiales de la Secretaría de Desarrollo Social de Quintana Roo:
                                        Facebook <a href="https://www.facebook.com/SedesoQroo/">https://www.facebook.com/SedesoQroo/</a>
                                        Twitter <a href="https://twitter.com/sedeso_qroo">https://twitter.com/sedeso_qroo</a></p>
                                    </td>
                                </tr>';
                                // <p>Favor de estar pendiente de las fechas de entrega de despensas que serán publicadas en la página oficial del Programa Hambre Cero: <a href="https://qroo.gob.mx/sedeso/hambreceroquintanaroo">https://qroo.gob.mx/sedeso/hambreceroquintanaroo</a> y en las redes sociales oficiales de la Secretaría de Desarrollo Social de Quintana Roo: en Facebook <a href="https://www.facebook.com/SedesoQroo/">https://www.facebook.com/SedesoQroo/</a> y en Twitter <a href="https://twitter.com/sedeso_qroo">https://twitter.com/sedeso_qroo</a></p>
                                //         <p>Verifique en el portal oficial del Programa Hambre Cero, la ubicación del centro de entrega (PASO 4) que le corresponde y los datos bancarios de la cuenta donde deberá realizar el pago de la cuota de recuperación (PASO 3).</p>
                                //         <p>Recuerde presentarse al centro de entrega asignado con los documentos que registró en original, únicamente para su cotejo de información. El recibo de pago de cuota de recuperación lo debe presentar también en original y se quedará en el centro de entrega.</p>

                                $validatelastent = 0;

                            }
                        }
                        $listaentregasstring .='</table>';

                    if ($validatelastent == 1){
                        $listaentregasstring .='
                        <br>
                        <a class="btn btn-success" id="solicitarD" name="solicitarD"  role="button" aria-pressed="true">Subir Documentos</a>';
                    }
        } else {
            $listaentregasstring ='<a class="btn btn-success" id="solicitarD" name="solicitaD" role="button" aria-pressed="true">Subir Documentos</a>';
        }

        return $listaentregasstring;
    }

    public function findCurp($curp){
        return DB::table('personas')
        ->select('personas.password','personas.id','personas.CURP')
        ->where("personas.CURP", $curp)
        ->get();
    }


    ////dibuja el html de los documentos
    public function buildFormDocumentos(Request $request){
        $folio = $request->get('folio');

        $documentacion = Documentacion::find($folio);

        $pathIdPersona = "documentacion/$documentacion->PersonaId";
        $pathIdDocumentacion = $pathIdPersona."/$folio";

        $htmlDocumentos = '
            <h5 class="card-title" align="center">EDICION DE DOCUMENTOS</h5>
			<form id="editDocumentosForm" action="#" method="#" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="'.csrf_token().'" />';

            if(Auth::check()){
                $htmlDocumentos .= '
                <div class="form-row pb-2">
                    <div class="col-md-12">
                        <input type="checkbox" id="donado" name="donado" '.($documentacion->Donado == 1?'checked':'').' class="chkToggle" data-onstyle="info" data-offstyle="success" data-on="Donado" data-off="Pagado">
                    </div>
                </div>';
            }
            $htmlDocumentos .= '<div class="form-row pb-2">';

            $docfind = $this->locateImg($pathIdPersona,'identificacio_oficial');

            // if (Storage::disk('public')->exists($pathIdPersona."/identificacio_oficial.pdf")) {
                //     $htmlDocumentos .= '
                //         <div class="col-md-11 pt-2">
                //             <a href="/2022/documentacion/download/identificacio_oficial.pdf/'.$documentacion->PersonaId.'" class="link-info" target="_blank">identificacion frente</a>
                //         </div><div class="col-md-1">
                //             <button data-name="IdentificacionFile" data-docname="identificacio_oficial.pdf" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //         </div>';
                // } elseif (Storage::disk('public')->exists($pathIdPersona."/identificacio_oficial.jpg")) {
                //     $htmlDocumentos .= '
                //         <div class="col-md-11 pt-2">
                //             <a href="/2022/documentacion/download/identificacio_oficial.jpg/'.$documentacion->PersonaId.'" class="link-info" target="_blank">Identificacion frente</a>
                //         </div>
                //         <div class="col-md-1">
                //             <button data-name="IdentificacionFile" data-docname="identificacio_oficial.jpg" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //         </div>';
            // }
            if ($docfind[0]) {
                    $htmlDocumentos .= '
                        <div class="col-md-11 pt-2">
                            <a href="/2022/documentacion/download/identificacio_oficial/'.$documentacion->PersonaId.'" class="link-info" target="_blank">identificacion frente</a>
                        </div><div class="col-md-1">
                            <button data-name="IdentificacionFile" data-docname="identificacio_oficial" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                        </div>';
            } else {
                $htmlDocumentos .= '
                    <div class="col-md-11">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="IdentificacionFile" name="IdentificacionFile" >
                            <label class="custom-file-label" for="IdentificacionFile" data-browse="Buscar documento">Identificacion (parte frontal)</label>
                        </div>
                    </div>';
                if(Auth::check()){
                    $htmlDocumentos .= '<div class="col-md-1">
                        <button data-name="IdentificacionFile" class="btn btn-warning btncamera" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-camera"></span></button>
                    </div>';
                }
            }
            $htmlDocumentos .= '</div>
                                <div class="form-row pb-2">';

            // if (Storage::disk('public')->exists("$pathIdPersona/identificacion_atras_oficial.pdf")) {
                //     $htmlDocumentos .= '
                //         <div class="col-md-11 pt-2">
                //             <a href="/2022/documentacion/download/identificacion_atras_oficial.pdf/'.$documentacion->PersonaId.'" class="link-info" target="_blank">Identificacion atras</a>
                //         </div>
                //         <div class="col-md-1">
                //             <button data-name="IdentificacionatrasFile" data-docname="identificacion_atras_oficial.pdf" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //         </div>';
                // } elseif (Storage::disk('public')->exists("$pathIdPersona/identificacion_atras_oficial.jpg")) {
                //     $htmlDocumentos .= '
                //         <div class="col-md-11 pt-2">
                //             <a href="/2022/documentacion/download/identificacion_atras_oficial.jpg/'.$documentacion->PersonaId.'" class="link-info" target="_blank">Identificacion atras</a>
                //         </div>
                //         <div class="col-md-1">
                //             <button data-name="IdentificacionatrasFile" data-docname="identificacion_atras_oficial.jpg" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //         </div>';
            // }
            $docfind = $this->locateImg($pathIdPersona,'identificacion_atras_oficial');
            if ($docfind[0]) {
                $htmlDocumentos .= '
                    <div class="col-md-11 pt-2">
                        <a href="/2022/documentacion/download/identificacion_atras_oficial/'.$documentacion->PersonaId.'" class="link-info" target="_blank">Identificacion atras</a>
                    </div>
                    <div class="col-md-1">
                        <button data-name="IdentificacionatrasFile" data-docname="identificacion_atras_oficial" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                    </div>';
            }else {
                $htmlDocumentos .= '
                    <div class="col-md-11">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="IdentificacionatrasFile" name="IdentificacionatrasFile" >
                            <label class="custom-file-label" for="IdentificacionatrasFile" data-browse="Buscar documento">Identificacion (parte trasera)</label>
                        </div>
                    </div>';
                if(Auth::check()){
                    $htmlDocumentos .= '<div class="col-md-1">
                        <button data-name="IdentificacionatrasFile" class="btn btn-warning btncamera" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-camera"></span></button>
                    </div>';
                }
            }

            $htmlDocumentos .= '</div>
                                <div class="form-row pb-2">';

            // if (Storage::disk('public')->exists("$pathIdPersona/comprobantedomicilio.pdf")) {
                //     $htmlDocumentos .= '
                //             <div class="col-md-11 pt-2">
                //                 <a href="/2022/documentacion/download/comprobantedomicilio.pdf/'.$documentacion->PersonaId.'" class="link-info" target="_blank">Comprobante de domicilio</a>
                //             </div>
                //             <div class="col-md-1">
                //                 <button data-name="CompDomFile" data-docname="comprobantedomicilio.pdf" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //             </div>';
                // } elseif (Storage::disk('public')->exists("$pathIdPersona/comprobantedomicilio.jpg")) {
                //     $htmlDocumentos .= '
                //             <div class="col-md-11 pt-2">
                //                 <a href="/2022/documentacion/download/comprobantedomicilio.jpg/'.$documentacion->PersonaId.'" class="link-info" target="_blank">Comprobante de domicilio</a>
                //             </div>
                //             <div class="col-md-1">
                //                 <button data-name="CompDomFile" data-docname="comprobantedomicilio.jpg" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //             </div>';
            // }
            $docfind = $this->locateImg($pathIdPersona,'comprobantedomicilio');
            if ($docfind[0]) {
                    $htmlDocumentos .= '
                            <div class="col-md-11 pt-2">
                                <a href="/2022/documentacion/download/comprobantedomicilio/'.$documentacion->PersonaId.'" class="link-info" target="_blank">Comprobante de domicilio</a>
                            </div>
                            <div class="col-md-1">
                                <button data-name="CompDomFile" data-docname="comprobantedomicilio" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                            </div>';
            } else {
                $htmlDocumentos .= '
                        <div class="col-md-11">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="CompDomFile" name="CompDomFile" lang="es">
                                <label class="custom-file-label" for="CompDomFile" data-browse="Buscar documento">Comprobante de Domicilio</label>
                            </div>
                        </div>';
                    if(Auth::check()){
                        $htmlDocumentos .= '<div class="col-md-1">
                            <button data-name="CompDomFile" class="btn btn-warning btncamera" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-camera"></span></button>
                        </div>';
                    }
            }

            $htmlDocumentos .= '</div>
                                <div class="form-row pb-2">';

            // if (Storage::disk('public')->exists("$pathIdPersona/curp.pdf")) {
                //     $htmlDocumentos .= '
                //             <div class="col-md-11 pt-2">
                //                 <a href="/2022/documentacion/download/curp.pdf/'.$documentacion->PersonaId.'" class="link-info" target="_blank">CURP</a>
                //             </div>
                //             <div class="col-md-1">
                //                 <button data-name="CURPFile" data-docname="curp.pdf" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //             </div>';
                // } elseif (Storage::disk('public')->exists("$pathIdPersona/curp.jpg")) {
                //     $htmlDocumentos .= '
                //             <div class="col-md-11 pt-2">
                //                 <a href="/2022/documentacion/download/curp.jpg/'.$documentacion->PersonaId.'" class="link-info" target="_blank">CURP</a>
                //             </div>
                //             <div class="col-md-1">
                //                 <button data-name="CURPFile" data-docname="curp.jpg" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //             </div>';
            // }
            $docfind = $this->locateImg($pathIdPersona,'curp');
            if ($docfind[0]) {
                    $htmlDocumentos .= '
                            <div class="col-md-11 pt-2">
                                <a href="/2022/documentacion/download/curp/'.$documentacion->PersonaId.'" class="link-info" target="_blank">CURP</a>
                            </div>
                            <div class="col-md-1">
                                <button data-name="CURPFile" data-docname="curp" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                            </div>';
            } else {
                $htmlDocumentos .= '
                        <div class="col-md-11">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="CURPFile" name="CURPFile" lang="es">
                                <label class="custom-file-label" for="CURPFile" data-browse="Buscar documento">CURP</label>
                            </div>
                        </div>';
                    if(Auth::check()){
                        $htmlDocumentos .= '<div class="col-md-1">
                            <button data-name="CURPFile" class="btn btn-warning btncamera" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-camera"></span></button>
                        </div>';
                    }
            }

            $htmlDocumentos .= '</div>
                                <div class="form-row pb-2">';

            // if (Storage::disk('public')->exists("$pathIdDocumentacion/comprobantepago.pdf")) {
                //     $htmlDocumentos .= '
                //             <div class="col-md-11 pt-2">
                //                 <a href="/2022/documentacion/download/comprobantepago.pdf/'.$documentacion->PersonaId.'/'.$folio.'" class="link-info" target="_blank">comprobante de pago</a>
                //             </div>
                //             <div class="col-md-1">
                //                 <button data-name="ComPagFile" data-docname="comprobantepago.pdf" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //             </div>';
                // } elseif (Storage::disk('public')->exists("$pathIdDocumentacion/comprobantepago.jpg")) {
                //     $htmlDocumentos .= '
                //             <div class="col-md-11 pt-2">
                //                 <a href="/2022/documentacion/download/comprobantepago.jpg/'.$documentacion->PersonaId.'/'.$folio.'" class="link-info" target="_blank">comprobante de pago</a>
                //             </div>
                //             <div class="col-md-1">
                //                 <button data-name="ComPagFile" data-docname="comprobantepago.jpg" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //             </div>';
            // }
            $docfind = $this->locateImg($pathIdDocumentacion,'comprobantepago');
            if ($docfind[0]) {
                    $htmlDocumentos .= '
                            <div class="col-md-11 pt-2">
                                <a href="/2022/documentacion/download/comprobantepago/'.$documentacion->PersonaId.'/'.$folio.'" class="link-info" target="_blank">comprobante de pago</a>
                            </div>
                            <div class="col-md-1">
                                <button data-name="ComPagFile" data-docname="comprobantepago" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                            </div>';
            } else {
                $htmlDocumentos .= '
                        <div class="col-md-11">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="ComPagFile" name="ComPagFile" lang="es">
                                <label class="custom-file-label" for="ComPagFile" data-browse="Buscar documento">Comprobante de pago </label>
                            </div>
                        </div>';
                    if(Auth::check()){
                        $htmlDocumentos .= '<div class="col-md-1">
                            <button data-name="ComPagFile" class="btn btn-warning btncamera" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-camera"></span></button>
                        </div>';
                    }
            }

            $htmlDocumentos .= '</div>
                                <div class="form-row pb-2">';

            // if (Storage::disk('public')->exists("$pathIdPersona/constanciaautoridad.pdf")) {
                //     $htmlDocumentos .= '
                //             <div class="col-md-11 pt-2">
                //                 <a href="/2022/documentacion/download/constanciaautoridad.pdf/'.$documentacion->PersonaId.'" class="link-info" target="_blank">constancia de autoridad local</a>
                //             </div>
                //             <div class="col-md-1">
                //                 <button data-name="ConstAutFiled" data-docname="constanciaautoridad.pdf" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //             </div>';
                // } elseif (Storage::disk('public')->exists("$pathIdPersona/constanciaautoridad.jpg")) {
                //     $htmlDocumentos .= '
                //             <div class="col-md-11 pt-2">
                //                 <a href="/2022/documentacion/download/constanciaautoridad.jpg/'.$documentacion->PersonaId.'" class="link-info" target="_blank">constancia de autoridad local</a>
                //             </div>
                //             <div class="col-md-1">
                //                 <button data-name="ConstAutFiled" data-docname="constanciaautoridad.jpg" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                //             </div>';
            // }
            $docfind = $this->locateImg($pathIdPersona,'constanciaautoridad');
            if ($docfind[0]) {
                    $htmlDocumentos .= '
                            <div class="col-md-11 pt-2">
                                <a href="/2022/documentacion/download/constanciaautoridad/'.$documentacion->PersonaId.'" class="link-info" target="_blank">constancia de autoridad local</a>
                            </div>
                            <div class="col-md-1">
                                <button data-name="ConstAutFiled" data-docname="constanciaautoridad" class="btn btn-danger btndelfile" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-trash-alt"></span></button>
                            </div>';
            } else {
                $htmlDocumentos .= '
                        <div class="col-md-11">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="ConstAutFiled" name="ConstAutFiled" lang="es">
                                <label class="custom-file-label" for="ConstAutFiled" data-browse="Buscar documento">Constancia de la autoridad local </label>
                            </div>
                        </div>';
                    if(Auth::check()){
                        $htmlDocumentos .= '<div class="col-md-1">
                            <button data-name="ConstAutFiled" class="btn btn-warning btncamera" type="button" aria-pressed="true"><span style="font-size: 1.2em; color: white;" class="fa fa-camera"></span></button>
                        </div>';
                    }
            }

            $htmlDocumentos .= '</div>
                </br>
                <button type="submit" class="btn btn-success">Guardar Documentos</button>
            </form>';

        return  $htmlDocumentos;
    }

    ////manda a buscar otro metodo que guarda los documentos
    public function updateDocumentacion(Request $request, $idDocumentacion){

        $this->validateDocumentFormat($request);

        $documentacion = Documentacion::find($idDocumentacion);
        $documentacion->Donado = ($request->get('donado') == 'on')?1:0;
        $documentacion->EncuestadorId = (Auth::check())?Auth::user()->id:0;
        $documentacion->save();

        return $this->storeDocuments($request, $idDocumentacion);
    }

    ////
    public function storeDocuments($request, $idDocumentacion){

        $documentacion = Documentacion::find($idDocumentacion);

        $pathIdPersona = "documentacion/$documentacion->PersonaId";
        $pathIdDocumentacion = "documentacion/$documentacion->PersonaId/$idDocumentacion";

        if ($request->hasFile('IdentificacionFile')) {
            $extension = strtolower($request->file('IdentificacionFile')->getClientOriginalExtension());
            $request->file('IdentificacionFile')->storeAs($pathIdPersona,'identificacio_oficial'.'.'.$extension);
        } elseif ($request->has('IdentificacionFile')) {
            $image = $request->get('IdentificacionFile');
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'identificacio_oficial.jpg';
            Storage::disk('public')->put($pathIdPersona."/".$imageName, base64_decode($image));
        }

        if ($request->hasFile('IdentificacionatrasFile')) {
            $extension =  strtolower($request->file('IdentificacionatrasFile')->getClientOriginalExtension());
            $request->file('IdentificacionatrasFile')->storeAs($pathIdPersona,'identificacion_atras_oficial'.'.'.$extension);
        } elseif ($request->has('IdentificacionatrasFile')) {
            $image = $request->get('IdentificacionatrasFile');
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'identificacion_atras_oficial.jpg';
            Storage::disk('public')->put($pathIdPersona."/".$imageName, base64_decode($image));
        }

        if ($request->hasFile('CompDomFile')) {
            $extension =  strtolower($request->file('CompDomFile')->getClientOriginalExtension());
            $request->file('CompDomFile')->storeAs($pathIdPersona,'comprobantedomicilio'.'.'.$extension);
        } elseif ($request->has('CompDomFile')) {
            $image = $request->get('CompDomFile');
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'comprobantedomicilio.jpg';
            Storage::disk('public')->put($pathIdPersona."/".$imageName, base64_decode($image));
        }

        if ($request->hasFile('CURPFile')) {
            $extension =  strtolower($request->file('CURPFile')->getClientOriginalExtension());
            $request->file('CURPFile')->storeAs($pathIdPersona,'curp'.'.'.$extension);
        } elseif ($request->has('CURPFile')) {
            $image = $request->get('CURPFile');
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'curp.jpg';
            Storage::disk('public')->put($pathIdPersona."/".$imageName, base64_decode($image));
        }

        if ($request->hasFile('ComPagFile')) {
            $extension =  strtolower($request->file('ComPagFile')->getClientOriginalExtension());
            $request->file('ComPagFile')->storeAs($pathIdDocumentacion,'comprobantepago'.'.'.$extension);
        } elseif ($request->has('ComPagFile')) {
            $image = $request->get('ComPagFile');
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'comprobantepago.jpg';
            Storage::disk('public')->put($pathIdDocumentacion."/".$imageName, base64_decode($image));
        }

        if ($request->hasFile('ConstAutFiled')) {
            $extension =  strtolower($request->file('ConstAutFiled')->getClientOriginalExtension());
            $request->file('ConstAutFiled')->storeAs($pathIdPersona,'constanciaautoridad'.'.'.$extension);
        } elseif ($request->has('ConstAutFiled')) {
            $image = $request->get('ConstAutFiled');
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'constanciaautoridad.jpg';
            Storage::disk('public')->put($pathIdPersona."/".$imageName, base64_decode($image));
        }
        // if ($request->hasFile('FotoEntrega')) {
        //     $dataname5 = explode('.',$request->file('FotoEntrega')->getClientOriginalName());
        //     $request->file('FotoEntrega')->storeAs($pathIdDocumentacion,'fotoentrega'.'.'.$dataname5[1]);
        // }

        $entregacontroller = new EntregaController;
        return [$entregacontroller->verifyRequiredDocuments($idDocumentacion,$documentacion->PersonaId),'Se guardaron lo documentos adjuntados'];//,Auth::user()->tipoUsuarioId]; //$this->buildListaEntregas($id);
    }

    public function downloadDocument($document,$idPersona,$idDocumentacion = null){
        $pathDocumento = "documentacion/".$idPersona.($idDocumentacion?"/".$idDocumentacion:"")."/";

        $locate = $this->locateImg($pathDocumento,$document);

        if ($locate[0]) {
            return  response()->file(Storage::path($pathDocumento.$locate[1]));
        } else {
            trigger_error("Imagen no encontrada", E_USER_ERROR);
        }
    }

    public function deleteDocument(Request $request, $document){

        $folio = $request->get('folio');
        $nameatribute = $request->get('nameatr');
        $nombreDocumento = '';

        $documentacion = Documentacion::find($folio);
        $pathDelete = "documentacion/$documentacion->PersonaId";

        switch ($nameatribute) {
            case 'IdentificacionFile':
                $nombreDocumento = "Identificacion (parte frontal)";
                break;
            case 'IdentificacionatrasFile':
                $nombreDocumento = "Identificacion (parte trasera)";
                break;
            case 'CompDomFile':
                $nombreDocumento = "Comprobante de Domicilio";
                break;
            case 'CURPFile':
                $nombreDocumento = "CURP";
                break;
            case 'ComPagFile':
                $nombreDocumento = "Comprobante de pago ";
                $pathDelete = "documentacion/$documentacion->PersonaId/$folio";
                break;
            case 'ConstAutFiled':
                $nombreDocumento = "Constancia de la autoridad local ";
                break;
            case 'FotoEntrega':
                $nombreDocumento = "Foto Entrega";
                $pathDelete = "documentacion/$documentacion->PersonaId/$folio";
                break;
            default:
                $nombreDocumento = "";
                break;
        }

        $locate = $this->locateImg($pathDelete,$document);
        $document = $locate[1];

        Storage::disk('public')->delete($pathDelete.'/'.$document);

        $htmlReturn='<div class="col-md-11">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="'.$nameatribute.'" name="'.$nameatribute.'" >
                            <label class="custom-file-label" for="'.$nameatribute.'" data-browse="Buscar documento">'.$nombreDocumento.'</label>
                        </div>
                    </div>';
                    if(Auth::check()){
                        $htmlReturn .='<div class="col-md-1">
                            <button data-name="'.$nameatribute.'" class="btn btn-warning btncamera" type="button" aria-pressed="true" ><span style="font-size: 1.2em; color: white;" class="fa fa-camera"></span></button>
                        </div>';
                    }

        $respuesta = 'Se elimino exitosamente el documento: </br>'.$nombreDocumento;

        $entregacontroller = new EntregaController;

        return [$htmlReturn,$respuesta,$entregacontroller->verifyRequiredDocuments($folio,$documentacion->PersonaId)];
    }

    public function validateDocumentFormat($request){

        if ($request->hasFile('IdentificacionFile')) {
            Validator::make($request->all(), [
                'IdentificacionFile' => ['mimes:jpg,jpeg,pdf',' required','max:2000'],
            ])->validate();
        }

        if ($request->hasFile('IdentificacionatrasFile')) {
            Validator::make($request->all(), [
                'IdentificacionatrasFile' => ['mimes:jpg,jpeg,pdf',' required','max:2000'],
            ])->validate();
        }

        if ($request->hasFile('CompDomFile')) {
            Validator::make($request->all(), [
                'CompDomFile' => ['mimes:jpg,jpeg,pdf',' required','max:2000'],
            ])->validate();
        }

        if ($request->hasFile('CURPFile')) {
            Validator::make($request->all(), [
                'CURPFile' => ['mimes:jpg,jpeg,pdf',' required','max:2000'],
            ])->validate();
        }

        if ($request->hasFile('ComPagFile')) {
            Validator::make($request->all(), [
                'ComPagFile' => ['mimes:jpg,jpeg,pdf',' required','max:2000'],
            ])->validate();
        }

        if ($request->hasFile('ConstAutFiled')) {
            Validator::make($request->all(), [
                'ConstAutFiled' => ['mimes:jpg,jpeg,pdf',' required','max:2000'],
            ])->validate();
        }

    }

    public function locateImg($path,$archivo){ //pide el pad de la imagen y el nombre: busca si existe con alguno de los 3 formatos validos
        $arrayFormatos = ["pdf","jpg","jpeg"];
        foreach ($arrayFormatos as $formato) {
            if (Storage::disk('public')->exists("$path/$archivo.$formato")) {
                return[1,"$archivo.$formato"];
            }
        }
        return[0,0];
        // trigger_error("Error 103: Favor de reportarlo", E_USER_ERROR);
    }

    public function findLocalidades(Request $Request){

            $localidadesArray = [];
            $localidadesString = '';
            $localidadesStringHold = '';
            $coloniasString = '';
            $coloniasStringHold = '';

        if ($Request->get('from') == 0) {

            $localidadesString .= '<option value="" selected>Seleccione una opcion</option>';
            $coloniasString .= '<option value="" selected>Seleccione una opcion</option>';

            $localidades = DB::table('c_localidades')
                ->select('id', 'Descripcion')
                ->where('status', '=',1)
                ->where('MunicipioId', $Request->get('municipio'))
                ->orderBy('Descripcion', 'ASC')
                ->get();

            foreach ($localidades as $localidad) {
                $localidadesString .= '<option value="'.$localidad->id.'">'.$localidad->Descripcion.'</option>';
                array_push($localidadesArray, $localidad->id);
            }

            $colonias = DB::table('c_colonias')
                ->select('id', 'Descripcion')
                ->where('status', '=',1)
                ->whereIn('LocalidadId', $localidadesArray)
                ->orderBy('Descripcion', 'ASC')
                ->get();

            foreach ($colonias as $colonia) {
                $coloniasString .= '<option value="'.$colonia->id.'">'.$colonia->Descripcion.'</option>';
            }

            return [$localidadesString, $coloniasString];

        } else {
            $localidadesString .= '<option value="">Seleccione una opcion</option>';
            $coloniasString .= '<option value="">Seleccione una opcion</option>';

            if (Auth::check()) {

                $localidades = DB::table('c_localidades')
                    ->select('id', 'Descripcion')
                    ->where('MunicipioId', $Request->get('municipio'))
                    ->whereIn('status', [1, 2])
                    ->orderBy('Descripcion', 'ASC')
                    ->get();

                foreach ($localidades as $localidad) {
                    if ($Request->get('localidad') == $localidad->id) {//si la localidad ya es correcta entonces vacia el array y mete ese un unico valor para que al hacer la consulta de colonias devuelva solo las de esa localidad
                        $localidadesArray = [];
                        array_push($localidadesArray, $localidad->id);
                        break;
                    } else {
                        array_push($localidadesArray, $localidad->id);
                    }
                }

                $colonias = DB::table('c_colonias')
                    ->select('id', 'Descripcion')
                    ->whereIn('LocalidadId', $localidadesArray)
                    ->orderBy('Descripcion', 'ASC')
                    ->get();

            } else {

                $localidades = DB::table('c_localidades')
                    ->select('id', 'Descripcion')
                    ->where('status', 1)
                    ->where('MunicipioId', $Request->get('municipio'))
                    ->orderBy('Descripcion', 'ASC')
                    ->get();

                foreach ($localidades as $localidad) {
                    if ($Request->get('localidad') == $localidad->id) {//si la localidad ya es correcta entonces vacia el array y mete ese un unico valor para que al hacer la consulta de colonias devuelva solo las de esa localidad
                        $localidadesArray = [];
                        array_push($localidadesArray, $localidad->id);
                        break;
                    } else {
                        array_push($localidadesArray, $localidad->id);
                    }
                }

                $colonias = DB::table('c_colonias')
                    ->select('id', 'Descripcion')
                    ->where('status', '=',1)
                    ->whereIn('LocalidadId', $localidadesArray)
                    ->orderBy('Descripcion', 'ASC')
                    ->get();


            }

            foreach ($localidades as $localidad) {
                if ($Request->get('localidad') == $localidad->id) {
                    $localidadesString .= '<option value="'.$localidad->id.'" selected>'.$localidad->Descripcion.'</option>';
                } else {
                    $localidadesString .= '<option value="'.$localidad->id.'">'.$localidad->Descripcion.'</option>';
                }
            }

            foreach ($colonias as $colonia) {
                if ($Request->get('colonia') == $colonia->id) {
                    $coloniasString .= '<option value="'.$colonia->id.'" selected>'.$colonia->Descripcion.'</option>';
                } else {
                    $coloniasString .= '<option value="'.$colonia->id.'">'.$colonia->Descripcion.'</option>';
                }
            }

            return [$localidadesString, $coloniasString];
        }
    }

    public function findColonias(Request $Request){
        if ($Request->get('from') == 0) {
            $coloniasString = '<option value="" selected>Seleccione una opcion</option>';

            $colonias = DB::table('c_colonias')
            ->select('id', 'Descripcion')
            ->where('status', '=',1)
            ->where('LocalidadId', $Request->get('localidad'))
            ->orderBy('Descripcion', 'ASC')
            ->get();

            foreach ($colonias as $colonia) {
                if ($Request->get('colonia') == $colonia->id) {
                    $coloniasString .= '<option value="'.$colonia->id.'" selected>'.$colonia->Descripcion.'</option>';
                } else {
                    $coloniasString .= '<option value="'.$colonia->id.'">'.$colonia->Descripcion.'</option>';
                }
            }

            return $coloniasString;

        } else {
            $coloniasString = '<option value="" >Seleccione una opcion</option>';

            if (Auth::check()) {
                $colonias = DB::table('c_colonias')
                    ->select('id', 'Descripcion')
                    ->where('LocalidadId', $Request->get('localidad'))
                    ->orderBy('Descripcion', 'ASC')
                    ->get();
            } else {
                $colonias = DB::table('c_colonias')
                    ->select('id', 'Descripcion')
                    ->where('status', '=',1)
                    ->where('LocalidadId', $Request->get('localidad'))
                    ->orderBy('Descripcion', 'ASC')
                    ->get();
            }

            foreach ($colonias as $colonia) {
                if ($Request->get('colonia') == $colonia->id) {
                    $coloniasString .= '<option value="'.$colonia->id.'" selected>'.$colonia->Descripcion.'</option>';
                } else {
                    $coloniasString .= '<option value="'.$colonia->id.'">'.$colonia->Descripcion.'</option>';
                }
            }

            return $coloniasString;
        }
    }
    public function findPersonasPorCoincidencia (Request $Request){
        $whereraw = null;
        // dd($Request);

        if ($Request->has('nombre') && !is_null($Request->get('nombre'))) {
            $whereraw .= "personas.Nombre LIKE '%".$Request->get('nombre')."%' ";
            if (($Request->has('apellido_p') && !is_null($Request->get('apellido_p'))) || ($Request->has('apellido_m') && !is_null($Request->get('apellido_m'))) || ($Request->has('curpParcial') && !is_null($Request->get('curpParcial')))) {
                $whereraw .= "AND ";
            }
        }
        if ($Request->has('apellido_p') && !is_null($Request->get('apellido_p'))) {
            $whereraw .= "personas.APaterno LIKE '%".$Request->get('apellido_p')."%' ";
            if (($Request->has('apellido_m') && !is_null($Request->get('apellido_m'))) || ($Request->has('curpParcial') && !is_null($Request->get('curpParcial')))) {
                $whereraw .= "AND ";
            }
        }
        if ($Request->has('apellido_m') && !is_null($Request->get('apellido_m'))) {
            $whereraw .= "personas.AMaterno LIKE '%".$Request->get('apellido_m')."%' ";
            if (($Request->has('curpParcial') && !is_null($Request->get('curpParcial')))) {
                $whereraw .= "AND ";
            }
        }
        if ($Request->has('curpParcial') && !is_null($Request->get('curpParcial'))) {
            $whereraw .= "personas.CURP LIKE '%".$Request->get('curpParcial')."%' ";

        }

        $result = DB::table('personas')
            ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
            ->leftJoin('c_municipios', 'personas.MunicipioId', '=', 'c_municipios.id')
            ->leftJoin('c_localidades', 'personas.LocalidadId', '=', 'c_localidades.id')
            ->select('personas.id', 'personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP')
            ->WhereRaw($whereraw)
            ->get();


        $listastring = "<br/><br/><h3>No se encontraron registros con esta información.<h3>";

        if($result->count() > 0){

            $listastring =  '<br/><table class="table table-hover" id="personasCoincidencia"><thead><tr class="table-info"><th>ID</th><th>NOMBRE</th><th>APELLIDO PATERNO</th><th>APELLIDO MATERNO</th><th>CURP</th></tr></thead><tbody>';

            foreach ($result as $beneficiario) {
                $listastring .='<tr>';
                    $listastring .='<td>'.($beneficiario->id != null? $beneficiario->id:"N/D").'</td>';
                    $listastring .='<td>'.($beneficiario->Nombre != null? $beneficiario->Nombre:"N/D").'</td>';
                    $listastring .='<td>'.($beneficiario->APaterno!= null? $beneficiario->APaterno:"N/D").'</td>';
                    $listastring .='<td>'.($beneficiario->AMaterno!= null? $beneficiario->AMaterno:"N/D").'</td>';
                    $listastring .='<td>'.($beneficiario->CURP != null? $beneficiario->CURP:"N/D").'</td>';
                $listastring .='</tr>';
            }
            $listastring .='</tbody></table>';
        }

        return $listastring;
    }

}

