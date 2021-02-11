<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Documentacion;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Encuesta;
use App\Models\Entrega;

use Illuminate\Support\Facades\Hash;

class EntregaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        if (session()->has('periodo')) {
            return view('entregas.index');       
        } else {
            return redirect('/periodo');
        }
    }
    
    public function findPersonaEntrega(Request $request){ // listo

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

                    // if (!is_null($direcciones[$i]->ColoniaId) && !is_null($direcciones[$i]->Manzana) && !is_null($direcciones[$i]->Lote)) { //si ninguna esta vacia
                    //     // $orwhere .= "(ColoniaId = '".$direcciones[$i]->ColoniaId."' AND personas.Manzana = '".$direcciones[$i]->Manzana."' AND personas.Lote = '".$direcciones[$i]->Lote."')";
                        
                    //     if ($i < ($numeroDirecciones-1)) {//verifica que sea la penultima iteracion para que el ultimo or quede entre la penultima y la ultima ya que no puede ir al final del query
                    //         // $isp = $i+1;
                    //         if (!is_null($direcciones[$isp]->ColoniaId) && !is_null($direcciones[$isp]->Manzana) && !is_null($direcciones[$isp]->Lote)) { //verifica si en la proxima iteracion es correcta la direccion
                    //             // $orwhere .= " OR ";
                    //         }
                    //     }
                    // }
                }
            } else { //si solo es un registro
                array_push($isds, $direcciones[0]->id);

                // if (!is_null($direcciones[0]->ColoniaId) && !is_null($direcciones[0]->Manzana) && !is_null($direcciones[0]->Lote)) { //si ninguna esta vacia
                //     // $orwhere = "ColoniaId = '".$direcciones[0]->ColoniaId."' AND personas.Manzana = '".$direcciones[0]->Manzana."' AND personas.Lote = '".$direcciones[0]->Lote."'";
                // }
            }

            // if ($orwhere != "") { //si trae la cadena de or que se genera unicamente si la direccion esta completa
            //     // $retper = DB::table('personas')
            //     //     ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
            //     //     ->leftJoin('c_estadosciviles', 'personas.EstadoCivilId', '=', 'c_estadosciviles.id')
            //     //     // ->leftJoin('encuestas', 'personas.id', '=', 'encuestas.personaId') // cambio de logica en entregas y el select igual
            //     //     ->select('personas.id', 'personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','personas.Manzana','personas.Lote','personas.Calle','personas.NoExt','personas.NoInt','c_colonias.Descripcion as colonia','c_estadosciviles.Descripcion as estadoc')
            //     //     // ->select('personas.id', 'personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','personas.Manzana','personas.Lote','personas.Calle','personas.NoExt','personas.NoInt','encuestas.Entregado','c_colonias.Descripcion as colonia','c_estadosciviles.Descripcion as estadoc')
            //     //     ->whereIn('personas.id',$isds)
            //     //     ->orWhereRaw('('.$orwhere.')')
            //     //     ->get();
            // } else { 
                $retper = DB::table('personas')
                    ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
                    ->leftJoin('c_estadosciviles', 'personas.EstadoCivilId', '=', 'c_estadosciviles.id')
                    // ->leftJoin('encuestas', 'personas.id', '=', 'encuestas.personaId') // cambio de logica en entregas y el select igual
                    ->select('personas.id', 'personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','personas.Manzana','personas.Lote','personas.Calle','personas.NoExt','personas.NoInt','c_colonias.Descripcion as colonia','c_estadosciviles.Descripcion as estadoc')
                    // ->select('personas.id', 'personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','personas.Manzana','personas.Lote','personas.Calle','personas.NoExt','personas.NoInt','encuestas.Entregado','c_colonias.Descripcion as colonia','c_estadosciviles.Descripcion as estadoc')
                    ->whereIn('personas.id',$isds)
                    ->get();
            // }
            
            $documentacion = $this->findDocumentacion($direcciones[0]->id);//busca en el metodo de busqueda de documentacion
            
            if ($documentacion !== 0) {// si es cero entonces no pasa por aqui, quiere decir que falta un documento o que ya esta entregado
                $entrega = Entrega::where('DocumentacionId',$documentacion->id)->first();//checa que exista una entrega con el mismo id de documentacion
                if ($entrega !== null) {
                    $documentacion = 1;
                } else {
                    $documentacion = 0;
                }
            }

            return ['retper'=>$retper,'userlvl'=> Auth::user()->tipoUsuarioId,'docper'=>$documentacion];
            // dd(DB::getQueryLog());
        } 
    }

    public function findEntregas($id){//listo

        //$listaEntregas = Entrega::where('PersonaId',$request->get('entid'))->get();
        
        return DB::table('entregas') //lista de entregados
        ->leftJoin('c_periodos', 'entregas.PeriodoId', '=', 'c_periodos.id')
        ->select('entregas.*', 'c_periodos.Descripcion')
        ->where('entregas.PersonaId',$id)
        ->get();
    }

    public function revertirEntrega($id){//listo
        $entrega = Entrega::where('id',$id)->first();
        
        $documentacion = Documentacion::where('id',$entrega->DocumentacionId)->first();

        $entrega->delete();

        if ($documentacion !== null) {
            $documentacion->delete();
        }
    }

    public function findDocumentacion($id){//listo
        
        $documentacion = Documentacion::where('PersonaId',$id)->orderBy('id', 'DESC')->first();
        
        if ($documentacion !== null) {//se encontro una documentacion
            $entrega = Entrega::where('DocumentacionId',$documentacion->id)->first();
            
            if(session('periodo') == 1){//2020 
                //si tiene todo los documentos( curp u anexo 17: comodines) y ademas ya existe un registro de entrega entonces ya puede hacer uno nuevo y por lo tanto envia cero
                if ($documentacion->CuestionarioCompleto == 1 && $documentacion->F1SolicitudApoyo == 1 && $documentacion->Identificacion == 1 && $documentacion->ComprobanteDomicilio == 1 && $documentacion->Comprobante == 1 && $entrega !== null) {
                    return 0;
                } else { //si falta algun documento necesario o la entrega devuelve la informacion para plasmarla
                    if ($entrega !== null) {//verifica que haya una entrega
                        if (($documentacion->CuestionarioCompleto != 1 || $documentacion->F1SolicitudApoyo != 1) && $entrega->PeriodoId == 2) {//verifica que si falta uno de los 2 documentos sea una entrega de 2020bis para dejarla pasar
                            return 0;
                        } else {
                            return $documentacion;
                        }
                    } else {
                        return $documentacion;
                    }
                }
            } else {//2020bis
                //si tiene todo los documentos (curp, cuestionario completo y formato 1: son comodines) y ademas ya existe un registro de entrega entonces ya puede hacer uno nuevo y por lo tanto envia cero
                if ($documentacion->Identificacion == 1 && $documentacion->ComprobanteDomicilio == 1 && $documentacion->Anexo17 == 1 && $documentacion->Comprobante == 1 && $entrega !== null) {
                    return 0;
                } else { //si falta algun documento o la entrega devuelve la informacion para plasmarla
                    if ($entrega !== null) {//verifica que haya una entrega
                        if ($documentacion->Anexo17 != 1 && $entrega->PeriodoId == 1) {//verifica que anexo 17 sea una entrega de 2020 para dejarla pasar
                            return 0;
                        } else {
                            return $documentacion;
                        }
                    } else {
                        return $documentacion;
                    }
                }
            }
        } else { // no hay documentacion previa
            return 0;
        }
    }

    public function registrarDocumentacion(Request $request, $id){//listo

        if ($request->get('docid') != 0) {
            $documentacion = Documentacion::where('id',$request->get('docid'))->first();
        } else {
            $documentacion = new Documentacion();
        }

        $documentacion->Donado = $request->get('donado');
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

        return 1;
    }

    public function registrarEntrega($id){

        $documentacion = $this->findDocumentacion($id);//se manda buscar la documentacion en otro metodo

        if ($documentacion !== 0) {//si da cero es por que esta completo si no es por que hace falta un documento
            
            if(session('periodo') == 1){
                $docComplete = ($documentacion->CuestionarioCompleto == 1 && $documentacion->F1SolicitudApoyo == 1 && $documentacion->Identificacion == 1 && $documentacion->ComprobanteDomicilio == 1 && $documentacion->Comprobante == 1)?1:0;
            }else{
                $docComplete = ($documentacion->Identificacion == 1 && $documentacion->ComprobanteDomicilio == 1 && $documentacion->Comprobante == 1 && $documentacion->Anexo17 == 1 )?1:0;
            }
            if ($docComplete == 1) {      
                
                $entrega = Entrega::where('DocumentacionId',$documentacion->id)->first();
                
                if ( $entrega !== null) {     
                    return "Ya se ha registrado antes la entrega.";
                } else {
                    $persona  = DB::table('personas') //se busca a la persona para sacar la direccion
                    ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
                    ->select('personas.id','personas.Manzana','personas.Lote','personas.Calle','personas.NoExt','personas.NoInt','c_colonias.Descripcion as colonia')
                    ->where('personas.id',$id)
                    ->get();
                    
                    $entrega = null; //se vacia la variable
                    $entrega = new Entrega();//nueva entrega
                    
                    $entrega->PersonaId = $id;
                    $entrega->DocumentacionId = $documentacion->id;
                    $entrega->EntregadorId = Auth::user()->id;
                    $entrega->PeriodoId = session('periodo');
                    $entrega->Direccion = ($persona[0]->colonia!=null ? $persona[0]->colonia : 'Col.N/D')." Mz.".($persona[0]->Manzana!=null ? $persona[0]->Manzana : 'N/D')." Lt.".($persona[0]->Lote!=null ?$persona[0]->Lote : 'N/D')." Calle: ".($persona[0]->Calle!=null ?$persona[0]->Calle : 'N/D')." NoExt: ".($persona[0]->NoExt!=null ?$persona[0]->NoExt : 'N/D')." NoInt: ".($persona[0]->NoInt!=null ?$persona[0]->NoInt : 'N/D');
                    $entrega->Donado = $documentacion->Donado;

                    $entrega->save();//se guarda la entrega

                    return 1;
                }  
            } else {
                return "Hacen falta documentos obligatorios.";
            }
        } else {
            return "No ha registrado ningun documento.";
        }
    }

    

    

   


    
    
}


