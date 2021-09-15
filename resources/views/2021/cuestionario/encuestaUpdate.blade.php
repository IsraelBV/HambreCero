@extends('2021.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <img src="{{asset('img/logo_nesesidades2021.jpeg')}}" class="img-fluid img-thumbnail">
            </div>
        </div>
    </div>
    <!--Datos Personales-->
    <br><br>
    <form id="encuestaupdate" action="" method="">
        @csrf
        @method('put')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" align="center">DATOS PERSONALES</h5>
                <!--Fila 1-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nombre">{{ $preguntas[0]['Descripcion'] }}</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" onkeyup="mayusculas(this);"required="" value="{{ $persona[0]->Nombre != null?$persona[0]->Nombre:"" }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="apellido_p">{{ $preguntas[1]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="apellido_p" name="apellido_p" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->APaterno != null?$persona[0]->APaterno:"" }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="apellido_m">{{ $preguntas[2]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="apellido_m" name="apellido_m" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->AMaterno != null?$persona[0]->AMaterno:'' }}">
                    </div>
                </div>
                <!--Fin de Fila 1-->
                <!--fila 2-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="curp">{{ $preguntas[3]['Descripcion'] }}</label>
                        <input type="tex" class="form-control" id="curp" name="curp" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->CURP != null?$persona[0]->CURP:'' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estadocivil">Estado Civil</label>
                        <br>
                        <select id="estadocivil" class="form-control" name="estadocivil" required="">
                            @if ($persona[0]->EstadoCivilId == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @foreach ($estadosCiviles as $estadocivil)
                                @if ($estadocivil->id == $persona[0]->EstadoCivilId)
                                    <option selected value="{{$estadocivil->id}}">{{$estadocivil->Descripcion}}</option>
                                @else
                                    <option value="{{$estadocivil->id}}">{{$estadocivil->Descripcion}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sexo">{{ $preguntas[7]['Descripcion'] }}</label>
                        <select id="sexo" class="form-control" name="sexo">
                            @if ($persona[0]->Sexo == null)
                                <option value="" selected>Seleccione una opcion</option>
                                <option value="M">HOMBRE</option>
                                <option value="F">MUJER</option>
                            @elseif ($persona[0]->Sexo == "M")
                                <option selected value="M">HOMBRE</option>
                                <option value="F">MUJER</option>
                            @else
                                <option value="M">HOMBRE</option>
                                <option selected value="F">MUJER</option>
                            @endif

                        </select>
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="rfc">{{ $preguntas[4]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="rfc" name="rfc" onkeyup="mayusculas(this);" value="{{ $persona[0]->RFC != null?$persona[0]->RFC:'' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="clave_elector" for="clave_e">{{ $preguntas[5]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="clave_elector" name="clave_elector" onkeyup="mayusculas(this);" value="{{ $persona[0]->ClaveElector != null?$persona[0]->ClaveElector:'' }}">
                    </div> --}}
                </div>
                <!--fin de fila 2-->

                <!-- Fila 3-->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="estado_nac">{{ $preguntas[9]['Descripcion'] }}</label>
                        <select id="estado_nac" class="form-control" name="estado_nac" required="">
                            @if ($persona[0]->EstadoNacimientoId == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @foreach ($estados as $estado)
                                @if ($estado->id == $persona[0]->EstadoNacimientoId)
                                    <option selected value="{{$estado->id}}">{{$estado->Descripcion}}</option>
                                @else
                                    <option value="{{$estado->id}}">{{$estado->Descripcion}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ciudad_nac">{{ $preguntas[8]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="ciudad_nac" name="ciudad_nac" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->CiudadNacimiento != null?$persona[0]->CiudadNacimiento	:'' }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_na">{{ $preguntas[10]['Descripcion'] }}</label><br>
                        <input type="date" class="form-control" id="fecha_na" name="fecha_na" required="" value="{{ $persona[0]->FechaNacimiento != null?$persona[0]->FechaNacimiento:'' }}"><br>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cod_postal">{{ $preguntas[21]['Descripcion'] }}</label>
                        <input id="cod_postal" type="number" class="form-control" name="cod_postal" value="{{ $persona[0]->CP != null?$persona[0]->CP:'' }}">
                    </div>
                </div>
                        <!-- Fin de Fila 3-->
                        <!--fila4-->
                        {{-- <div class="form-row"> --}}


                            {{-- <div class="form-group col-md-4">
                                <label for="grado_estudios">{{ $preguntas[11]['Descripcion'] }}</label>
                                <select value="" id="grado_estudios" class="form-control" name="grado_estudios">
                                    @if ($persona[0]->GradoEstudiosId == null)
                                        <option value="" selected>Seleccione una opcion</option>
                                    @endif
                                    @foreach ($estudios as $estudio)
                                        @if ($estudio->id == $persona[0]->GradoEstudiosId)
                                            <option selected value="{{$estudio->id}}">{{$estudio->Descripcion}}</option>
                                        @else
                                            <option value="{{$estudio->id}}">{{$estudio->Descripcion}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div> --}}

                        {{-- </div> --}}
                        <!--fin fila 4-->
                        <!--fila5-->
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="calle">{{ $preguntas[13]['Descripcion'] }}</label><br>
                        <input id="calle" type="text" name="calle" class="form-control" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->Calle != null?$persona[0]->Calle:'' }}"/><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="manzana">{{ $preguntas[14]['Descripcion'] }}</label><br>
                        <input id="manzana" type="text" name="manzana" class="form-control" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->Manzana != null?$persona[0]->Manzana:'' }}"/><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="lote">{{ $preguntas[15]['Descripcion'] }}</label><br>
                        <input id="lote" type="tex" name="lote" class="form-control" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->Lote != null?$persona[0]->Lote:'' }}"/><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="num_exterior">{{ $preguntas[16]['Descripcion'] }}</label><br>
                        <input id="num_exterior" type="text" name="num_exterior" class="form-control" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->NoExt != null?$persona[0]->NoExt:'' }}"/><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="num_interior">{{ $preguntas[17]['Descripcion'] }}</label><br>
                        <input id="num_interior" type="tex" name="num_interior" class="form-control" onkeyup="mayusculas(this);" value="{{ $persona[0]->NoInt != null?$persona[0]->NoInt:'' }}"/><br>
                    </div>
                </div>
                <!--fin fila 5-->
                <!--Fila 6-->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="">{{ $preguntas[18]['Descripcion'] }}</label>
                        <input readonly type="text" class="form-control" aria-disabled="true" value="{{ $estados[22]['Descripcion'] }}">
                        <input hidden type="text" class="form-control" aria-disabled="true" name="estado" value="23"> <!--23 es el indice de quintana Roo-->
                    </div>
                    <div class="form-group col-md-3">
                        <label for="municipio">{{ $preguntas[19]['Descripcion'] }}</label>
                        {{-- <input type="text" class="form-control" name="municipio"> --}}
                        <select id="municipio" class="form-control" name="municipio" required="">
                            @if ($persona[0]->MunicipioId == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @foreach ($municipios as $municipio)
                                @if ($municipio->id == $persona[0]->MunicipioId)
                                    <option selected value="{{$municipio->id}}">{{$municipio->Descripcion}}</option>
                                @else
                                    <option value="{{$municipio->id}}">{{$municipio->Descripcion}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="localidad">{{ $preguntas[20]['Descripcion'] }}</label>
                        {{-- <input type="text" class="form-control" name="localidad"> --}}
                        <select id="localidad" class="form-control" name="localidad" required="">
                            @if ($persona[0]->LocalidadId == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @if ($localidades)
                                @foreach ($localidades as $localidad)
                                    @if ($localidad->id == $persona[0]->LocalidadId)
                                        <option selected value="{{$localidad->id}}">{{$localidad->Descripcion}}</option>
                                    @else
                                        <option value="{{$localidad->id}}">{{$localidad->Descripcion}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="colonia">{{ $preguntas[12]['Descripcion'] }}</label><br>
                        <select for id="colonia" class="form-control" name="colonia" required="">
                            @if ($persona[0]->ColoniaId == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @if ($localidades)
                                @foreach ($colonias as $colonia)
                                    @if ($colonia->id == $persona[0]->ColoniaId)
                                        <option selected value="{{$colonia->id}}">{{$colonia->Descripcion}}</option>
                                    @else
                                        <option value="{{$colonia->id}}">{{$colonia->Descripcion}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        <br>
                    </div>

                </div>
                <!-- fin fila 6-->
                <!--FILA 7-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tel_cel">{{ $preguntas[22]['Descripcion'] }}</label>
                        <input id="tel_cel" type="number" class="form-control" name="tel_cel"  value="{{ $persona[0]->TelefonoCelular != null?$persona[0]->TelefonoCelular:'' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tel_casa">{{ $preguntas[23]['Descripcion'] }}</label>
                        <input id="tel_casa" type="number" class="form-control" name="tel_casa" value="{{ $persona[0]->TelefonoCasa != null?$persona[0]->TelefonoCasa:'' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="correo_ele">{{ $preguntas[24]['Descripcion'] }}</label>
                        <input id="correo_ele" type="email" class="form-control" name="correo_ele" value="{{ $persona[0]->Email != null?$persona[0]->Email:'' }}">
                    </div>
                </div>
                <!-- FIN DE FILA 7-->
                <!--fila 8-->
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="cuantas_per_viven_casa">{{ $preguntas[32]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cuantas_per_viven_casa" name="cuantas_per_viven_casa"  value="{{ $persona[0]->Pregunta_33 != null?$persona[0]->Pregunta_33:''}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="menores_sin_acta">{{ $preguntas[101]['Descripcion'] }}</label>
                        <select for id="menores_sin_acta" class="form-control" name="menores_sin_acta" >
                            @if ($persona[0]->Pregunta_102 !== null)
                                @if ($persona[0]->Pregunta_102 == 1)
                                    <option selected value="{{$persona[0]->Pregunta_102}}">SI</option>
                                    <option value="0">NO</option>
                                @else 
                                    <option value="1">SI</option>
                                    <option selected value="{{$persona[0]->Pregunta_102}}">NO</option>
                                @endif
                            @else
                                <option value="" selected>Seleccione una opcion</option>
                                <option value="1">si</option>
                                <option value="0">no</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="considera_indigena">{{ $preguntas[102]['Descripcion'] }}</label>
                        <select for id="considera_indigena" class="form-control" name="considera_indigena" >
                            @if ($persona[0]->Pregunta_103 !== null)
                                @if ($persona[0]->Pregunta_103 == 1)
                                    <option selected value="{{$persona[0]->Pregunta_103}}">SI</option>
                                    <option value="0">NO</option>
                                @else 
                                    <option value="1">SI</option>
                                    <option selected value="{{$persona[0]->Pregunta_103}}">NO</option>
                                @endif
                            @else
                                <option value="" selected>Seleccione una opcion</option>
                                <option value="1">si</option>
                                <option value="0">no</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="extranjero">{{ $preguntas[6]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="extranjero" name="extranjero" onkeyup="mayusculas(this);" value="{{ $persona[0]->IdentificacionMigratoria != null?$persona[0]->IdentificacionMigratoria	:'' }}">
                    </div>
                </div>

                @if (Auth::check() && Auth::user()->tipoUsuarioId == 0)
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="benef_type">Tipo Beneficiario</label>
                            <select id="benef_type" class="form-control" name="benef_type" required="">
                                @if ($persona[0]->idTipoBeneficiario == null)
                                    <option value="" selected>Seleccione una opcion</option>
                                @endif
                                @if ($tiposbeneficiario)
                                    @foreach ($tiposbeneficiario as $tipobeneficiario)
                                        @if ($tipobeneficiario->id == $persona[0]->idTipoBeneficiario)
                                            <option selected value="{{$tipobeneficiario->id}}">{{$tipobeneficiario->Descripcion}}</option>
                                        @else
                                            <option value="{{$tipobeneficiario->id}}">{{$tipobeneficiario->Descripcion}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                @endif

                <br>
                <div class="form-row">
                    <button type="submit" name="send" class="btn btn-success"><strong>ACTUALIZAR</strong></button>
                </div>
                <!--fin fila 9-->
            </div>
        </div>
        <!--fin de datos personales-->
        <br><br>
        <input type="hidden" value="{{ $persona[0]->Intentos }}" data-persona="{{ $persona[0]->id }}" id="ntn">
    </form>
        @if (auth()->check())
        <div id="banerSotck">
            <h5 align="center" style="background:@if(count($stock)>0) {{($stock[0]->stockDespensas >= 70)?'#5bc0de' : ($stock[0]->stockDespensas>= 30 ? '#ffc107' : '#dc3545')}} @else'5bc0de'@endif;text-align:center;color: white;font-size:26px;"> Disponibilidad: <span>{{$stock[0]->stockDespensas}}</span></h5>
        </div>
        @endif

        <div class="card">
            <div class="card-body" id="entcont">

                @if (count($listaentregas) > 0)

                    <h5 class="card-title" align="center">LISTA DE ENTREGAS</h5>
                    <br>
                    <table class="table">

                        @if (count($listaentregas) > 1 || $listaentregas[0]->idEntrega !== null)
                            <tr>
                                <th>FOLIO</th><th>MUNICIPIO</th><th>LOCALIDAD</th><th>DIRECCION</th><th>BIMESTRE</th><th>FECHA ENTREGA</th><th>PERIODO</th><th>CENTRO DE ENTREGA</th><th>OBSERVACIÓN</th><th>FOTO</th>
                            </tr>
                        @endif

                        @php($validatelastent = 1)

                        @foreach ($listaentregas as $entrega)

                            @if ($entrega->idEntrega !== null)
                                <tr>
                                    <td> {{$entrega->idDocumentacion != null ? $entrega->idDocumentacion : "N/D"}} </td>
                                    <td> {{$entrega->municipio != null ? $entrega->municipio : "N/D" }} </td>
                                    <td> {{$entrega->localidad != null ? $entrega->localidad : "N/D" }} </td>
                                    <td> {{$entrega->Direccion != null? $entrega->Direccion : "N/D" }}</td>
                                    <td> {{$entrega->periodoEntrega != null ? $entrega->periodoEntrega : "N/D" }}</td>
                                    <td> {{$entrega->fechaEntrega != null ? $entrega->fechaEntrega : "N/D" }}</td>
                                    <td> {{$entrega->periodo != null ? $entrega->periodo : "N/D" }}</td>
                                    <td> {{$entrega->centroentregaentrega != null ? $entrega->centroentregaentrega : "N/D" }}</td>
                                    <td> {{$entrega->comentario != null ? $entrega->comentario : "N/D" }}</td>
                                    <td>@if ($entrega->periodo == 2021)<a role="button" href="/documentacion/download/fotoentrega/{{$persona[0]->id}}/{{$entrega->idDocumentacion}}" class="btn btn-primary" target="_blank"><span style="font-size: 1.2em; color: white;" class="fa fa-eye"></span></a></td>@else N/D @endif 
                                </tr>

                            @else
                                <tr class="table-dark">
                                    <td colspan="10" style="text-align: center; padding-top: 2px; padding-bottom: 0; color: black;"><h4> FECHA DE EMPADRONAMIENTO: {{$persona[0]->created_at}}</h4></td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        Folio: {{$entrega->idDocumentacion}} - Centro de Entrega: <strong>{{$entrega->centroentrega}}</strong> - Direcccion: {{$entrega->direccioncentroentrega}}
                                    </td>
                                    <td colspan="3">
                                        <button style="color: white" id="editarDoc" class="btn btn-warning mb-1" data-folio="{{$entrega->idDocumentacion}}">Documentacion</button>
                                        @if (auth()->check())
                                            @if ($listo['folio'] == $entrega->idDocumentacion && $listo['completo'] == 1)
                                            <button style="color: white" id="entregaenupdatebtn" class="btn btn-success mb-1" data-folio="{{$entrega->idDocumentacion}}">Entrega</button>
                                                {{-- @if (Auth::user()->tipoUsuarioId == 0)  --}}
                                                    <button style="color: white" id="entregaenupdatedocbtn" class="btn btn-info mb-1" data-folio="{{$entrega->idDocumentacion}}">Entrega Posterior</button>
                                                {{-- @endif --}}
                                            @elseif ($listo['folio'] != $entrega->idDocumentacion)
                                                <label>Algo anda mal favor de reportar los folios: {{$listo['folio']}} y {{$entrega->idDocumentacion}} </label>
                                            @endif
                                        @endif
                                    </td> 
                                </tr>
                                <tr class="table-dark">
                                    <td colspan="10"></td>
                                </tr>
                                <tr>
                                    <td colspan="10">
                                        <p>Favor de estar pendiente de las fechas de entrega de despensas que serán publicadas en la página oficial del Programa Hambre Cero: <a href="https://qroo.gob.mx/sedeso/hambreceroquintanaroo">https://qroo.gob.mx/sedeso/hambreceroquintanaroo</a> y en las redes sociales oficiales de la Secretaría de Desarrollo Social de Quintana Roo: en Facebook <a href="https://www.facebook.com/SedesoQroo/">https://www.facebook.com/SedesoQroo/</a> y en Twitter <a href="https://twitter.com/sedeso_qroo">https://twitter.com/sedeso_qroo</a></p> 
                                        <p>Verifique en el portal oficial del Programa Hambre Cero, la ubicación del centro de entrega (PASO 4) que le corresponde y los datos bancarios de la cuenta donde deberá realizar el pago de la cuota de recuperación (PASO 3).</p>
                                        <p>Recuerde presentarse al centro de entrega asignado con los documentos que registró en original, únicamente para su cotejo de información. El recibo de pago de cuota de recuperación lo debe presentar también en original y se quedará en el centro de entrega.</p>
                                    </td>
                                </tr>


                                @php($validatelastent = 0)

                            @endif
                        @endforeach
                    </table>

                    @if ($validatelastent == 1)
                        <br>
                        {{-- <tr>
                            <td colspan="2"></td>
                            <td colspan="2"> --}}
                                <a class="btn btn-success" id="solicitarD" name="solicitarD"  role="button" aria-pressed="true">Subir Documentos</a>
                            {{-- </td>
                            <td colspan="2"></td>
                        </tr> --}}
                    @endif
                @else
                    <a class="btn btn-success" id="solicitarD" name="solicitaD" role="button" aria-pressed="true">Subir Documentos</a>
                @endif

            </div>
        </div>
        <br><br>
        <div class="card" style="display: none">
            <div class="card-body" id="documentacionEdit">
                
            </div>
        </div>
        <div class="card" style="display: none">
            <div class="card-body" id="entregaEnUpdate">
                
            </div>
        </div>
        <br><br>

    <div class="container">
        <div class="row justify-content-around">
            <a href="/" name="rel" class="btn btn-secondary col-2" role="button" aria-pressed="true">Salir</a>
        </div>
    </div>
    <br>

    <div class="modal fade" id="encuestaupdatemodal" tabindex="-1" role="dialog" aria-labelledby="encuestaupdatemodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="encuestaupdatemodalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-btn="cpt">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-btn="cnl">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
