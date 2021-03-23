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
                            return redirect("/registro/pass/{$persona[0]->id}/edit");
                        } else {
                            return view('2021.cuestionario.index',[
                                'errmsg'=> 'CURP o Contraseña incorrectos',
                                'curp'=> $curp
                                ]);
                        }
                    } else {
                        if (Hash::check($pass, $persona[0]->password)) {// verificar que sea la contraseña
                            return redirect("/registro/{$persona[0]->id}/edit");
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
                return redirect('/registro/create');
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
        $persona = Persona::find($id);
        if (is_null($persona->password)) {

            Validator::make($request->all(), [
                'contraseña' => ['required', 'string', 'min:8', 'confirmed'],
            ])->validate();

            $persona = Persona::where('id',$id)->first();
            $persona->password = Hash::make($request->get('contraseña'));
            $persona->save();

            return view('2021.cuestionario.index',[
                'scssmsg'=>  'Se ha cambiado la contraseña del usuario, vuelva a ingresar.'
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
    public function create()
    {   
        return view('2021.cuestionario.encuesta',[
            'preguntas'=> C_Pregunta::all(),
            'estados'=> C_Estado::all(),
            'colonias'=> C_Colonia::all(),
            'localidades'=> C_Localidad::findMany([57,249]),   
            'municipios'=> C_Municipio::findMany([5,4]),
            'estadosCiviles' => C_EstadoCivil::all(),
            'estudios'=> C_GradoDeEstudio::all(),
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
        ->select('entregas.id as idEntrega','documentacion.id as idDocumentacion','c_periodos.Descripcion as periodo','entregas.Direccion', 'c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad','c_centrosdeentrega.Descripcion as centroentrega')
        ->where('documentacion.PersonaId',$id)
        ->get();

        // $documentacion = Documentacion::where('PersonaId',$id)->orderBy('id', 'DESC')->first();
        // $entrega = Entrega::where('DocumentacionId',$documentacion->id)->first();

        return view('2021.cuestionario.encuestaUpdate',[
            'preguntas'=> C_Pregunta::all(),
            'estados'=> C_Estado::all(),
            'colonias'=> C_Colonia::all(),
            'localidades'=> C_Localidad::findMany([57,249]),   
            'municipios'=> C_Municipio::findMany([5,4]),
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

        var_dump('qwerty3');
        $documentacion->save();

            var_dump('qwerty0');

        if ($request->hasFile('xxx')) {
            // $request->file('xxx')->storeAs('documentacion/'.$id.'/'.$documentacion->id,'identificacio_oficial');
            var_dump('qwerty1');
        }
        if ($request->hasFile('CURPFile')) {
            
        }
        if ($request->hasFile('CompDomFile')) {
            
        }
        if ($request->hasFile('ComPagFile')) {
            
        }
        if ($request->hasFile('ConstAutFiled')) {
            
        }
   }
}
