@extends('layouts.app')

@section('content')

    {{-- <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#">INFORMACION GENERAL</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">INFORMACION FAMILIAR Y VIVIENADA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">INFORMACION GENERAL DE SALUD</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">ACCESO A LA ALIMENTACIÓN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">INFORMACIÓN DE DESARROLLO HUMANO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">INSTRUMENTO DE IDENTIFICACIÓN DE FACTORES DE RIESGO</a>
        </li>
    </ul> --}}

    {{-- @foreach ($preguntas as $pregunta)
        <p>{{ $pregunta->Descripcion }}</p>
    @endforeach --}}

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
                        <input type="text" class="form-control" id="rfc" name="rfc" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->RFC != null?$persona[0]->RFC:'' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="clave_elector" for="clave_e">{{ $preguntas[5]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="clave_elector" name="clave_elector" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->ClaveElector != null?$persona[0]->ClaveElector:'' }}">
                    </div>
                </div>
                <!--fin de fila 2-->
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="extranjero">{{ $preguntas[6]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="extranjero" name="extranjero" onkeyup="mayusculas(this);" value="{{ $persona[0]->IdentificacionMigratoria != null?$persona[0]->IdentificacionMigratoria	:'' }}">
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="gruposocial">Grupo Social</label>
                        <br>
                        <select id="gruposocial" class="form-control" name="gruposocial" >
                            <option value="" selected>Seleccione una opcion</option>
                            @foreach ($gruposociales as $gruposocial)
                                <option value="{{$gruposocial->id}}">{{$gruposocial->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div> --}}
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
                </div>
                <!-- Fila 3-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="sexo">{{ $preguntas[7]['Descripcion'] }}</label>
                        <select id="sexo" class="form-control" name="sexo" required="">
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
                    <div class="form-group col-md-4">
                        <label for="ciudad_nac">{{ $preguntas[8]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="ciudad_nac" name="ciudad_nac" onkeyup="mayusculas(this);" required="" value="{{ $persona[0]->CiudadNacimiento != null?$persona[0]->CiudadNacimiento	:'' }}">
                    </div>
                    <div class="form-group col-md-4">
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
                        <select value="" id="grado_estudios" class="form-control" name="grado_estudios" required="">
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
                        <input id="cod_postal" type="number" class="form-control" name="cod_postal" required="" value="{{ $persona[0]->CP != null?$persona[0]->CP:'' }}">
                    </div>
                </div>
                <!-- fin fila 6-->
                <!--FILA 7-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tel_cel">{{ $preguntas[22]['Descripcion'] }}</label>
                        <input id="tel_cel" type="number" class="form-control" name="tel_cel" required=""  value="{{ $persona[0]->TelefonoCelular != null?$persona[0]->TelefonoCelular:'' }}">
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
                    <div class="form-group col-md-5">
                        <div class="col-md-12">
                            <label>{{ $preguntas[25]['Descripcion'] }}</label>
                        </div>
                        <div class="col-md-12 row justify-content-center">
                            <div class="form-check  form-check-inline">
                                <input id="si1" class="form-check-input" type="radio" name="cuenta_apoyo_dependencia" value="1" {{ $persona[0]->Pregunta_26 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si1">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no1" class="form-check-input" type="radio" name="cuenta_apoyo_dependencia" value="0" {{ $persona[0]->Pregunta_26 === 0?'checked=':'' }}>
                                <label class="form-check-label" for="no1">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- fin fila 8-->
                    <!--fila9-->
                    <div class="form-group col-md-7">
                        <label for="nombre_dependencia" class="col-sm-12 col-form-label">{{ $preguntas[26]['Descripcion'] }}</label>
                        <div class="col-sm-12">
                            <input id="nombre_dependencia" type="text" class="form-control" name="nombre_dependencia" value="{{ $persona[0]->Pregunta_27 != null?$persona[0]->Pregunta_27:'' }}">
                        </div>
                    </div>
                </div>
                <!--fin fila 9-->
            </div>
        </div>
        <!--fin de datos personales-->
        <br><br>
        <!--informacion familiar y de vicienda-->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" align="center">INFORMACIÓN FAMILIAR Y VIVIENDA</h5>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="col-md-12">
                            <label>{{ $preguntas[27]['Descripcion'] }}</label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si2" class="form-check-input" type="radio" name="casa_propia" value="1" {{ $persona[0]->Pregunta_28 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si2">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no2" class="form-check-input" type="radio" name="casa_propia" value="0" {{ $persona[0]->Pregunta_28 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no2">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="col-md-12">
                            <label>{{ $preguntas[28]['Descripcion'] }}</label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si3" class="form-check-input" type="radio" name="paga_renta" value="1" {{ $persona[0]->Pregunta_29 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si3">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no3" class="form-check-input" type="radio" name="paga_renta" value="0" {{ $persona[0]->Pregunta_29 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no3">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin de fila 1-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="renta_mensual" for="nombre">{{ $preguntas[29]['Descripcion'] }}</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="renta_mensual" name="renta_mensual" value="{{ $persona[0]->Pregunta_30 != null?$persona[0]->Pregunta_30:''}}">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="col-sm-12">
                            <label>{{ $preguntas[30]['Descripcion'] }}</label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si4" class="form-check-input" type="radio" name="casa_credito" value="1" {{ $persona[0]->Pregunta_31 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si4">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no4" class="form-check-input" type="radio" name="casa_credito" value="0" {{ $persona[0]->Pregunta_31 ==0?'checked':'' }}>
                                <label class="form-check-label" for="no4">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin de fila2-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cuanto_paga_credito">{{ $preguntas[31]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cuanto_paga_credito" name="cuanto_paga_credito" value="{{ $persona[0]->Pregunta_32 != null?$persona[0]->Pregunta_32:''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cuantas_per_viven_casa">{{ $preguntas[32]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cuantas_per_viven_casa" name="cuantas_per_viven_casa"  required="" value="{{ $persona[0]->Pregunta_33 != null?$persona[0]->Pregunta_33:''}}">
                    </div>
                </div>
                <!--fin de fila 3-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dependientes_economicos">{{ $preguntas[33]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="dependientes_economicos" name="dependientes_economicos" value="{{ $persona[0]->Pregunta_34 != null?$persona[0]->Pregunta_34:''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="menores_12">{{ $preguntas[34]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="menores_12" name="menores_12" value="{{ $persona[0]->Pregunta_35 != null?$persona[0]->Pregunta_35:''}}">
                    </div>
                </div>
                <!--fin de fila 4-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="personas_12a18">{{ $preguntas[35]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="personas_12a18" name="personas_12a18" value="{{ $persona[0]->Pregunta_36 != null?$persona[0]->Pregunta_36:''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ $preguntas[36]['Descripcion'] }}</label>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="col-md-12"><input type="number" class="form-control" name="si_cuantos" placeholder="Si Cuantos" value="{{ !empty($persona[0]->Pregunta_37)?(strpos($persona[0]->Pregunta_37,'#')!== false?explode("#",$persona[0]->Pregunta_37)[0]:0):0}}"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12"><input type="number" class="form-control" name="no_cuantos" placeholder="No Cuantos" value="{{!empty($persona[0]->Pregunta_37)?(strpos($persona[0]->Pregunta_37,'#')!== false?explode("#",$persona[0]->Pregunta_37)[1]:$persona[0]->Pregunta_37):0}}"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--fin de fila 5-->
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="adultos_mayores">{{ $preguntas[37]['Descripcion'] }}</label>
                        <input id="adultos_mayores" type="number" class="form-control" name="adultos_mayores" value="{{ $persona[0]->Pregunta_38 != null?$persona[0]->Pregunta_38:''}}">
                    </div>
                    <div class="form-group col-md-2 offset-md-1">
                        <label>{{ $preguntas[38]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si5" class="form-check-input" type="radio" name="trabaja" value="1" {{ $persona[0]->Pregunta_39 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si5">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no5" class="form-check-input" type="radio" name="trabaja" value="0" {{ $persona[0]->Pregunta_39 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no5">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="problema_no_trabaja">{{ $preguntas[39]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="problema_no_trabaja" name="problema_no_trabaja" value="{{ $persona[0]->Pregunta_40 != null?$persona[0]->Pregunta_40:''}}">
                    </div>
                </div>
                <!--fila 6-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cuantos_aportan_recursos">{{ $preguntas[40]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cuantos_aportan_recursos" name="cuantos_aportan_recursos" value="{{ $persona[0]->Pregunta_41 != null?$persona[0]->Pregunta_41:''}}">
                    </div>


                    <div class="form-group col-md-6">
                        <label>{{ $preguntas[41]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si6" class="form-check-input" type="radio" name="otros_ingresos" value="1" {{ $persona[0]->Pregunta_42 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si6">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no6" class="form-check-input" type="radio" name="otros_ingresos" value="0" {{ $persona[0]->Pregunta_42 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no6">No</label>
                            </div>
                        </div>
                    </div>
                    <!--fila 7-->
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="cuales">{{ $preguntas[42]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="cuales" name="cuales" value="{{ $persona[0]->Pregunta_43 != null?$persona[0]->Pregunta_43:''}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cto_asc_ing_extra">{{ $preguntas[43]['Descripcion'] }} </label>
                        <input type="number" class="form-control" id="cto_asc_ing_extra" name="cto_asc_ing_extra" value="{{ $persona[0]->Pregunta_44 != null?$persona[0]->Pregunta_44:''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cto_asc_ing_men_fam_total">{{ $preguntas[44]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cto_asc_ing_men_fam_total" name="cto_asc_ing_men_fam_total" value="{{ $persona[0]->Pregunta_45 != null?$persona[0]->Pregunta_45:''}}">
                    </div>
                </div>
                <!--Fila 8-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cto_asc_gast_men_fam_total">{{ $preguntas[45]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cto_asc_gast_men_fam_total" name="cto_asc_gast_men_fam_total" value="{{ $persona[0]->Pregunta_46 != null?$persona[0]->Pregunta_46:''}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[46]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si7" class="form-check-input" type="radio" value="1" name="luz" {{ $persona[0]->Pregunta_47 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si7">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no7" class="form-check-input" type="radio" value="0" name="luz" {{ $persona[0]->Pregunta_47 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no7">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[47]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si8" class="form-check-input" type="radio" name="agua" value="1" {{ $persona[0]->Pregunta_48 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si8">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no8" class="form-check-input" type="radio" name="agua" value="0" {{ $persona[0]->Pregunta_48 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no8">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--fila 9-->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[48]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si9" class="form-check-input" type="radio" name="drenaje"  value="1" {{ $persona[0]->Pregunta_49 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si9">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no9" class="form-check-input" type="radio" name="drenaje"  value="0" {{ $persona[0]->Pregunta_49 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no9">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[49]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si10" class="form-check-input" type="radio" name="piso_firme" value="1" {{ $persona[0]->Pregunta_50 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si10">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no10" class="form-check-input" type="radio" name="piso_firme" value="0" {{ $persona[0]->Pregunta_50 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no10">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[50]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si11" class="form-check-input" type="radio" name="tv" value="1" {{ $persona[0]->Pregunta_51 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si11">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no11" class="form-check-input" type="radio" name="tv" value="0" {{ $persona[0]->Pregunta_51 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no11">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[51]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si12" class="form-check-input" type="radio"mname="internet" value="1" {{ $persona[0]->Pregunta_52 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si12">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no12" class="form-check-input" type="radio" name="internet" value="0" {{ $persona[0]->Pregunta_52 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no12">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--fila 10-->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[52]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si13" class="form-check-input" type="radio" name="tv_paga" value="1" {{ $persona[0]->Pregunta_53 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si13">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no13" class="form-check-input" type="radio" name="tv_paga" value="0" {{ $persona[0]->Pregunta_53 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no13">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[53]['Descripcion'] }} </label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si14" class="form-check-input" type="radio" name="refrigerador" value="1" {{ $persona[0]->Pregunta_54 == 1?'checked':'' }}>
                                <label class="form-check-label" for="si14">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no14" class="form-check-input" type="radio" name="refrigerador" value="0" {{ $persona[0]->Pregunta_54 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no14">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[54]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si15" class="form-check-input" type="radio" name="microondas" value="1" {{ $persona[0]->Pregunta_55 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si15">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no15" class="form-check-input" type="radio" name="microondas" value="0" {{ $persona[0]->Pregunta_55 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no15">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[55]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si16" class="form-check-input" type="radio" name="computadora" name="computadora" value="1" {{ $persona[0]->Pregunta_56 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si16">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no16" class="form-check-input" type="radio" name="computadora" name="computadora" value="0" {{ $persona[0]->Pregunta_56 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no16">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--fila11-->
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>{{ $preguntas[56]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si17" class="form-check-input" type="radio" name="celular" value="1" {{ $persona[0]->Pregunta_57 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si17">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no17" class="form-check-input" type="radio" name="celular" value="0" {{ $persona[0]->Pregunta_57 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no17">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[57]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input id="si18" class="form-check-input" type="radio" name="automovil" value="1" {{ $persona[0]->Pregunta_58 == 1?'checked':'' }}> {{-- required=""> --}}
                                <label class="form-check-label" for="si18">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="no18" class="form-check-input" type="radio" name="automovil" value="0" {{ $persona[0]->Pregunta_58 === 0?'checked':'' }}>
                                <label class="form-check-label" for="no18">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-7">
                        <label>{{ $preguntas[58]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="" name="Tipo_material_A" value="{{ $materiales[0]['id'] }}" {{ in_array($materiales[0]['id'],explode("#",$persona[0]->Pregunta_59))?'checked':''  }} />
                                <label class="form-check-label" for="">{{ $materiales[0]['Descripcion'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="" name="Tipo_material_C" value="{{ $materiales[2]['id'] }}" {{ in_array($materiales[2]['id'],explode("#",$persona[0]->Pregunta_59))?'checked':'' }}>
                                <label class="form-check-label" for="">{{ $materiales[2]['Descripcion'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="" name="Tipo_material_B" value="{{ $materiales[1]['id'] }}" {{ in_array($materiales[1]['id'],explode("#",$persona[0]->Pregunta_59))?'checked':'' }}>
                                <label class="form-check-label" for="">{{ $materiales[1]['Descripcion'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="" name="Tipo_material_D" value="{{ $materiales[3]['id'] }}" {{ in_array($materiales[3]['id'],explode("#",$persona[0]->Pregunta_59))?'checked':'' }}>
                                <label class="form-check-label" for="">{{ $materiales[3]['Descripcion'] }} </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--fin card body-->
        </div>
        <!--FIN CARD BODY-->
        <!--fin de informacion familiar y de vicienda-->
        <br><br>
        <!--informacion salud-->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" align="center">INFORMACIÓN GENERAL DE SALUD</h5>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-md-12">
                                {{ $preguntas[59]['Descripcion'] }}
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si19" class="form-check-input" type="radio" name="servicios_salud" value="1" {{ $persona[0]->Pregunta_60 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si19">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no19"class="form-check-input" type="radio" name="servicios_salud" value="0" {{ $persona[0]->Pregunta_60 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no19">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div form-group row>
                            <div class="col-md-12">
                                {{ $preguntas[60]['Descripcion'] }}
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si20" class="form-check-input" type="radio" name="seguro_social" value="1" {{ $persona[0]->Pregunta_61 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si20">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no20" class="form-check-input" type="radio" name="seguro_social" value="0" {{ $persona[0]->Pregunta_61 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no20">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">

                        <label for="institucion">{{ $preguntas[61]['Descripcion'] }}</label>
                        {{-- <input type="text" class="form-control" id="" name="institucion"> --}}
                        <select id="institucion" class="form-control" name="institucion">
                            @if ($persona[0]->Pregunta_62 == null)
                                <option value="" selected>Seleccione una opcion</option>
                            @endif
                            @foreach ($ss as $s)
                                @if ($s->id == $persona[0]->Pregunta_62)
                                    <option selected value="{{$s->id}}">{{$s->Descripcion}}</option>
                                @else
                                    <option value="{{$s->id}}">{{$s->Descripcion}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--fin Fila 1-->
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="num_discapacidad">{{ $preguntas[62]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="num_discapacidad" name="num_discapacidad" value="{{ $persona[0]->Pregunta_63 != null?$persona[0]->Pregunta_63:''}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tipo_discapacidad">{{ $preguntas[63]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="tipo_discapacidad" name="tipo_discapacidad" value="{{ $persona[0]->Pregunta_64 != null?$persona[0]->Pregunta_64:''}}">
                    </div>
                    <div class="form-group col-md-3">
                        <div form-group row>
                            <div class="col-md-12">{{ $preguntas[64]['Descripcion'] }}</div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si21" class="form-check-input" type="radio" name="permanente" value="1" {{ $persona[0]->Pregunta_65 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si21">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no21" class="form-check-input" type="radio" name="permanente" value="0" {{ $persona[0]->Pregunta_65 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no21">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--fin de fila 2-->
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <div form-group row>
                            <div class="col-md-12"> {{ $preguntas[65]['Descripcion'] }}</div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si22" class="form-check-input" type="radio" name="hipertenso" value="1" {{ $persona[0]->Pregunta_66 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si22">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no22" class="form-check-input" type="radio" name="hipertenso" value="0" {{ $persona[0]->Pregunta_66 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no22">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="cuantos_h">{{ $preguntas[66]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cuantos_h" name="cuantos_h" value="{{ $persona[0]->Pregunta_67 != null?$persona[0]->Pregunta_67:''}}">
                    </div>
                    <div class="form-group col-md-5">
                        <div form-group row>
                            <div class="col-md-12">{{ $preguntas[67]['Descripcion'] }}</div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si23" class="form-check-input" type="radio" id="" name="diabetico" value="1" {{ $persona[0]->Pregunta_68 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si23">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no23" class="form-check-input" type="radio" id="" name="diabetico" value="0" {{ $persona[0]->Pregunta_68 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no23">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="cuantos_d">{{ $preguntas[68]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cuantos_d" name="cuantos_d" value="{{ $persona[0]->Pregunta_69 != null?$persona[0]->Pregunta_69:''}}">
                    </div>
                </div>
                <!--fin de fila 3-->

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <div form-group row>
                            <div class="col-md-12">
                                {{ $preguntas[69]['Descripcion'] }}
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si24" class="form-check-input" type="radio" name="obesidad" value="1" {{ $persona[0]->Pregunta_70 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si24">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no24" class="form-check-input" type="radio" name="obesidad" value="0" {{ $persona[0]->Pregunta_70 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no24">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="cuantos_ob">{{ $preguntas[70]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cuantos_ob" name="cuantos_ob" value="{{ $persona[0]->Pregunta_71 != null?$persona[0]->Pregunta_71:''}}">
                    </div>
                    <div class="form-group col-md-4">
                        <div form-group row>
                            <div class="col-md-12">
                                {{ $preguntas[71]['Descripcion'] }}
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si25" class="form-check-input" type="radio" id="" name="otra_enfermedad" value="1" {{ $persona[0]->Pregunta_72 == 1?'checked':'' }}>
                                    <label class="form-check-label" for="si25">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no25" class="form-check-input" type="radio" id="" name="otra_enfermedad" value="0" {{ $persona[0]->Pregunta_72 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no25">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cual_tiene">{{ $preguntas[72]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="cual_tiene" name="cual_tiene" value="{{ $persona[0]->Pregunta_73 != null?$persona[0]->Pregunta_73:''}}">
                    </div>
                </div>

                <!--fin de fila 4-->
                <!--fila 5-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[73]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="temas_salud" id="mucho" value="2" {{ $persona[0]->Pregunta_74 == 2?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="mucho">Mucho</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="temas_salud" id="poco" value="1" {{ $persona[0]->Pregunta_74 == 1?'checked':'' }}>
                                    <label class="form-check-label" for="poco">Poco</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="temas_salud" id="nada" value="0" {{ $persona[0]->Pregunta_74 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="nada">Nada</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[74]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si26" class="form-check-input" type="radio" name="Practica_alguna_actividad" value="1" {{ $persona[0]->Pregunta_75 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si26">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no26" class="form-check-input" type="radio" name="Practica_alguna_actividad" value="0" {{ $persona[0]->Pregunta_75 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no26">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--fila 6-->
                <!--agregado-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[75]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si27" class="form-check-input" type="radio" name="realiza_actividad" value="1" {{ $persona[0]->Pregunta_76 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si27">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no27" class="form-check-input" type="radio" name="realiza_actividad" value="0" {{ $persona[0]->Pregunta_76 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no27">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-sm-12 col-md-12">
                                <label for="actividades_practican">{{ $preguntas[76]['Descripcion'] }}</label>
                                <input type="text" class="form-control" name="actividades_practican" id="actividades_practican" value="{{ $persona[0]->Pregunta_77 != null?$persona[0]->Pregunta_77:''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <!--fin de agedo-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-md-12">
                                <label for="horas_dia">{{ $preguntas[77]['Descripcion'] }}</label>
                                <input type="number" class="form-control" id="horas_dia" name="horas_dia" value="{{ $persona[0]->Pregunta_78 != null?$persona[0]->Pregunta_78:''}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[78]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si28" class="form-check-input" type="radio" name="puede_practicarlo" value="1" {{ $persona[0]->Pregunta_79 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si28">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no28" class="form-check-input" type="radio" name="puede_practicarlo" value="0" {{ $persona[0]->Pregunta_79 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no28">No</label>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <!--fila 7-->

            </div>
            <!--fin de body card-->
        </div>
        <!--fin de infromacion de salu-->
        <!--INFROMACION DE ACCESO A LA ALIMENTACION-->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" align="center">ACCESO A LA ALIMENTACIÓN</h5>
                <div class="form-group row">
                    <div class="col-sm-10">{{ $preguntas[79]['Descripcion'] }}</div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si29" class="form-check-input" type="radio" name="perdio_empleo" value="1" {{ $persona[0]->Pregunta_80 == 1?'checked':'' }}>
                            <label class="form-check-label" for="si29">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no29" class="form-check-input" type="radio" name="perdio_empleo" value="0" {{ $persona[0]->Pregunta_80 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no29">No</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[80]['Descripcion'] }}</label>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si30" class="form-check-input" type="radio" name="reducio_ingresos" value="1" {{ $persona[0]->Pregunta_81 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si30">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no30" class="form-check-input" type="radio" name="reducio_ingresos" value="0" {{ $persona[0]->Pregunta_81 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no30">No</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[81]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si31" class="form-check-input" type="radio" name="tres_meses_comida_acabara" value="1" {{ $persona[0]->Pregunta_82 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si31">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no31" class="form-check-input" type="radio" name="tres_meses_comida_acabara" value="0" {{ $persona[0]->Pregunta_82 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no31">No</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[82]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si32" class="form-check-input" type="radio" name="tres_meses_quedaron_comida" value="1" {{ $persona[0]->Pregunta_83 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si32">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no32" class="form-check-input" type="radio" name="tres_meses_quedaron_comida" value="0" {{ $persona[0]->Pregunta_83 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no32">No</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[83]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si33" class="form-check-input" type="radio" name="tres_meses_sin_dinero_alimentacion_sana_variada" value="1" {{ $persona[0]->Pregunta_84 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si33">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no33" class="form-check-input" type="radio" name="tres_meses_sin_dinero_alimentacion_sana_variada" value="0" {{ $persona[0]->Pregunta_84 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no33">No</label>
                        </div>
                    </div>
                </div>
                <!--fin de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[84]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si34" class="form-check-input" type="radio" name="quedo_desayunar_comer_cenar" value="1" {{ $persona[0]->Pregunta_85 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si34">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no34" class="form-check-input" type="radio" name="quedo_desayunar_comer_cenar" value="0" {{ $persona[0]->Pregunta_85 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no34">No</label>
                        </div>
                    </div>
                </div>
                <!--inicio de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[85]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si35" class="form-check-input" type="radio" name="disminuyo_cantidad_dcc" value="1" {{ $persona[0]->Pregunta_86 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si35">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no35" class="form-check-input" type="radio" name="disminuyo_cantidad_dcc" value="0" {{ $persona[0]->Pregunta_86 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no35">No</label>
                        </div>
                    </div>
                </div>
                <!--inicio de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[86]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si36" class="form-check-input" type="radio" id="" name="acosto_hambre" value="1" {{ $persona[0]->Pregunta_87 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si36">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no36" class="form-check-input" type="radio" id="" name="acosto_hambre" value="0" {{ $persona[0]->Pregunta_87 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no36">No</label>
                        </div>
                    </div>
                </div>
                <!--fin de fila-->
                <!--fin de fila-->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[87]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion1" value="{{ $alimentos[0]['id'] }}" {{ in_array($alimentos[0]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[0]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion2"  value="{{ $alimentos[1]['id'] }}" {{ in_array($alimentos[1]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[1]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion3"  value="{{ $alimentos[2]['id'] }}" {{ in_array($alimentos[2]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[2]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion4"  value="{{ $alimentos[3]['id'] }}" {{ in_array($alimentos[3]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[3]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion5"  value="{{ $alimentos[4]['id'] }}" {{ in_array($alimentos[4]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[4]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion6"  value="{{ $alimentos[5]['id'] }}" {{ in_array($alimentos[5]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[5]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion7"  value="{{ $alimentos[6]['id'] }}" {{ in_array($alimentos[6]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[6]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion8"  value="{{ $alimentos[7]['id'] }}" {{ in_array($alimentos[7]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[7]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion9"  value="{{ $alimentos[8]['id'] }}" {{ in_array($alimentos[8]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[8]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion10"  value="{{ $alimentos[9]['id'] }}" {{ in_array($alimentos[9]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[9]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion11"  value="{{ $alimentos[10]['id'] }}" {{ in_array($alimentos[10]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[10]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion12"  value="{{ $alimentos[11]['id'] }}" {{ in_array($alimentos[11]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}>
                                    <label class="form-check-label" for="">{{ $alimentos[11]['Descripcion'] }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--fin fila-->
            </div>
            <!--fin de cardbody-->
        </div>
        <!-- FIN DE ACCESO A LA ALIMENTACION-->
        <!--INICIO-->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" align="center">INFORMACIÓN DE DESARROLLO HUMANO</h5>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[88]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si37" class="form-check-input" type="radio" name="interesa_curso_capacitacion" value="1" {{ $persona[0]->Pregunta_89 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si37">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no37" class="form-check-input" type="radio" name="interesa_curso_capacitacion" value="0" {{ $persona[0]->Pregunta_89 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no37">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="que_tipo">{{ $preguntas[89]['Descripcion'] }}</label>
                        <input type="text" class="form-control" name="que_tipo" id="que_tipo" value="{{ $persona[0]->Pregunta_90 != null?$persona[0]->Pregunta_90:''}}">
                    </div>
                </div>
                <!--fin fila-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[90]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si38" class="form-check-input" type="radio" name="aprender_nuevas_tecnologias" value="1" value="1" {{ $persona[0]->Pregunta_91 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si38">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no38" class="form-check-input" type="radio" name="aprender_nuevas_tecnologias" value="0" value="1" {{ $persona[0]->Pregunta_91 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no38">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[91]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si39" class="form-check-input" type="radio" name="alguna_aprender_nuevas_tecnologias"  value="1" value="1" {{ $persona[0]->Pregunta_92 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si39">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no39" class="form-check-input" type="radio" name="alguna_aprender_nuevas_tecnologias"  value="0" value="1" {{ $persona[0]->Pregunta_92 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no39">No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--fin fila-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[92]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si40" class="form-check-input" type="radio" name="cuenta_espacio_huerto"  value="1" value="1" {{ $persona[0]->Pregunta_93 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si40">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no40" class="form-check-input" type="radio" name="cuenta_espacio_huerto" value="0" value="1" {{ $persona[0]->Pregunta_93 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no40">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">

                        <label for="metros_cuadrados">{{ $preguntas[93]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="metros_cuadrados" name="metros_cuadrados" value="{{ $persona[0]->Pregunta_94 != null?$persona[0]->Pregunta_94:''}}">

                    </div>
                </div>
                <!--fin fila-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[94]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="si41" class="form-check-input" type="radio" name="pondria_huerto_hogar" value="1" {{ $persona[0]->Pregunta_95 == 1?'checked':'' }}> {{-- required=""> --}}
                                    <label class="form-check-label" for="si41">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="no41" class="form-check-input" type="radio" name="pondria_huerto_hogar" value="0" {{ $persona[0]->Pregunta_95 === 0?'checked':'' }}>
                                    <label class="form-check-label" for="no41">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--fin fila-->
                <!--fin fila-->
            </div><!-- fin de card body-->
        </div>
        <!--FIN-->
        <!--INICIO INSTRUMENTOS FACTORES DE RIESGO-->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" align="center">INSTRUMENTO DE IDENTIFICACIÓN DE FACTORES DE RIESGO</h5>
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[95]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si42" class="form-check-input" name="sabe_tipos_violencia" type="radio" value="1" {{ $persona[0]->Pregunta_96 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si42">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no42" class="form-check-input" name="sabe_tipos_violencia" type="radio" value="0" {{ $persona[0]->Pregunta_96 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no42">No</label>
                        </div>
                    </div>
                </div>
                <!-- fin de fila-->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>{{ $preguntas[96]['Descripcion'] }}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="violencia_tipoA" value="{{ $violencias[0]['id'] }}" {{ in_array($violencias[0]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}>
                            <label class="form-check-label" for=""> {{ $violencias[0]['Descripcion'] }}</label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" name="violencia_tipoB" value="{{ $violencias[1]['id'] }}" {{ in_array($violencias[1]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}>
                            <label class="form-check-label" for="">{{ $violencias[1]['Descripcion'] }}</label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" name="violencia_tipoC" value="{{ $violencias[2]['id'] }}" {{ in_array($violencias[2]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}>
                            <label class="form-check-label" for="">{{ $violencias[2]['Descripcion'] }}</label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" name="violencia_tipoD" value="{{ $violencias[3]['id'] }}" {{ in_array($violencias[3]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}>
                            <label class="form-check-label" for="">{{ $violencias[3]['Descripcion'] }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="violencia_tipoE" value="{{ $violencias[4]['id'] }}" {{ in_array($violencias[4]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}>
                            <label class="form-check-label" for="">{{ $violencias[4]['Descripcion'] }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="violencia_tipoF" value="{{ $violencias[5]['id'] }}" {{ in_array($violencias[5]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}>
                            <label class="form-check-label" for="">{{ $violencias[5]['Descripcion'] }}</label>
                        </div>
                    </div>
                </div>
                <!--fin de fila-->
                <div class="form-group row">
                    <div class="col-sm-10">
                        <label>{{ $preguntas[97]['Descripcion'] }}</label>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si43" class="form-check-input" type="radio" name="saber_tema" value="1" {{ $persona[0]->Pregunta_98 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si43">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no43" class="form-check-input" type="radio" name="saber_tema" value="0" {{ $persona[0]->Pregunta_98 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no43">No</label>
                        </div>
                    </div>
                </div>
                <!--fin de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[98]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si44" class="form-check-input" type="radio" name="escuchado_adicciones_prevencion" value="1" {{ $persona[0]->Pregunta_99 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si44">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no44" class="form-check-input" type="radio" name="escuchado_adicciones_prevencion" value="0" {{ $persona[0]->Pregunta_99 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no44">No</label>
                        </div>
                    </div>
                </div>
                <!--fin de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[99]['Descripcion'] }}</label>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <input id="si45" class="form-check-input" type="radio" name="denunciar_tipo_violencia" value="1" {{ $persona[0]->Pregunta_100 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si45">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no45" class="form-check-input" type="radio" name="denunciar_tipo_violencia" value="0" {{ $persona[0]->Pregunta_100 === 0?'checked':'' }}>
                            <label class="form-check-label" for="no45">No</label>
                        </div>
                    </div>
                </div>
                <!--fin de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[100]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">

                            <input id="si46" class="form-check-input" type="radio" name="siente_seguro_vivienda" value="1" {{ $persona[0]->Pregunta_101 == 1?'checked':'' }}> {{-- required=""> --}}
                            <label class="form-check-label" for="si46">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="no46" class="form-check-input" type="radio" name="siente_seguro_vivienda" value="0" {{ $persona[0]->Pregunta_101 === 0?'checked':'' }}> 
                            <label class="form-check-label" for="no46">No</label>
                        </div>
                    </div>
                </div>
                <!--fin de fila-->

            </div>
        </div>
        <!--fin de card body-->
        <!--fin de instrumentos de factores de riesgo-->
        <br><br>
            <div class="container">
                
                <button type="submit" name="send" class="btn btn-success"><strong>Guardar</strong></button>
                <div class="row justify-content-around">
                    <a style="display: none;" href="/imprimir/{{$persona[0]->PersonaId}}" name="accion" class="btn btn-primary col-2" id="action" role="button" aria-pressed="true" target="_blank">Descargar Formato</a>
                    <a style="display: none;" href="/" name="rel" class="btn btn-secondary col-2" role="button" aria-pressed="true">Regresar</a>
                    {{-- <a style="display: none;" href="https://qroo.gob.mx/sedeso/hambreceroquintanaroo" name="rel" class="btn btn-secondary col-2" role="button" aria-pressed="true">Salir</a> --}}
                </div>
            </div>
        </div>
        <input type="hidden" value="{{ $persona[0]->Intentos }}" data-persona="{{ $persona[0]->PersonaId }}" id="ntn">
    </form>
    <br>
    <!--FIN  FACTORES DE RIESGO-->

@endsection
