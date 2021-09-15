@extends('2021.layouts.app')

@section('content')

    {{-- <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <img src="{{asset('img/logo_nesesidades2021.jpeg')}}" class="img-fluid img-thumbnail">
            </div>
        </div>
    </div> --}}
    <!--Datos Personales-->
     <br>
    {{--<br> --}}
    <form id="entregaupdate2021" action="" method="">
        @csrf
        @method('put')
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" align="center"> DATOS PERSONALES ENTREGA: {{$bitacora[0]->id}}</h5>
                <!--Fila 1-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nombre">{{ $preguntas[0]['Descripcion'] }}</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" onkeyup="mayusculas(this);"required="" value="{{ $bitacora[0]->Nombre != null?$bitacora[0]->Nombre:"" }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="apellido_p">{{ $preguntas[1]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="apellido_p" name="apellido_p" onkeyup="mayusculas(this);" required="" value="{{ $bitacora[0]->APaterno != null?$bitacora[0]->APaterno:"" }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="apellido_m">{{ $preguntas[2]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="apellido_m" name="apellido_m" onkeyup="mayusculas(this);" required="" value="{{ $bitacora[0]->AMaterno != null?$bitacora[0]->AMaterno:'' }}">
                    </div>
                </div>
                <!--Fin de Fila 1-->
                <!--fila 2-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="curp">{{ $preguntas[3]['Descripcion'] }}</label>
                        <input type="tex" class="form-control" id="curp" name="curp" onkeyup="mayusculas(this);" required="" value="{{ $bitacora[0]->CURP != null?$bitacora[0]->CURP:'' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estadocivil">Estado Civil</label>
                        <br>
                        <select id="estadocivil" class="form-control" name="estadocivil" required="">
                            @if ($bitacora[0]->EstadoCivilId == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @foreach ($estadosCiviles as $estadocivil)
                                @if ($estadocivil->id == $bitacora[0]->EstadoCivilId)
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
                            @if ($bitacora[0]->Sexo == null)
                                <option value="" selected>Seleccione una opcion</option>
                                <option value="M">HOMBRE</option>
                                <option value="F">MUJER</option>
                            @elseif ($bitacora[0]->Sexo == "M")
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
                        <input type="text" class="form-control" id="rfc" name="rfc" onkeyup="mayusculas(this);" value="{{ $bitacora[0]->RFC != null?$bitacora[0]->RFC:'' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="clave_elector" for="clave_e">{{ $preguntas[5]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="clave_elector" name="clave_elector" onkeyup="mayusculas(this);" value="{{ $bitacora[0]->ClaveElector != null?$bitacora[0]->ClaveElector:'' }}">
                    </div> --}}
                </div>
                <!--fin de fila 2-->

                <!-- Fila 3-->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="estado_nac">{{ $preguntas[9]['Descripcion'] }}</label>
                        <select id="estado_nac" class="form-control" name="estado_nac" required="">
                            @if ($bitacora[0]->EstadoNacimientoId == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @foreach ($estados as $estado)
                                @if ($estado->id == $bitacora[0]->EstadoNacimientoId)
                                    <option selected value="{{$estado->id}}">{{$estado->Descripcion}}</option>
                                @else
                                    <option value="{{$estado->id}}">{{$estado->Descripcion}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ciudad_nac">{{ $preguntas[8]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="ciudad_nac" name="ciudad_nac" onkeyup="mayusculas(this);" required="" value="{{ $bitacora[0]->CiudadNacimiento != null?$bitacora[0]->CiudadNacimiento	:'' }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_na">{{ $preguntas[10]['Descripcion'] }}</label><br>
                        <input type="date" class="form-control" id="fecha_na" name="fecha_na" required="" value="{{ $bitacora[0]->FechaNacimiento != null?$bitacora[0]->FechaNacimiento:'' }}"><br>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cod_postal">{{ $preguntas[21]['Descripcion'] }}</label>
                        <input id="cod_postal" type="number" class="form-control" name="cod_postal" value="{{ $bitacora[0]->CP != null?$bitacora[0]->CP:'' }}">
                    </div>
                </div>
                        
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="calle">{{ $preguntas[13]['Descripcion'] }}</label><br>
                        <input id="calle" type="text" name="calle" class="form-control" onkeyup="mayusculas(this);" required="" value="{{ $bitacora[0]->Calle != null?$bitacora[0]->Calle:'' }}"/><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="manzana">{{ $preguntas[14]['Descripcion'] }}</label><br>
                        <input id="manzana" type="text" name="manzana" class="form-control" onkeyup="mayusculas(this);" required="" value="{{ $bitacora[0]->Manzana != null?$bitacora[0]->Manzana:'' }}"/><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="lote">{{ $preguntas[15]['Descripcion'] }}</label><br>
                        <input id="lote" type="tex" name="lote" class="form-control" onkeyup="mayusculas(this);" required="" value="{{ $bitacora[0]->Lote != null?$bitacora[0]->Lote:'' }}"/><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="num_exterior">{{ $preguntas[16]['Descripcion'] }}</label><br>
                        <input id="num_exterior" type="text" name="num_exterior" class="form-control" onkeyup="mayusculas(this);" required="" value="{{ $bitacora[0]->NoExt != null?$bitacora[0]->NoExt:'' }}"/><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="num_interior">{{ $preguntas[17]['Descripcion'] }}</label><br>
                        <input id="num_interior" type="tex" name="num_interior" class="form-control" onkeyup="mayusculas(this);" value="{{ $bitacora[0]->NoInt != null?$bitacora[0]->NoInt:'' }}"/><br>
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
                            @if ($bitacora[0]->MunicipioId == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @foreach ($municipios as $municipio)
                                @if ($municipio->id == $bitacora[0]->MunicipioId)
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
                            @if ($bitacora[0]->LocalidadId == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @if ($localidades)
                                @foreach ($localidades as $localidad)
                                    @if ($localidad->id == $bitacora[0]->LocalidadId)
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
                            @if ($bitacora[0]->ColoniaId == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @if ($localidades)
                                @foreach ($colonias as $colonia)
                                    @if ($colonia->id == $bitacora[0]->ColoniaId)
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
                        <input id="tel_cel" type="number" class="form-control" name="tel_cel"  value="{{ $bitacora[0]->TelefonoCelular != null?$bitacora[0]->TelefonoCelular:'' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tel_casa">{{ $preguntas[23]['Descripcion'] }}</label>
                        <input id="tel_casa" type="number" class="form-control" name="tel_casa" value="{{ $bitacora[0]->TelefonoCasa != null?$bitacora[0]->TelefonoCasa:'' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="correo_ele">{{ $preguntas[24]['Descripcion'] }}</label>
                        <input id="correo_ele" type="email" class="form-control" name="correo_ele" value="{{ $bitacora[0]->Email != null?$bitacora[0]->Email:'' }}">
                    </div>
                </div>
                <!-- FIN DE FILA 7-->
                <!--fila 8-->
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="cuantas_per_viven_casa">{{ $preguntas[32]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cuantas_per_viven_casa" name="cuantas_per_viven_casa"  value="{{ $bitacora[0]->Pregunta_33 != null?$bitacora[0]->Pregunta_33:''}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="menores_sin_acta">{{ $preguntas[101]['Descripcion'] }}</label>
                        <select for id="menores_sin_acta" class="form-control" name="menores_sin_acta" >
                            @if ($bitacora[0]->Pregunta_102 !== null)
                                @if ($bitacora[0]->Pregunta_102 == 1)
                                    <option selected value="{{$bitacora[0]->Pregunta_102}}">SI</option>
                                    <option value="0">NO</option>
                                @else 
                                    <option value="1">SI</option>
                                    <option selected value="{{$bitacora[0]->Pregunta_102}}">NO</option>
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
                            @if ($bitacora[0]->Pregunta_103 !== null)
                                @if ($bitacora[0]->Pregunta_103 == 1)
                                    <option selected value="{{$bitacora[0]->Pregunta_103}}">SI</option>
                                    <option value="0">NO</option>
                                @else 
                                    <option value="1">SI</option>
                                    <option selected value="{{$bitacora[0]->Pregunta_103}}">NO</option>
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
                        <input type="text" class="form-control" id="extranjero" name="extranjero" onkeyup="mayusculas(this);" value="{{ $bitacora[0]->IdentificacionMigratoria != null?$bitacora[0]->IdentificacionMigratoria	:'' }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="centroEnt">Centro Entrega</label>
                        <select id="centroEnt" class="form-control" name="centroEnt" required="">
                            @if ($bitacora[0]->idCentroEntrega == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @if ($centrosEntrega)
                                @foreach ($centrosEntrega as $centroEntrega)
                                    @if ($centroEntrega->id == $bitacora[0]->idCentroEntrega)
                                        <option selected value="{{$centroEntrega->id}}">{{$centroEntrega->Descripcion}}</option>
                                    @else
                                        <option value="{{$centroEntrega->id}}">{{$centroEntrega->Descripcion}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                {{-- @if (Auth::check() && Auth::user()->tipoUsuarioId == 0)
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="benef_type">Tipo Beneficiario</label>
                            <select id="benef_type" class="form-control" name="benef_type" required="">
                                @if ($bitacora[0]->idTipoBeneficiario == null)
                                    <option value="" selected>Seleccione una opcion</option>
                                @endif
                                @if ($tiposbeneficiario)
                                    @foreach ($tiposbeneficiario as $tipobeneficiario)
                                        @if ($tipobeneficiario->id == $bitacora[0]->idTipoBeneficiario)
                                            <option selected value="{{$tipobeneficiario->id}}">{{$tipobeneficiario->Descripcion}}</option>
                                        @else
                                            <option value="{{$tipobeneficiario->id}}">{{$tipobeneficiario->Descripcion}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                @endif --}}

                <br>
                <div class="form-row">
                    <button type="submit" name="sendUpdateEntrega" class="btn btn-success"><strong>ACTUALIZAR</strong></button>
                </div>
                <!--fin fila 9-->
            </div>
        </div>
        <!--fin de datos personales-->
        <br><br>
        <input type="hidden" data-entrega="{{ $bitacora[0]->id }}" id="hid">
    </form>
  
    <div class="container">
        <div class="row justify-content-around">
            <a href="/admin2021/entrega" name="rel" class="btn btn-secondary col-2" role="button" aria-pressed="true">Regresar</a>
        </div>
    </div>
    <br>

@endsection
