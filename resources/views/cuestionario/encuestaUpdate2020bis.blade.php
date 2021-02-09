@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <img src="{{asset('img/logo_nesesidades.jpg')}}" class="img-fluid img-thumbnail">
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
                        <label for="rfc">{{ $preguntas[4]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="rfc" name="rfc" onkeyup="mayusculas(this);" value="{{ $persona[0]->RFC != null?$persona[0]->RFC:'' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="clave_elector" for="clave_e">{{ $preguntas[5]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="clave_elector" name="clave_elector" onkeyup="mayusculas(this);" value="{{ $persona[0]->ClaveElector != null?$persona[0]->ClaveElector:'' }}">
                    </div>
                </div>
                <!--fin de fila 2-->
              
                <!-- Fila 3-->
                <div class="form-row">
                    <div class="form-group col-md-3">
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
                    <div class="form-group col-md-3">
                        <label for="sexo">{{ $preguntas[7]['Descripcion'] }}</label>
                        <select id="sexo" class="form-control" name="sexo">
                            @if ($persona[0]->Sexo == null)
                                <option value="" selected>Seleccione una opcion</option>
                                <option value="M">MASCULINO</option>
                                <option value="F">FEMENINO</option>
                            @elseif ($persona[0]->Sexo == "M")
                                <option selected value="M">MASCULINO</option>
                                <option value="F">FEMENINO</option>
                            @else
                                <option value="M">MASCULINO</option>
                                <option selected value="F">FEMENINO</option>
                            @endif
                            
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ciudad_nac">{{ $preguntas[8]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="ciudad_nac" name="ciudad_nac" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->CiudadNacimiento != null?$persona[0]->CiudadNacimiento	:'' }}">
                    </div>
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
                </div>
                <!-- Fin de Fila 3-->
                <!--fila4-->
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="fecha_na">{{ $preguntas[10]['Descripcion'] }}</label><br>
                        <input type="date" class="form-control" id="fecha_na" name="fecha_na" required="" value="{{ $persona[0]->FechaNacimiento != null?$persona[0]->FechaNacimiento:'' }}"><br>
                    </div>
                    <div class="form-group col-md-4">
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
                    </div>
                    <div class="form-group col-md-4">
                        <label for="colonia">{{ $preguntas[12]['Descripcion'] }}</label><br>
                        <select for id="colonia" class="form-control" name="colonia" required="">
                            @if ($persona[0]->ColoniaId == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @foreach ($colonias as $colonia)
                                @if ($colonia->id == $persona[0]->ColoniaId)
                                    <option selected value="{{$colonia->id}}">{{$colonia->Descripcion}}</option>
                                @else
                                    <option value="{{$colonia->id}}">{{$colonia->Descripcion}}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                    </div>
                </div>
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
                            @foreach ($localidades as $localidad)
                                @if ($localidad->id == $persona[0]->LocalidadId)
                                    <option selected value="{{$localidad->id}}">{{$localidad->Descripcion}}</option>
                                @else
                                    <option value="{{$localidad->id}}">{{$localidad->Descripcion}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cod_postal">{{ $preguntas[21]['Descripcion'] }}</label>
                        <input id="cod_postal" type="number" class="form-control" name="cod_postal" value="{{ $persona[0]->CP != null?$persona[0]->CP:'' }}">
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
                    <div class="form-group col-md-8">
                        <label for="extranjero">{{ $preguntas[6]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="extranjero" name="extranjero" onkeyup="mayusculas(this);" value="{{ $persona[0]->IdentificacionMigratoria != null?$persona[0]->IdentificacionMigratoria	:'' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cuantas_per_viven_casa">{{ $preguntas[32]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cuantas_per_viven_casa" name="cuantas_per_viven_casa"  value="{{ $persona[0]->Pregunta_33 != null?$persona[0]->Pregunta_33:''}}">
                    </div>
                </div>
                <!--fin fila 9-->
            </div>
        </div>
        <!--fin de datos personales-->
        <br><br>
        <br><br>
            <div class="container">
                
                <button type="submit" name="send" class="btn btn-success"><strong>Guardar</strong></button>
                <div class="row justify-content-around">
                    <a style="display: none;" href="/imprimir/{{$persona[0]->id}}" name="accion" class="btn btn-primary col-2" id="action" role="button" aria-pressed="true" target="_blank">Descargar Formato</a>
                    <a style="display: none;" href="/" name="rel" class="btn btn-secondary col-2" role="button" aria-pressed="true">Regresar</a>
                </div>
            </div>
        </div>
        <input type="hidden" value="{{ $persona[0]->Intentos }}" data-persona="{{ $persona[0]->id }}" id="ntn">
    </form>
    <br>
    <!--FIN  FACTORES DE RIESGO-->

@endsection
