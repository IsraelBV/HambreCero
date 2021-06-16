<?php

namespace App\Http\Controllers\P2021\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Documentacion;
use App\Models\Entrega;
use App\Models\C_PeriodosDeEntrega;
use App\Models\StockDespensa;
use App\Models\Persona;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Auth;


use Illuminate\Support\Facades\Storage;

class EntregaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        // if (session()->has('periodo')) {
        //     return view('2020.entregas.index');       
        // } else {
        //     return redirect('/periodo');
        // }
    }

    ////dibuja el html de los documentos
    public function buildFormEntregaEnUpdate(){
        // $folio = $request->get('folio');
       
        // $documentacion = Documentacion::find($folio);

        // $pathIdPersona = "documentacion/$documentacion->PersonaId";
        // $pathIdDocumentacion = $pathIdPersona."/$folio";

        $htmlFoto = '
            <h5 class="card-title" align="center">ENTREGA</h5>';
            
                $htmlFoto .= '<div id="camara" style="display:block;margin:auto;"></div>
                                <button id="tomar_foto" class="btn btn-info btn-block mt-2 mb-2" type=button>Tomar foto de entrega</button>                               
                                <div id="foto" style="display: block; margin: auto;"></div>
                            ';
            

            $htmlFoto .= '
                </br>
            <form id="entregaEnUpdateForm" action="#" method="#">
                <input type="hidden" name="_token" value="'.csrf_token().'" />
                <button id="guardarEntrega" type="submit" class="btn btn-success" disabled>Hacer entrega</button>
            </form>';

        return  $htmlFoto;
    }

    public function verifyRequiredDocuments($folio, $id=null){
        if ($id== null) {
            $documentacion = Documentacion::find($folio);
            $pathIdPersona = "documentacion/$documentacion->PersonaId";
            $pathIdDocumentacion = $pathIdPersona."/$folio";
        } else {
            $pathIdPersona = "documentacion/$id";
            $pathIdDocumentacion = $pathIdPersona."/$folio";
        }

        $idfront = 0;
        $idback = 0;
        $compdom = 0;
        $compag = 0;
        

        if (Storage::disk('public')->exists($pathIdPersona."/identificacio_oficial.pdf") || Storage::disk('public')->exists($pathIdPersona."/identificacio_oficial.jpg")) {
            $idfront = 1;
        } 

        if (Storage::disk('public')->exists("$pathIdPersona/identificacion_atras_oficial.pdf") || Storage::disk('public')->exists("$pathIdPersona/identificacion_atras_oficial.jpg")) {
            $idback = 1;
        }

        if (Storage::disk('public')->exists("$pathIdPersona/comprobantedomicilio.pdf") || Storage::disk('public')->exists("$pathIdPersona/comprobantedomicilio.jpg")) {
            $compdom = 1;
        }
        
        // if (Storage::disk('public')->exists("$pathIdPersona/curp.pdf") || Storage::disk('public')->exists("$pathIdPersona/curp.jpg")) {
            
        // }

        if (Storage::disk('public')->exists("$pathIdDocumentacion/comprobantepago.pdf") || Storage::disk('public')->exists("$pathIdDocumentacion/comprobantepago.jpg")) {
            $compag = 1;
        }

        // if (Storage::disk('public')->exists("$pathIdPersona/constanciaautoridad.pdf") || Storage::disk('public')->exists("$pathIdPersona/constanciaautoridad.jpg")) {
        // }
        if ($idfront && $idback && $compdom && $compag) {
            return 1;
        } else {
            return 0;
        }
    }

    public function EntregaEnUpdate(Request $request, $idDocumentacion){

         $comp = $this->verifyRequiredDocuments($idDocumentacion);
         if ($comp == 1) {

            
            $entrega = Entrega::where('DocumentacionId',$idDocumentacion)->first();

            if ($entrega !== null) {
                return [0," Ya se ha registrado antes la entrega."];
            } else {
                $documentacion = Documentacion::find($idDocumentacion);
                $personaId = $documentacion->PersonaId;

                $persona  = DB::table('personas') //se busca a la persona para sacar la direccion
                    ->join('encuestas', 'personas.id', '=', 'encuestas.personaId')
                    ->leftJoin('c_colonias', 'personas.ColoniaId', '=', 'c_colonias.id')
                    ->select('personas.*','c_colonias.Descripcion as colonia','encuestas.Pregunta_26','encuestas.Pregunta_27','encuestas.Pregunta_28','encuestas.Pregunta_29','encuestas.Pregunta_30','encuestas.Pregunta_31','encuestas.Pregunta_32','encuestas.Pregunta_33','encuestas.Pregunta_34','encuestas.Pregunta_35','encuestas.Pregunta_36','encuestas.Pregunta_37','encuestas.Pregunta_38','encuestas.Pregunta_39','encuestas.Pregunta_40','encuestas.Pregunta_41','encuestas.Pregunta_42','encuestas.Pregunta_43','encuestas.Pregunta_44','encuestas.Pregunta_45','encuestas.Pregunta_46','encuestas.Pregunta_47','encuestas.Pregunta_48','encuestas.Pregunta_49','encuestas.Pregunta_50','encuestas.Pregunta_51','encuestas.Pregunta_52','encuestas.Pregunta_53','encuestas.Pregunta_54','encuestas.Pregunta_55','encuestas.Pregunta_56','encuestas.Pregunta_57','encuestas.Pregunta_58','encuestas.Pregunta_59','encuestas.Pregunta_60','encuestas.Pregunta_61','encuestas.Pregunta_62','encuestas.Pregunta_63','encuestas.Pregunta_64','encuestas.Pregunta_65','encuestas.Pregunta_66','encuestas.Pregunta_67','encuestas.Pregunta_68','encuestas.Pregunta_69','encuestas.Pregunta_70','encuestas.Pregunta_71','encuestas.Pregunta_72','encuestas.Pregunta_73','encuestas.Pregunta_74','encuestas.Pregunta_75','encuestas.Pregunta_76','encuestas.Pregunta_77','encuestas.Pregunta_78','encuestas.Pregunta_79','encuestas.Pregunta_80','encuestas.Pregunta_81','encuestas.Pregunta_82','encuestas.Pregunta_83','encuestas.Pregunta_84','encuestas.Pregunta_85','encuestas.Pregunta_86','encuestas.Pregunta_87','encuestas.Pregunta_88','encuestas.Pregunta_89','encuestas.Pregunta_90','encuestas.Pregunta_91','encuestas.Pregunta_92','encuestas.Pregunta_93','encuestas.Pregunta_94','encuestas.Pregunta_95','encuestas.Pregunta_96','encuestas.Pregunta_97','encuestas.Pregunta_98','encuestas.Pregunta_99','encuestas.Pregunta_100','encuestas.Pregunta_101')
                    ->where('personas.id',$personaId)
                    ->get();

                    $periodosEntrega = C_PeriodosDeEntrega::where('status','=',1)->get();

                    if ($periodosEntrega->count() > 1) {
                        return [0,"Algo anda mal en los periodos de entrega favor de reportarlo."];
                    } else {
                        $periodosEntrega = $periodosEntrega[0];
                    }

                    $stock = StockDespensa::where('idCentroEntrega', session('centroEntrega'))->get();

                    if ($stock->count()) {
                        $stock = $stock[0];

                        if ($stock->stockDespensas >= 1) {
                            $disponibilidad = $stock->stockDespensas;
                        } else {
                            return [0,"No se registro la entrega, tu centro no tiene disponibilidad de despensas."];
                        }
                    } else {
                        return [0,"Algo anda mal tu centro de entrega no tiene despensas asignadas."];
                    }
                    
                    if ($request->hasFile('fotoentrega')) {
                        Validator::make($request->all(), [
                            'fotoentrega' => ['mimes:jpeg,pdf'],
                        ])->validate();

                        $dataname1 = explode('.',$request->file('fotoentrega')->getClientOriginalName());
                        $request->file('fotoentrega')->storeAs("documentacion/$personaId/$idDocumentacion/",'fotoentrega'.'.'.$dataname1[1]);

                    } elseif($request->has('fotoentrega')) {
                        $image = $request->get('fotoentrega'); 
                        $image = str_replace('data:image/jpeg;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageName = 'fotoentrega.jpg';
                        Storage::disk('public')->put("documentacion/$personaId/$idDocumentacion/".$imageName, base64_decode($image));
                    } else {
                        return [0,"No se registro la entrega ya que no se ha adjuntado ninguna foto ."];
                    }

                    $entrega = null; //se vacia la variable
                    $entrega = new Entrega();//nueva entrega
                    
                    $entrega->PersonaId = $personaId;
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

                    $entrega->idCentroEntrega = session('centroEntrega');
                    $entrega->idPeriodoEntrega = $periodosEntrega->id;

                    $entrega->save();//se guarda la entrega

                    $stock->stockDespensas = $disponibilidad - 1;
                    $stock->save();

                return [1,"Se realizo la entrega con folio: $idDocumentacion", $this->buildListaEntregas($personaId)];
            }            
         } else {
            return [0,"Documentacion incompleta, la entrega no se realizo"];
         }
    }

    public function buildListaEntregas($id){ // hay que verificar y comprobar este metodo ya que se tiene que trasladar a este controlador en vez del de cuestionario

        $listaentregas = DB::table('documentacion') //lista de entregados
        ->leftJoin('entregas', 'entregas.DocumentacionId', '=', 'documentacion.id')
        ->leftJoin('c_periodos', 'entregas.PeriodoId', '=', 'c_periodos.id')
        ->leftJoin('c_municipios', 'entregas.MunicipioId', '=', 'c_municipios.id')
        ->leftJoin('c_localidades', 'entregas.LocalidadId', '=', 'c_localidades.id')
        ->leftJoin('c_centrosdeentrega', 'documentacion.idCentroEntrega', '=', 'c_centrosdeentrega.id')
        ->select('entregas.id as idEntrega','documentacion.id as idDocumentacion','c_periodos.Descripcion as periodo','entregas.Direccion', 'c_municipios.Descripcion as municipio','c_localidades.Descripcion as localidad','c_centrosdeentrega.Descripcion as centroentrega','c_centrosdeentrega.Direccion as direccioncentroentrega')
        ->where('documentacion.PersonaId',$id)
        ->get();

        $persona = Persona::find($id);

        $fechaEmpaDisor = explode(" ",$persona->created_at);
        $fechaEmpadArray = explode("-",$fechaEmpaDisor[0]);
        $fechaEmpadronamiento = "$fechaEmpadArray[2]-$fechaEmpadArray[1]-$fechaEmpadArray[0]";
                
        if (count($listaentregas) > 0) {
            $listaentregasstring = 
                '<h5 class="card-title" align="center">LISTA DE ENTREGAS</h5>
                    <br>
                    <table class="table">';
                        if (count($listaentregas) > 1 || $listaentregas[0]->idEntrega !== null) {
                            $listaentregasstring .='<tr>
                                    <th>FOLIO</th><th>MUNICIPIO</th><th>LOCALIDAD</th><th>DIRECCION</th><th>PERIODO</th><th>CENTRO DE ENTREGA</th><th>FOTO</th>
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
                                    <td> '.($entrega->periodo == 2021?'<a role="button" href="/documentacion/download/fotoentrega.jpg/'.$id.'/'.$entrega->idDocumentacion.'" class="btn btn-primary" target="_blank"><span style="font-size: 1.2em; color: white;" class="fa fa-eye"></span></a></td>':'N/D' ).'</td>
                                </tr>';
                                
                            }else{
                                $listaentregasstring .='
                                <tr class="table-dark">
                                    <td colspan="7" style="text-align: center; padding-top: 2px; padding-bottom: 0; color: black;"><h4> FECHA DE EMPADRONAMIENTO: '.$fechaEmpadronamiento.'</h4></td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        Folio: '.$entrega->idDocumentacion.' - Centro de Entrega: <strong>'.$entrega->centroentrega.'</strong> - Direcccion: '.$entrega->direccioncentroentrega.'
                                    </td>
                                    <td colspan="2">
                                        <button style="color: white" id="editarDoc" class="btn btn-warning mb-1" data-folio="'.$entrega->idDocumentacion.'">Documentacion</button>';
                                        if (Auth::check()){
                                            if( $this->verifyRequiredDocuments($entrega->idDocumentacion) == 1){
                                                $listaentregasstring .='<button style="color: white" id="entregaenupdatebtn" class="btn btn-success mb-1" data-folio="'.$entrega->idDocumentacion.'">Entrega</button>';
                                                // if (Auth::user()->tipoUsuarioId == 0) {
                                                    $listaentregasstring .='<button style="color: white" id="entregaenupdatedocbtn" class="btn btn-info mb-1" data-folio="'.$entrega->idDocumentacion.'">Entrega Posterior</button>';
                                                // }
                                            }
                                        }
                                        $listaentregasstring .='</td> 
                                </tr>
                                <tr class="table-dark">
                                    <td colspan="7"></td>
                                </tr>
                                <tr>
                                <td colspan="7">
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

    public function buildFormPostEntregaEnUpdate(){
        
        $htmlFoto = '
            <h5 class="card-title" align="center">ENTREGA</h5>
                </br>
            <form id="postEntregaEnUpdateForm" action="#" method="#">
                <input type="hidden" name="_token" value="'.csrf_token().'" />
                <div class="col-md-12">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="fotoentrega" name="fotoentrega" lang="es" required>
                        <label class="custom-file-label" for="fotoentrega" data-browse="Buscar documento">Foto de entrega</label>
                    </div>
                </div>
                </br>
                <button id="guardarPostEntrega" type="submit" class="btn btn-success">Hacer entrega</button>
            </form>';

        return  $htmlFoto;
    }

}


