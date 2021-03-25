<?php

namespace App\Http\Controllers\P2021;

use App\Http\Controllers\Controller;
use App\Http\Controllers\P2020\Admin\EntregaController;
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

use App\Models\Documentacion;
use App\Models\Entrega;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Auth;

use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

use function PHPUnit\Framework\isNull;

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
                return view('2021.cuestionario.index');        
            } else {
                return redirect('/periodo');
            }
        } else {
            return view('2021.cuestionario.index');        
        }
    }

    public function findPersona(Request $request){
        
        $curp = $request->get('curp');
        $pass = $request->get('pass');

        $persona = DB::table('personas')
            ->select('personas.password','personas.id','personas.CURP')
            ->where("personas.CURP", $curp)
            ->get();

            if ($persona->count() > 0) {
                if ($persona->count() == 1) {
                    if(is_null($persona[0]->password)){

                        if ($pass == $persona[0]->CURP) {
                            return $this->editPasswordPersona($persona[0]->id);
                            //return redirect("/registro/pass/{$persona[0]->id}/edit");
                        } else {
                            return view('2021.cuestionario.index',[
                                'errmsg'=> 'CURP o Contraseña incorrectos',
                                'curp'=> $curp
                                ]);
                        }
                    } else {
                        if (Hash::check($pass, $persona[0]->password)) {// verificar que sea la contraseña
                            return $this->edit($persona[0]->id);
                            //return redirect("/registro/{$persona[0]->id}/edit");
                        } else {
                            return view('2021.cuestionario.index',[
                                'errmsg'=> 'CURP o Contraseña incorrectos',
                                'curp'=> $curp
                                ]);
                        }
                    } 
                } else {
                    return view('2021.cuestionario.index',[
                        'errmsg'=>  "La persona registrada con este CURP presenta un inconveniente, favor de reportarlo",
                        'curp'=> $curp
                        ]);
                }
            } else {
                return $this->create($curp);//redirecciona a crate pero con la curp
                // return redirect('/registro/create');
            }
    }

    public function editPasswordPersona($id){

            $persona = Persona::find($id);
            if (is_null($persona->password)) {
                return view('2021.cuestionario.editPasswordPersona',['usuario'=> $id]);
            } else {
                return redirect('/registro');
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

            return view('2021.cuestionario.index',[
                'scssmsg'=>  'Se ha cambiado la contraseña del usuario, vuelva a ingresar.',
                'curp'=> $persona->CURP
                ]);

        } else {
            return redirect('/registro');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($curp = NULL)    
    {   
        $colonias = DB::table('c_colonias')
        ->select('c_colonias.*')
        ->whereNotIn('c_colonias.LocalidadId', [57,249])
        ->orderBy('c_colonias.Descripcion', 'ASC')
        ->get();

        return view('2021.cuestionario.encuesta',[
            'preguntas'=> C_Pregunta::all(),
            'estados'=> C_Estado::all(),
            'colonias'=> $colonias,
            // 'colonias'=> C_Colonia::all(),
            'localidades'=> C_Localidad::findMany([326,330,346,347,58,59,157,158,68,71,76,69,1,11,66]),   
            // 'localidades'=> C_Localidad::findMany([57,249]),   
            'municipios'=> C_Municipio::findMany([1,2,3,6,7,8,9,10,11]),
            // 'municipios'=> C_Municipio::findMany([5,4]),
            'estadosCiviles' => C_EstadoCivil::all(),
            'estudios'=> C_GradoDeEstudio::all(),
            'curp' => $curp
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
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
        $persona->PeriodoId = 3;
        
        $encuesta = new Encuesta();
        $encuesta->Pregunta_33 = $request->get('cuantas_per_viven_casa');
        $encuesta->EncuestadorId = (Auth::check())?Auth::user()->id:0;

        $persona->save();// guarda los datos de la persona

        $idpersona = $persona::latest('id')->first(); //busca el id del ultimo registro persona guardado
        $encuesta->PersonaId =  $idpersona["id"];

        $encuesta->save(); // guarda las encuestas

        return $idpersona["id"];
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
        $colonias = DB::table('c_colonias')
        ->select('c_colonias.*')
        ->whereNotIn('c_colonias.LocalidadId', [57,249])
        ->orderBy('c_colonias.Descripcion', 'ASC')
        ->get();

        $personaCollection = DB::table('personas')
        ->leftjoin('encuestas', 'personas.id', '=', 'encuestas.personaId')
        ->select('personas.*', 'encuestas.Pregunta_33')
        ->where('personas.id', $id)
        ->get();

        $personaCollection[0]->Intentos = 1;

        $listaentregas = DB::table('documentacion') //lista de entregados
        ->leftJoin('entregas', 'entregas.DocumentacionId', '=', 'documentacion.id')
        ->leftJoin('c_periodos', 'entregas.PeriodoId', '=', 'c_periodos.id')
        ->leftJoin('c_municipios', 'entregas.MunicipioId', '=', 'c_municipios.id')
        ->leftJoin('c_localidades', 'entregas.LocalidadId', '=', 'c_localidades.id')
        ->leftJoin('c_centrosdeentrega', 'documentacion.idCentroEntrega', '=', 'c_centrosdeentrega.id')
        ->select('entregas.id as idEntrega','documentacion.id as idDocumentacion','c_periodos.Descripcion as periodo','entregas.Direccion', 'c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad','c_centrosdeentrega.Descripcion as centroentrega','c_centrosdeentrega.Direccion as direccioncentroentrega')
        ->where('documentacion.PersonaId',$id)
        ->get();

        // $documentacion = Documentacion::where('PersonaId',$id)->orderBy('id', 'DESC')->first();
        // $entrega = Entrega::where('DocumentacionId',$documentacion->id)->first();

        return view('2021.cuestionario.encuestaUpdate',[
            'preguntas'=> C_Pregunta::all(),
            'estados'=> C_Estado::all(),
            'colonias'=> $colonias,
            // 'colonias'=> C_Colonia::all(),
            'localidades'=> C_Localidad::findMany([326,330,346,347,58,59,157,158,68,71,76,69,1,11,66]),   
            // 'localidades'=> C_Localidad::findMany([57,249]),   
            'municipios'=> C_Municipio::findMany([1,2,3,6,7,8,9,10,11]),
            // 'municipios'=> C_Municipio::findMany([5,4]),
            'estadosCiviles' => C_EstadoCivil::all(),
            'estudios'=> C_GradoDeEstudio::all(),
            'persona'=>$personaCollection,
            'listaentregas'=>$listaentregas
            // 'ultimaentrega'=>$entrega,
            // 'ultimadocumentacion'=>$documentacion
            ]);

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
    
            $pdf = \PDF::loadView('2020.cuestionario.formato2020bis', compact('preguntas','persona','estados','colonias','localidades','municipios','estadosCiviles','estudios'));
            $pdf->setPaper('letter', 'portrait');
            return $pdf->stream("Cuestionario.pdf");//, array("Attachment" => 0)); 
            // return $pdf->download('Cuestionario.pdf');
        
       
   }

   public function storeDocumentacion(Request $request, $id){

        $centroEntrega = DB::table('personas')
                ->leftjoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
                // ->leftjoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
                ->select('c_colonias.CentroEntregaId')
                ->where('personas.id', $id)
                ->get();


        $documentacion = new Documentacion();
        
        $documentacion->PersonaId = $id;
        $documentacion->idCentroEntrega = $centroEntrega[0]->CentroEntregaId;
        $documentacion->idPeriodoEntrega = 1;

        $documentacion->save();

        $path = "documentacion/$id/$documentacion->id";

        if ($request->hasFile('IdentificacionFile')) {
            $dataname1 = explode('.',$request->file('IdentificacionFile')->getClientOriginalName());
            $request->file('IdentificacionFile')->storeAs($path,'identificacio_oficial'.'.'.$dataname1[1]);
        }
        if ($request->hasFile('CURPFile')) {
            $dataname2 = explode('.',$request->file('CURPFile')->getClientOriginalName());
            $request->file('CURPFile')->storeAs($path,'curp'.'.'.$dataname2[1]);
        }
        if ($request->hasFile('CompDomFile')) {
            $dataname3 = explode('.',$request->file('CompDomFile')->getClientOriginalName());
            $request->file('CompDomFile')->storeAs($path,'comprobantedomicilio'.'.'.$dataname3[1]);
        }
        if ($request->hasFile('ComPagFile')) {
            $dataname4 = explode('.',$request->file('ComPagFile')->getClientOriginalName());
            $request->file('ComPagFile')->storeAs($path,'comprobantepago'.'.'.$dataname4[1]);
        }
        if ($request->hasFile('ConstAutFiled')) {
            $dataname5 = explode('.',$request->file('ConstAutFiled')->getClientOriginalName());
            $request->file('ConstAutFiled')->storeAs($path,'constanciaautoridad'.'.'.$dataname5[1]);
        }

        return $this->buildListaEntregas($id);
   }

    public function buildListaEntregas($id){

        $listaentregas = DB::table('documentacion') //lista de entregados
        ->leftJoin('entregas', 'entregas.DocumentacionId', '=', 'documentacion.id')
        ->leftJoin('c_periodos', 'entregas.PeriodoId', '=', 'c_periodos.id')
        ->leftJoin('c_municipios', 'entregas.MunicipioId', '=', 'c_municipios.id')
        ->leftJoin('c_localidades', 'entregas.LocalidadId', '=', 'c_localidades.id')
        ->leftJoin('c_centrosdeentrega', 'documentacion.idCentroEntrega', '=', 'c_centrosdeentrega.id')
        ->select('entregas.id as idEntrega','documentacion.id as idDocumentacion','c_periodos.Descripcion as periodo','entregas.Direccion', 'c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad','c_centrosdeentrega.Descripcion as centroentrega','c_centrosdeentrega.Direccion as direccioncentroentrega')
        ->where('documentacion.PersonaId',$id)
        ->get();

        if (count($listaentregas) > 0) {
            $listaentregasstring = 
                '<h5 class="card-title" align="center">CENTRO DE ENTREGA ASIGNADO</h5>
                    <br>
                    <table class="table table-hover">';
                        if (count($listaentregas) > 1 || $listaentregas[0]->idEntrega !== null) {
                            $listaentregasstring .='<tr>
                                    <th>FOLIO</th><th>MUNICIPIO</th><th>LOCALIDAD</th><th>DIRECCION</th><th>PERIODO</th><th>CENTRO DE ENTREGA</th>
                                </tr>';
                        }

                        $validatelastent = 1;

                        foreach ($listaentregas as $entrega ) {                        

                            if ($entrega->idEntrega !== null){
                                $listaentregasstring .='
                                <tr>
                                    <td> '.($entrega->idDocumentacion != null ? $entrega->idDocumentacion : "N/D").' </td>
                                    <td> '.($entrega->municipio != null ? $entrega->municipio : "N/D").' </td>
                                    <td> '.($entrega->localidad != null ? $entrega->localidad : "N/D").' </td>
                                    <td> '.($entrega->Direccion != null? $entrega->Direccion : "N/D").'</td>
                                    <td> '.($entrega->periodo != null ? $entrega->periodo : "N/D").'</td>
                                    <td> '.($entrega->centroentrega != null ? $entrega->centroentrega : "N/D").'</td>
                                </tr>';
                                
                            }else{
                                $listaentregasstring .='
                                <tr class="table-dark">
                                    <td colspan="6"></td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        Folio: '.$entrega->idDocumentacion.' - Centro de Entrega: <strong>'.$entrega->centroentrega.'</strong> - Direcccion: '.$entrega->direccioncentroentrega.'
                                    </td>
                                </tr>
                                <tr class="table-dark">
                                    <td colspan="6"></td>
                                </tr>
                                <tr>
                                <td colspan="6">
                                        <p>Favor de estar pendiente de las fechas de entrega de despensas que serán publicadas en la página oficial de la Secretaría de Desarrollo Social de Quintana Roo <a href="https://qroo.gob.mx/sedeso">https://qroo.gob.mx/sedeso</a></p> 
                                        <p>En ellas se le indicará cuando y en donde realizar el pago de la cuota de recuperación y deberá presentarse al centro de entrega asignado con los documento registrados en original, únicamente para su cotejo de información. (Solo el recibo de pago se quedará en el centro)</p>
                                    </td>
                                </tr>';

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
}
