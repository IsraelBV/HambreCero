<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Encuesta;

class EntregaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('entregas.index');
    }
    
    public function findPersonaEntrega(Request $request){

        $curp = $request->get('curp');
        
        if (isset($curp)) {
            
            // DB::connection()->enableQueryLog();

            //busca los ids y direcciones relacionadas con ese curp
            $direcciones = DB::table('personas')
            ->select('personas.id','personas.Manzana','personas.Lote','personas.Calle','personas.NoExt','personas.NoInt','personas.ColoniaId')
            ->where("personas.CURP", $curp)
            ->get();

            if ($direcciones->isEmpty()) {// si no encuentra nada regresa un array vacio
                return $direcciones;
            }

            $isds = array();
            $orwhere = "";

            $numeroDirecciones = count($direcciones);

            if ($numeroDirecciones > 1) {//si hay mas de un registro con ese curp
                for ($i=0; $i < $numeroDirecciones ; $i++) {
                    array_push($isds, $direcciones[$i]->id); //agrea las ids de los registros

                    if (!empty($direcciones[$i]->ColoniaId) && !empty($direcciones[$i]->Manzana) && !empty($direcciones[$i]->Lote)) { //si ninguna esta vacia
                        $orwhere .= "(ColoniaId = '".$direcciones[$i]->ColoniaId."' AND personas.Manzana = '".$direcciones[$i]->Manzana."' AND personas.Lote = '".$direcciones[$i]->Lote."')";
                        
                        if ($i < ($numeroDirecciones-1)) {
                            $orwhere .= " OR ";
                        }
                    }
                }
            } else { //si solo es un registro
                array_push($isds, $direcciones[0]->id);

                if (!empty($direcciones[0]->ColoniaId) && !empty($direcciones[0]->Manzana) && !empty($direcciones[0]->Lote)) { //si ninguna esta vacia
                    $orwhere = "ColoniaId = '".$direcciones[0]->ColoniaId."' AND personas.Manzana = '".$direcciones[0]->Manzana."' AND personas.Lote = '".$direcciones[0]->Lote."'";
                }
            }

            if ($orwhere != "") { //si trae la cadena de or que se genera unicamente si la direccion esta completa
                $retper = DB::table('personas')
                    ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
                    ->leftJoin('c_estadosciviles', 'personas.EstadoCivilId', '=', 'c_estadosciviles.id')
                    ->leftJoin('encuestas', 'personas.id', '=', 'encuestas.personaId')
                    ->select('personas.id', 'personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','personas.Manzana','personas.Lote','personas.Calle','personas.NoExt','personas.NoInt','encuestas.Entregado','c_colonias.Descripcion as colonia','c_estadosciviles.Descripcion as estadoc')
                    ->whereIn('personas.id',$isds)
                    ->orWhereRaw('('.$orwhere.')')
                    ->get();
            } else { 
                $retper = DB::table('personas')
                    ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
                    ->leftJoin('c_estadosciviles', 'personas.EstadoCivilId', '=', 'c_estadosciviles.id')
                    ->leftJoin('encuestas', 'personas.id', '=', 'encuestas.personaId')
                    ->select('personas.id', 'personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','personas.Manzana','personas.Lote','personas.Calle','personas.NoExt','personas.NoInt','encuestas.Entregado','c_colonias.Descripcion as colonia','c_estadosciviles.Descripcion as estadoc')
                    ->whereIn('personas.id',$isds)
                    ->get();
            }
            return $retper;
            // return ['retper'=>$retper, 'userlvl'=> Auth::user()->tipoUsuarioId];
            // dd(DB::getQueryLog());
        } 
    }

    public function registrarEntrega(Request $request, $id){

        $encuesta = Encuesta::where('PersonaId',$id)->first();

        if ($encuesta->Entregado == 0) {
            $encuesta->Entregado = 1;
            $encuesta->EntregadorId = Auth::user()->id;
            $encuesta->save();
            return 1;
        } else {
            return 0;
        }
   
    }
}


