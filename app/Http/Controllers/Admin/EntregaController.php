<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Documentacion;
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

        $documentacion = Documentacion::where('PersonaId',$id)->first();
        if ($documentacion !== null) {
            if ($documentacion->CuestionarioCompleto == 1 && $documentacion->F1SolicitudApoyo == 1 && $documentacion->Identificacion == 1 && $documentacion->ComprobanteDomicilio == 1 && $documentacion->Comprobante == 1) {
                $encuesta = Encuesta::where('PersonaId',$id)->first();
    
                if ($encuesta->Entregado == 0) {
                    $encuesta->Entregado = 1;
                    $encuesta->EntregadorId = Auth::user()->id;
                    $encuesta->save();
                    return 1;
                } else {
                    return "Ya ha sido registrado.";
                }
            } else {
                return "Hacen falta documentos obligatorios.";
            }
        } else {
            return "No ha registrado ningun documento.";
        }
    }

    public function registrarDocumentacion(Request $request, $id){

        $encuesta = Encuesta::where('PersonaId',$id)->first();
        $documentacion = Documentacion::where('PersonaId',$id)->first();

        $encuesta->Donado = $request->get('donado');

        if ($documentacion === null) {
            $documentacion = new Documentacion();
        }

        $documentacion->PersonaId = $id;
        $documentacion->CuestionarioCompleto = $request->get('cuestionario') == 'on'?1:0;
        $documentacion->F1SolicitudApoyo =  $request->get('formato1') == 'on'?1:0;
        $documentacion->Identificacion =  $request->get('idoficial') == 'on'?1:0;
        $documentacion->CURP =  $request->get('curpdoc') == 'on'?1:0;
        $documentacion->ComprobanteDomicilio =  $request->get('domicilio') == 'on'?1:0;
        $documentacion->Anexo17 =  $request->get('anexo17') == 'on'?1:0;
        $documentacion->Comprobante =  $request->get('comprobante') == 'on'?1:0;
        $documentacion->EncuestadorId = Auth::user()->id;

        $documentacion->save();
        $encuesta->save();

        return 1;
    }

    public function findDocumentacion(Request $request){
        
        $documentacion = Documentacion::where('PersonaId',$request->get('entid'))->first();

        if ($documentacion !== null) {
            $encuesta = Encuesta::where('PersonaId',$request->get('entid'))->first();
            return [$documentacion, $encuesta->Donado];
        } else {
            return 0;
        }
    }
}


