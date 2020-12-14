<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
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

        return view('reportes.index',['ciudades'=>$ciudades,'colonias'=>$colonias]);
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
       
        
       
        $whereraw = '(encuestas.Entregado = "'.$entregadorpt.'"'.($entregadorpt==1?')':' OR encuestas.Entregado IS NULL)');

        $whereraw .= ((is_null($donadorpt) || $donadorpt=='x')?'':' AND encuestas.Donado = "'.$donadorpt.'"');
        $whereraw .= ((is_null($ciudadrpt) || $ciudadrpt=='x')?'':' AND personas.LocalidadId = "'.$ciudadrpt.'"');
        $whereraw .= ((is_null($coloniarpt) || $coloniarpt=='x')?'':' AND personas.ColoniaId = "'.$coloniarpt.'"');

        return DB::table('personas')
                    ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
                    ->leftJoin('c_localidades', 'personas.LocalidadId', '=', 'c_localidades.id')
                    ->leftJoin('c_municipios', 'personas.MunicipioId', '=', 'c_municipios.id')
                    ->leftJoin('encuestas', 'personas.id', '=', 'encuestas.personaId')
                    ->leftJoin('users', 'encuestas.EntregadorId', '=', 'users.id')
                    ->select('personas.id', 'personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','personas.Manzana','personas.Lote','personas.Calle','personas.NoExt','personas.NoInt','encuestas.Entregado','c_colonias.Descripcion as colonia','c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad','users.name','encuestas.Donado','personas.TelefonoCelular')
                    ->WhereRaw($whereraw)
                    ->get();
    }    
}
