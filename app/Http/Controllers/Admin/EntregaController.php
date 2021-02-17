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
                    ->leftJoin('c_municipios', 'personas.MunicipioId', '=', 'c_municipios.id')
                    ->leftJoin('c_localidades', 'personas.LocalidadId', '=', 'c_localidades.id')
                    // ->leftJoin('encuestas', 'personas.id', '=', 'encuestas.personaId') // cambio de logica en entregas y el select igual
                    ->select('personas.id', 'personas.Nombre', 'personas.APaterno','personas.AMaterno','personas.CURP','personas.Manzana','personas.Lote','personas.Calle','personas.NoExt','personas.NoInt','c_colonias.Descripcion as colonia','c_estadosciviles.Descripcion as estadoc','c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad')
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
        ->leftJoin('users', 'entregas.EntregadorId', '=', 'users.id')
        ->select('entregas.*', 'c_periodos.Descripcion', 'users.name')
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
        $documentacion->CuestionarioCompleto = $request->get('cuestionario') == 'on'?1:0;//Anexo 15
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
                    ->join('encuestas', 'personas.id', '=', 'encuestas.personaId')
                    ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
                    ->select('personas.*','c_colonias.Descripcion as colonia','encuestas.Pregunta_26','encuestas.Pregunta_27','encuestas.Pregunta_28','encuestas.Pregunta_29','encuestas.Pregunta_30','encuestas.Pregunta_31','encuestas.Pregunta_32','encuestas.Pregunta_33','encuestas.Pregunta_34','encuestas.Pregunta_35','encuestas.Pregunta_36','encuestas.Pregunta_37','encuestas.Pregunta_38','encuestas.Pregunta_39','encuestas.Pregunta_40','encuestas.Pregunta_41','encuestas.Pregunta_42','encuestas.Pregunta_43','encuestas.Pregunta_44','encuestas.Pregunta_45','encuestas.Pregunta_46','encuestas.Pregunta_47','encuestas.Pregunta_48','encuestas.Pregunta_49','encuestas.Pregunta_50','encuestas.Pregunta_51','encuestas.Pregunta_52','encuestas.Pregunta_53','encuestas.Pregunta_54','encuestas.Pregunta_55','encuestas.Pregunta_56','encuestas.Pregunta_57','encuestas.Pregunta_58','encuestas.Pregunta_59','encuestas.Pregunta_60','encuestas.Pregunta_61','encuestas.Pregunta_62','encuestas.Pregunta_63','encuestas.Pregunta_64','encuestas.Pregunta_65','encuestas.Pregunta_66','encuestas.Pregunta_67','encuestas.Pregunta_68','encuestas.Pregunta_69','encuestas.Pregunta_70','encuestas.Pregunta_71','encuestas.Pregunta_72','encuestas.Pregunta_73','encuestas.Pregunta_74','encuestas.Pregunta_75','encuestas.Pregunta_76','encuestas.Pregunta_77','encuestas.Pregunta_78','encuestas.Pregunta_79','encuestas.Pregunta_80','encuestas.Pregunta_81','encuestas.Pregunta_82','encuestas.Pregunta_83','encuestas.Pregunta_84','encuestas.Pregunta_85','encuestas.Pregunta_86','encuestas.Pregunta_87','encuestas.Pregunta_88','encuestas.Pregunta_89','encuestas.Pregunta_90','encuestas.Pregunta_91','encuestas.Pregunta_92','encuestas.Pregunta_93','encuestas.Pregunta_94','encuestas.Pregunta_95','encuestas.Pregunta_96','encuestas.Pregunta_97','encuestas.Pregunta_98','encuestas.Pregunta_99','encuestas.Pregunta_100','encuestas.Pregunta_101')
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

                    $entrega->Nombre = $persona[0]->Nombre;
                    $entrega->APaterno = $persona[0]->APaterno;
                    $entrega->AMaterno = $persona[0]->AMaterno;
                    $entrega->CURP = $persona[0]->CURP;
                    $entrega->RFC = $persona[0]->RFC;
                    $entrega->ClaveElector = $persona[0]->ClaveElector;
                    $entrega->IdentificacionMigratoria = $persona[0]->IdentificacionMigratoria;
                    $entrega->Sexo = $persona[0]->Sexo;
                    $entrega->EstadoNacimientoId = $persona[0]->EstadoNacimientoId;
                    $entrega->CiudadNacimiento = $persona[0]->CiudadNacimiento;
                    $entrega->FechaNacimiento = $persona[0]->FechaNacimiento;
                    $entrega->GradoEstudiosId = $persona[0]->GradoEstudiosId;
                    $entrega->ColoniaId = $persona[0]->ColoniaId;
                    $entrega->Calle = $persona[0]->Calle;
                    $entrega->Manzana = $persona[0]->Manzana;
                    $entrega->Lote = $persona[0]->Lote;
                    $entrega->NoExt = $persona[0]->NoExt;
                    $entrega->NoInt = $persona[0]->NoInt;
                    $entrega->EstadoId = $persona[0]->EstadoId;
                    $entrega->MunicipioId = $persona[0]->MunicipioId;
                    $entrega->LocalidadId = $persona[0]->LocalidadId;
                    $entrega->CP = $persona[0]->CP;
                    $entrega->TelefonoCelular = $persona[0]->TelefonoCelular;
                    $entrega->TelefonoCasa = $persona[0]->TelefonoCasa;
                    $entrega->Email = $persona[0]->Email;
                    $entrega->GrupoSocialId = $persona[0]->GrupoSocialId;
                    $entrega->EstadoCivilId = $persona[0]->EstadoCivilId;

                    $entrega->Pregunta_26 = $persona[0]->Pregunta_26;
                    $entrega->Pregunta_27 = $persona[0]->Pregunta_27;
                    $entrega->Pregunta_28 = $persona[0]->Pregunta_28;
                    $entrega->Pregunta_29 = $persona[0]->Pregunta_29;
                    $entrega->Pregunta_30 = $persona[0]->Pregunta_30;
                    $entrega->Pregunta_31 = $persona[0]->Pregunta_31;
                    $entrega->Pregunta_32 = $persona[0]->Pregunta_32;
                    $entrega->Pregunta_33 = $persona[0]->Pregunta_33;
                    $entrega->Pregunta_34 = $persona[0]->Pregunta_34;
                    $entrega->Pregunta_35 = $persona[0]->Pregunta_35;
                    $entrega->Pregunta_36 = $persona[0]->Pregunta_36;
                    $entrega->Pregunta_37 = $persona[0]->Pregunta_37;
                    $entrega->Pregunta_38 = $persona[0]->Pregunta_38;
                    $entrega->Pregunta_39 = $persona[0]->Pregunta_39;
                    $entrega->Pregunta_40 = $persona[0]->Pregunta_40;
                    $entrega->Pregunta_41 = $persona[0]->Pregunta_41;
                    $entrega->Pregunta_42 = $persona[0]->Pregunta_42;
                    $entrega->Pregunta_43 = $persona[0]->Pregunta_43;
                    $entrega->Pregunta_44 = $persona[0]->Pregunta_44;
                    $entrega->Pregunta_45 = $persona[0]->Pregunta_45;
                    $entrega->Pregunta_46 = $persona[0]->Pregunta_46;
                    $entrega->Pregunta_47 = $persona[0]->Pregunta_47;
                    $entrega->Pregunta_48 = $persona[0]->Pregunta_48;
                    $entrega->Pregunta_49 = $persona[0]->Pregunta_49;
                    $entrega->Pregunta_50 = $persona[0]->Pregunta_50;
                    $entrega->Pregunta_51 = $persona[0]->Pregunta_51;
                    $entrega->Pregunta_52 = $persona[0]->Pregunta_52;
                    $entrega->Pregunta_53 = $persona[0]->Pregunta_53;
                    $entrega->Pregunta_54 = $persona[0]->Pregunta_54;
                    $entrega->Pregunta_55 = $persona[0]->Pregunta_55;
                    $entrega->Pregunta_56 = $persona[0]->Pregunta_56;
                    $entrega->Pregunta_57 = $persona[0]->Pregunta_57;
                    $entrega->Pregunta_58 = $persona[0]->Pregunta_58;
                    $entrega->Pregunta_59 = $persona[0]->Pregunta_59;
                    $entrega->Pregunta_60 = $persona[0]->Pregunta_60;
                    $entrega->Pregunta_61 = $persona[0]->Pregunta_61;
                    $entrega->Pregunta_62 = $persona[0]->Pregunta_62;
                    $entrega->Pregunta_63 = $persona[0]->Pregunta_63;
                    $entrega->Pregunta_64 = $persona[0]->Pregunta_64;
                    $entrega->Pregunta_65 = $persona[0]->Pregunta_65;
                    $entrega->Pregunta_66 = $persona[0]->Pregunta_66;
                    $entrega->Pregunta_67 = $persona[0]->Pregunta_67;
                    $entrega->Pregunta_68 = $persona[0]->Pregunta_68;
                    $entrega->Pregunta_69 = $persona[0]->Pregunta_69;
                    $entrega->Pregunta_70 = $persona[0]->Pregunta_70;
                    $entrega->Pregunta_71 = $persona[0]->Pregunta_71;
                    $entrega->Pregunta_72 = $persona[0]->Pregunta_72;
                    $entrega->Pregunta_73 = $persona[0]->Pregunta_73;
                    $entrega->Pregunta_74 = $persona[0]->Pregunta_74;
                    $entrega->Pregunta_75 = $persona[0]->Pregunta_75;
                    $entrega->Pregunta_76 = $persona[0]->Pregunta_76;
                    $entrega->Pregunta_77 = $persona[0]->Pregunta_77;
                    $entrega->Pregunta_78 = $persona[0]->Pregunta_78;
                    $entrega->Pregunta_79 = $persona[0]->Pregunta_79;
                    $entrega->Pregunta_80 = $persona[0]->Pregunta_80;
                    $entrega->Pregunta_81 = $persona[0]->Pregunta_81;
                    $entrega->Pregunta_82 = $persona[0]->Pregunta_82;
                    $entrega->Pregunta_83 = $persona[0]->Pregunta_83;
                    $entrega->Pregunta_84 = $persona[0]->Pregunta_84;
                    $entrega->Pregunta_85 = $persona[0]->Pregunta_85;
                    $entrega->Pregunta_86 = $persona[0]->Pregunta_86;
                    $entrega->Pregunta_87 = $persona[0]->Pregunta_87;
                    $entrega->Pregunta_88 = $persona[0]->Pregunta_88;
                    $entrega->Pregunta_89 = $persona[0]->Pregunta_89;
                    $entrega->Pregunta_90 = $persona[0]->Pregunta_90;
                    $entrega->Pregunta_91 = $persona[0]->Pregunta_91;
                    $entrega->Pregunta_92 = $persona[0]->Pregunta_92;
                    $entrega->Pregunta_93 = $persona[0]->Pregunta_93;
                    $entrega->Pregunta_94 = $persona[0]->Pregunta_94;
                    $entrega->Pregunta_95 = $persona[0]->Pregunta_95;
                    $entrega->Pregunta_96 = $persona[0]->Pregunta_96;
                    $entrega->Pregunta_97 = $persona[0]->Pregunta_97;
                    $entrega->Pregunta_98 = $persona[0]->Pregunta_98;
                    $entrega->Pregunta_99 = $persona[0]->Pregunta_99;
                    $entrega->Pregunta_100 = $persona[0]->Pregunta_100;
                    $entrega->Pregunta_101 = $persona[0]->Pregunta_101;

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


