<?php

namespace App\Http\Controllers\P2020\Admin;

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
        $ciudades  = DB::table('personas')
        ->leftJoin('c_localidades', 'personas.LocalidadId', '=', 'c_localidades.id')
        ->select('c_localidades.id','c_localidades.Descripcion as localidad')
        ->where('personas.LocalidadId','!=',null)
        ->distinct()
        ->get();

        $colonias  = DB::table('c_colonias')
        ->select('id','Descripcion as colonia')
        ->orderBy('LocalidadId', 'ASC')
        ->get();

        $periodos  = DB::table('c_periodos')
        ->select('id','Descripcion as periodo')
        ->orderBy('id', 'ASC')
        ->get();

        return view('2020/reportes.index',['ciudades'=>$ciudades,'colonias'=>$colonias,'periodos'=>$periodos]);
    }

    public function findcolonias($entidad){
        if ($entidad == 'x') {
            return DB::table('c_colonias')
            ->select('id','Descripcion as colonia')
            ->orderBy('LocalidadId', 'ASC')
            ->get();
        } else {
            return DB::table('c_colonias')
            ->select('id','Descripcion as colonia')
            ->where('LocalidadId','=',$entidad)
            ->get();
        }
    }

    public function findReporte(Request $request){

        $entregadorpt = $request->get('entregadorpt');
        $donadorpt = $request->get('donadorpt');
        $ciudadrpt = $request->get('ciudadrpt');
        $coloniarpt = $request->get('coloniarpt');
        $periodorpt = $request->get('periodorpt');
        
       
        //$whereraw = '(entregas.Donado = "'.$entregadorpt.'"'.($entregadorpt==1?')':' OR encuestas.Entregado IS NULL)');
        // $whereraw = $entregadorpt==1?'entregas.Donado IS NOT NULL':'entregas.Donado IS NULL';

        if ($entregadorpt==1) {
            $whereraw = 'entregas.id IS NOT NULL';
            $whereraw .= ((is_null($donadorpt) || $donadorpt=='x')?'':' AND entregas.Donado = "'.$donadorpt.'"');
            $whereraw .= ((is_null($ciudadrpt) || $ciudadrpt=='x')?'':' AND entregas.LocalidadId = "'.$ciudadrpt.'"');
            $whereraw .= ((is_null($coloniarpt) || $coloniarpt=='x')?'':' AND entregas.ColoniaId = "'.$coloniarpt.'"');
            $whereraw .= ((is_null($periodorpt) || $periodorpt=='x')?'':' AND entregas.PeriodoId = "'.$periodorpt.'"');

            return DB::table('entregas')
                    // ->leftJoin('entregas', 'personas.id', '=', 'entregas.personaId')
                    ->leftJoin('c_colonias', 'entregas.ColoniaId', '=', 'c_colonias.id')
                    ->leftJoin('c_localidades', 'entregas.LocalidadId', '=', 'c_localidades.id')
                    ->leftJoin('c_municipios', 'entregas.MunicipioId', '=', 'c_municipios.id')
                    ->leftJoin('users', 'entregas.EntregadorId', '=', 'users.id')
                    ->select('entregas.Nombre', 'entregas.APaterno','entregas.AMaterno','entregas.CURP','entregas.Manzana','entregas.Lote','entregas.Calle','entregas.NoExt','entregas.NoInt','c_colonias.Descripcion as colonia','c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad','users.name','entregas.Donado','entregas.TelefonoCelular','entregas.created_at as fechaE','entregas.id as idEnt')
                    ->WhereRaw($whereraw)
                    ->get();
        } else {
            $whereraw = 'entregas.id IS NULL';
            // $whereraw .= ((is_null($donadorpt) || $donadorpt=='x')?'':' AND entregas.Donado = "'.$donadorpt.'"');
            $whereraw .= ((is_null($ciudadrpt) || $ciudadrpt=='x')?'':' AND personas.LocalidadId = "'.$ciudadrpt.'"');
            $whereraw .= ((is_null($coloniarpt) || $coloniarpt=='x')?'':' AND personas.ColoniaId = "'.$coloniarpt.'"');
            // $whereraw .= ((is_null($periodorpt) || $periodorpt=='x')?'':' AND entregas.PeriodoId = "'.$periodorpt.'"');

            return DB::table('personas')
                    ->leftJoin('entregas', 'personas.id', '=', 'entregas.personaId')
                    ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
                    ->leftJoin('c_localidades', 'personas.LocalidadId', '=', 'c_localidades.id')
                    ->leftJoin('c_municipios', 'personas.MunicipioId', '=', 'c_municipios.id')
                    ->leftJoin('users', 'entregas.EntregadorId', '=', 'users.id')
                    ->select('personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','personas.Manzana','personas.Lote','personas.Calle','personas.NoExt','personas.NoInt','c_colonias.Descripcion as colonia','c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad','users.name','entregas.Donado','personas.TelefonoCelular','entregas.created_at as fechaE','entregas.id as idEnt')
                    ->WhereRaw($whereraw)
                    ->get();
        }
        
        
    }    
}
