<?php

namespace App\Http\Controllers\P2021\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Auth;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if (Auth::user()->tipoUsuarioId != 0){
            return redirect('home');
        } 

        $periodos = DB::table('c_periodosdeentrega')
        ->select('id','Descripcion as periodo')
        ->orderBy('id', 'ASC')
        ->get();

        $municipios = DB::table('c_municipios')
        ->select('id','Descripcion as municipio')
        ->orderBy('Descripcion', 'ASC')
        ->get();

        $centroent = DB::table('c_centrosdeentrega')
        ->select('id','Descripcion as ce')
        ->orderBy('Descripcion', 'ASC')
        ->get();

        $ciudades  = null;
        // $ciudades  = DB::table('personas')
        // ->leftJoin('c_localidades', 'personas.LocalidadId', '=', 'c_localidades.id')
        // ->select('c_localidades.id','c_localidades.Descripcion as localidad')
        // ->where('personas.LocalidadId','!=',null)
        // ->distinct()
        // ->get();

        $colonias  = null;
        // $colonias  = DB::table('c_colonias')
        // ->select('id','Descripcion as colonia')
        // ->orderBy('LocalidadId', 'ASC')
        // ->get();

        return view('2021/reportes.index',['ciudades'=>$ciudades,'colonias'=>$colonias,'municipios'=>$municipios,'periodos'=>$periodos,'centroent'=>$centroent]);
    }

    public function findReporte(Request $request){

        $periodoent = $request->get('periodoent');
        $centroent = $request->get('centroent');
        $donado = $request->get('donado');
        $municipio = $request->get('municipio');
        $localidad = $request->get('localidad');
        $colonia = $request->get('colonia');
        
        $whereraw = 'personas.id IS NOT NULL';
        $whereraw .= $periodoent?' AND entregas.idPeriodoEntrega = "'.$periodoent.'"':' AND entregas.PeriodoId = "3"';
        $whereraw .= $donado?' AND entregas.Donado = "'.$donado.'"':'';

        if ($centroent) {
            $whereraw .= ' AND entregas.idCentroEntrega = "'.$centroent.'"';
        } else {
            $whereraw .= $municipio?' AND entregas.MunicipioId = "'.$municipio.'"':'';
            $whereraw .= $localidad?' AND entregas.LocalidadId = "'.$localidad.'"':'';
         
            $whereraw .= $colonia?' AND entregas.ColoniaId = "'.$colonia.'"':'';
        }

        return $resultado = DB::table('entregas')
                ->leftJoin('personas', 'personas.id', '=', 'entregas.personaId')
                ->leftJoin('c_colonias', 'entregas.ColoniaId', '=', 'c_colonias.id')
                ->leftJoin('c_localidades', 'entregas.LocalidadId', '=', 'c_localidades.id')
                ->leftJoin('c_municipios', 'entregas.MunicipioId', '=', 'c_municipios.id')
                ->leftJoin('users', 'entregas.EntregadorId', '=', 'users.id')
                ->leftJoin('c_centrosdeentrega', 'entregas.idCentroEntrega', '=', 'c_centrosdeentrega.id')
                ->select('personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','entregas.Manzana','entregas.Lote','entregas.Calle','entregas.NoExt','entregas.NoInt','c_colonias.Descripcion as colonia','c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad','users.name','entregas.Donado','entregas.TelefonoCelular','entregas.id as idEnt','entregas.DocumentacionId as folioEnt',DB::raw('DATE_SUB(entregas.created_at, INTERVAL 5 HOUR) as fechaE'), 'c_centrosdeentrega.Descripcion as centroentrega','entregas.idPeriodoEntrega as periodoentrega','entregas.comentarioEntrega as comentario','entregas.Sexo as sexo')
                ->WhereRaw($whereraw)
                ->get();        
    } 
    
}
