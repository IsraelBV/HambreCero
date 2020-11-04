@extends('layouts.base')

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
    <form id="cuestionario" action="" method="">
        @csrf
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" align="center">DATOS PERSONALES</h5>
                <!--Fila 1-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[0]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" onkeyup="mayusculas(this);"
                            required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[1]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="" name="apellido_p" onkeyup="mayusculas(this);"
                            required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[2]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="" name="apellido_m" onkeyup="mayusculas(this);">
                    </div>
                </div>
                <!--Fin de Fila 1-->
                <!--fila 2-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[3]['Descripcion'] }}</label>
                        <input type="tex" class="form-control" id="curp" name="curp" onkeyup="mayusculas(this);"
                            required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[4]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="rfc" name="rfc" onkeyup="mayusculas(this);">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">{{ $preguntas[5]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="clave_e" name="clave_elector"
                            onkeyup="mayusculas(this);">
                    </div>
                </div>
                <!--fin de fila 2-->
                <div class="form-row">
                    <div class="form-group col-md-7">
                        <label>{{ $preguntas[6]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="extranjero" name="extranjero" onkeyup="mayusculas(this);">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Grupo Social</label>
                        <select id="sexo" class="form-control" name="gruposocial">
                            <option selected>Seleccione</option>
                            @foreach ($gruposociales as $gruposocial)
                                <option value="{{$gruposocial->id}}">{{$gruposocial->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Fila 3-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[7]['Descripcion'] }}</label>
                        <select id="sexo" class="form-control" name="sexo">
                            <option selected>Seleccione</option>
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMENINO</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[8]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="ciudad_nac" name="ciudad_nac"
                            onkeyup="mayusculas(this);">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[9]['Descripcion'] }}</label>
                        <select id="estado_nac" class="form-control" name="estado_nac">
                            <option selected>Seleccione una opcion</option>
                            @foreach ($estados as $estado)
                                <option value="{{$estado->id}}">{{$estado->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Fin de Fila 3-->
                <!--fila4-->
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[10]['Descripcion'] }}</label><br>
                        <input type="date" class="form-control" name="fecha_na"><br>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">{{ $preguntas[11]['Descripcion'] }}</label>
                        <select id="grado_estudios" class="form-control" name="grado_estudios">
                            <option selected>Seleccione una opcion</option>
                            @foreach ($estudios as $estudio)
                                <option value="{{$estudio->id}}">{{$estudio->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[12]['Descripcion'] }}</label><br>
                        <select for id="colonia" class="form-control" name="colonia">
                            <option selected>Seleccione una opcion</option>
                            @foreach ($colonias as $colonia)
                                <option value="{{$colonia->id}}">{{$colonia->Descripcion}}</option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                </div>
                <!--fin fila 4-->
                <!--fila5-->
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[13]['Descripcion'] }}</label><br>
                        <input type="text" name="calle" class="form-control" onkeyup="mayusculas(this);" /><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{ $preguntas[14]['Descripcion'] }}</label><br>
                        <input type="text" name="manzana" class="form-control" onkeyup="mayusculas(this);" /><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{ $preguntas[15]['Descripcion'] }}</label><br>
                        <input type="tex" name="lote" class="form-control" /><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{ $preguntas[16]['Descripcion'] }}</label><br>
                        <input type="text" name="num_exterior" class="form-control" /><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{ $preguntas[17]['Descripcion'] }}</label><br>
                        <input type="tex" name="num_interior" class="form-control" /><br>
                    </div>
                </div>
                <!--fin fila 5-->
                <!--Fila 6-->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="nombre">{{ $preguntas[18]['Descripcion'] }}</label>
                        <input readonly type="text" class="form-control" aria-disabled="true" value="{{ $estados[22]['Descripcion'] }}">
                        <input hidden type="text" class="form-control" aria-disabled="true" name="estado" value="22">
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[19]['Descripcion'] }}</label>
                        {{-- <input type="text" class="form-control" name="municipio"> --}}
                        <select for id="municipio" class="form-control" name="municipio">
                            <option selected>Seleccione una opcion</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{$municipio->id}}">{{$municipio->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[20]['Descripcion'] }}</label>
                        {{-- <input type="text" class="form-control" name="localidad"> --}}
                        <select for id="localidad" class="form-control" name="localidad">
                            <option selected>Seleccione una opcion</option>
                            @foreach ($localidades as $localidad)
                                <option value="{{$localidad->id}}">{{$localidad->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[21]['Descripcion'] }}</label>
                        <input type="number" class="form-control" name="cod_postal">
                    </div>
                </div>
                <!-- fin fila 6-->
                <!--FILA 7-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[22]['Descripcion'] }}</label>
                        <input type="number" class="form-control" name="tel_cel">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[23]['Descripcion'] }}</label>
                        <input type="number" class="form-control" name="tel_casa">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[24]['Descripcion'] }}</label>
                        <input type="email" class="form-control" name="correo_ele">
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
                                <input class="form-check-input" type="radio" name="cuenta_apoyo_dependencia" id="" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cuenta_apoyo_dependencia" id="" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- fin fila 8-->
                    <!--fila9-->
                    <div class="form-group col-md-7">
                        <label class="col-sm-12 col-form-label">{{ $preguntas[26]['Descripcion'] }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="nombre_dependencia">
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
                                <input class="form-check-input" type="radio" name="casa_propia" id="" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="casa_propia" id="" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="col-md-12">
                            <label>{{ $preguntas[28]['Descripcion'] }}</label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paga_renta" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paga_renta" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin de fila 1-->
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="nombre">{{ $preguntas[29]['Descripcion'] }}</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="" name="renta_mensual">
                        </div>
                    </div>
                    <div class="form-group col-md-7">
                        <div class="col-sm-12">
                            <label>{{ $preguntas[30]['Descripcion'] }}</label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="casa_credito" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="casa_credito" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin de fila2-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">{{ $preguntas[31]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="" name="cuanto_paga_credito">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputAP">{{ $preguntas[32]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="" name="cuantas_per_viven_casa">
                    </div>
                </div>
                <!--fin de fila 3-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">{{ $preguntas[33]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="" name="dependientes_economicos">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre">{{ $preguntas[34]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="" name="menores_12">
                    </div>
                </div>
                <!--fin de fila 4-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">{{ $preguntas[35]['Descripcion'] }}</label>
                        <input type="number" class="form-control" name="personas_12a18">
                    </div>
                    <div class="form-group col-md-6">
                        <label>{{ $preguntas[36]['Descripcion'] }}</label>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="col-md-12"><input type="number" class="form-control" name="si_cuantos"
                                        placeholder="Si Cuantos"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12"><input type="number" class="form-control" name="no_cuantos"
                                        placeholder="No Cuantos"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--fin de fila 5-->
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>{{ $preguntas[37]['Descripcion'] }}</label>
                        <input type="number" class="form-control" name="adultos_mayores">
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[38]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="trabaja" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="trabaja" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[39]['Descripcion'] }}</label>
                        <input type="text" class="form-control" name="problema_no_trabaja">
                    </div>
                </div>
                <!--fila 6-->
                <div class="form-row">
                    <div class="form-group col-md-8"><label>{{ $preguntas[40]['Descripcion'] }}</label>
                        <input type="number" class="form-control" name="cuantos_aportan_recursos">
                    </div>


                    <div class="form-group col-md-4">
                        <label>{{ $preguntas[41]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="otros_ingresos" value="1"
                                    required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="otros_ingresos" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <!--fila 7-->
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">{{ $preguntas[42]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="" name="cuales">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nombre">{{ $preguntas[43]['Descripcion'] }} </label>
                        <input type="number" class="form-control" id="" name="cto_asc_ing_extra">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre">{{ $preguntas[44]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="" name="cto_asc_ing_men_fam_total">
                    </div>
                </div>
                <!--Fila 8-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">{{ $preguntas[45]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="" name="cto_asc_gast_men_fam_total">
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[46]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" value="1" name="luz" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" value="0" name="luz">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[47]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="agua" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="agua" value="0">
                                <label class="form-check-label" for="">No</label>
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
                                <input class="form-check-input" type="radio" name="drenaje" id="" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="drenaje" id="" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[49]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="piso_firme" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="piso_firme" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[50]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="tv" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="tv" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[51]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="internet" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="internet" value="0">
                                <label class="form-check-label" for="">No</label>
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
                                <input class="form-check-input" type="radio" id="" name="tv_paga" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="tv_paga" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[53]['Descripcion'] }} </label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="refrigerador" id="" value="1">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="refrigerador" id="" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[54]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="microondas" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="microondas" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[55]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="computadora" name="computadora" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="computadora" name="computadora" value="0">
                                <label class="form-check-label" for="">No</label>
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
                                <input class="form-check-input" type="radio" id="" name="celular" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="celular" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ $preguntas[57]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="automovil" value="1" required="">
                                <label class="form-check-label" for="">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="" name="automovil" value="0">
                                <label class="form-check-label" for="">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-7">
                        <label>{{ $preguntas[58]['Descripcion'] }}</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="" name="Tipo_material_A" value="{{ $materiales[0]['id'] }}">
                                <label class="form-check-label" for="">{{ $materiales[0]['Descripcion'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="" name="Tipo_material_C" value="{{ $materiales[2]['id'] }}">
                                <label class="form-check-label" for="">{{ $materiales[2]['Descripcion'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="" name="Tipo_material_B" value="{{ $materiales[1]['id'] }}">
                                <label class="form-check-label" for="">{{ $materiales[1]['Descripcion'] }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="" name="Tipo_material_D" value="{{ $materiales[3]['id'] }}">
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
                                    <input class="form-check-input" type="radio" id="" name="servicios_salud" value="1"
                                        required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="" name="servicios_salud" value="0">
                                    <label class="form-check-label" for="">No</label>
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
                                    <input class="form-check-input" type="radio" name="seguro_social" id="" value="1"
                                        required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="seguro_social" id="" value="0">
                                    <label class="form-check-label" for="">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">

                        <label for="">{{ $preguntas[61]['Descripcion'] }}</label>
                        {{-- <input type="text" class="form-control" id="" name="institucion"> --}}
                        <select for id="institucion" class="form-control" name="institucion">
                            <option selected>Seleccione una opcion</option>
                            @foreach ($ss as $s)
                                <option value="{{$s->id}}">{{$s->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--fin Fila 1-->
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="">{{ $preguntas[62]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="" name="num_discapacidad">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nombre">{{ $preguntas[63]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="nombre" name="tipo_discapacidad">
                    </div>
                    <div class="form-group col-md-3">
                        <div form-group row>
                            <div class="col-md-12">{{ $preguntas[64]['Descripcion'] }}</div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="" name="permanente" value="1"
                                        required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="" name="permanente" value="0">
                                    <label class="form-check-label" for="">No</label>
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
                                    <input class="form-check-input" type="radio" id="" name="hipertenso" value="1"
                                        required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="" name="hipertenso" value="0">
                                    <label class="form-check-label" for="">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="nombre">{{ $preguntas[66]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="" name="cuantos_h">
                    </div>
                    <div class="form-group col-md-5">
                        <div form-group row>
                            <div class="col-md-12">{{ $preguntas[67]['Descripcion'] }}</div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="" name="diabetico" value="1"
                                        required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="" name="diabetico" value="0">
                                    <label class="form-check-label" for="">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="nombre">{{ $preguntas[68]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="" name="cuantos_d">
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
                                    <input class="form-check-input" type="radio" id="" name="obesidad" value="1"
                                        required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="" name="obesidad" value="0">
                                    <label class="form-check-label" for="">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="nombre">{{ $preguntas[70]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="" name="cuantos_ob">
                    </div>
                    <div class="form-group col-md-5">
                        <div form-group row>
                            <div class="col-md-12">
                                {{ $preguntas[71]['Descripcion'] }}
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="" name="otra_enfermedad" value="1">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="" name="otra_enfermedad" value="0">
                                    <label class="form-check-label" for="">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="nombre">{{ $preguntas[72]['Descripcion'] }}</label>
                        <input type="text" class="form-control" name="cual_tiene">
                    </div>
                </div>

                <!--fin de fila 4-->
                <!--fila 5-->
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[73]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="temas_salud" id="" value="2"
                                        required="">
                                    <label class="form-check-label" for="">Mucho</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="temas_salud" id="" value="1">
                                    <label class="form-check-label" for="">Poco</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="temas_salud" id="" value="0">
                                    <label class="form-check-label" for="">Nada</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[74]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Practica_alguna_actividad" id="" value="1" required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Practica_alguna_actividad" id="" value="0">
                                    <label class="form-check-label" for="">No</label>
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
                                    <input class="form-check-input" type="radio" name="realiza_actividad" id="" value="1"
                                        required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="realiza_actividad" id="" value="0">
                                    <label class="form-check-label" for="">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div form-group row>
                            <div class="col-sm-12 col-md-12">
                                <label>{{ $preguntas[76]['Descripcion'] }}</label>
                                <input type="text" class="form-control" name="actividades_practican" id="">
                            </div>
                        </div>
                    </div>
                </div>
                <!--fin de agedo-->
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <div form-group row>
                            <div class="col-md-12">
                                <label for="nombre">{{ $preguntas[77]['Descripcion'] }}</label>
                                <input type="number" class="form-control" name="horas_dia">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-7">
                        <div form-group row>
                            <div class="col-md-12">
                                <label>{{ $preguntas[78]['Descripcion'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="puede_practicarlo" value="1"
                                        required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="puede_practicarlo" value="0">
                                    <label class="form-check-label" for="">No</label>
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
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" id="" name="perdio_empleo" value="1">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" id="" name="perdio_empleo" value="0">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[80]['Descripcion'] }}</label>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" id="" name="reducio_ingresos" value="1"
                                required="">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" id="" name="reducio_ingresos" value="0">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[81]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" id="" name="tres_meses_comida_acabara" value="1"
                                required="">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" id="" name="tres_meses_comida_acabara" value="0">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[82]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" id="" name="tres_meses_quedaron_comida" value="1"
                                required="">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" id="" name="tres_meses_quedaron_comida" value="0">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[83]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" id=""
                                name="tres_meses_sin_dinero_alimentacion_sana_variada" value="1" required="">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" id=""
                                name="tres_meses_sin_dinero_alimentacion_sana_variada" value="0">
                        </div>
                    </div>
                </div>
                <!--fin de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[84]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" id="" name="quedo_desayunar_comer_cenar" value="1"
                                required="">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" id="" name="quedo_desayunar_comer_cenar" value="0">
                        </div>
                    </div>
                </div>
                <!--inicio de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[85]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" name="disminuyo_cantidad_dcc" id="" value="1"
                                required="">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" name="disminuyo_cantidad_dcc" id="" value="0">
                        </div>
                    </div>
                </div>
                <!--inicio de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[86]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" id="" name="acosto_hambre" value="1" required="">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" id="" name="acosto_hambre" value="0">
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
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion1" value="{{ $alimentos[0]['id'] }}">
                                    <label class="form-check-label" for="">{{ $alimentos[0]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion2"  value="{{ $alimentos[1]['id'] }}">
                                    <label class="form-check-label" for="">{{ $alimentos[1]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion3"  value="{{ $alimentos[2]['id'] }}">
                                    <label class="form-check-label" for="">{{ $alimentos[2]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion4"  value="{{ $alimentos[3]['id'] }}">
                                    <label class="form-check-label" for="">>{{ $alimentos[3]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion5"  value="{{ $alimentos[4]['id'] }}">
                                    <label class="form-check-label" for="">{{ $alimentos[4]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion6"  value="{{ $alimentos[5]['id'] }}">
                                    <label class="form-check-label" for="">{{ $alimentos[5]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion7"  value="{{ $alimentos[6]['id'] }}">
                                    <label class="form-check-label" for="">{{ $alimentos[6]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion8"  value="{{ $alimentos[7]['id'] }}">
                                    <label class="form-check-label" for="">{{ $alimentos[7]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion9"  value="{{ $alimentos[8]['id'] }}">
                                    <label class="form-check-label" for="">{{ $alimentos[8]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion10"  value="{{ $alimentos[9]['id'] }}">
                                    <label class="form-check-label" for="">{{ $alimentos[9]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion11"  value="{{ $alimentos[10]['id'] }}">
                                    <label class="form-check-label" for="">{{ $alimentos[10]['Descripcion'] }}</label>
                                </div>
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="" name="alimentos_opcion12"  value="{{ $alimentos[11]['id'] }}">
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
                                    <input class="form-check-input" type="radio" name="interesa_curso_capacitacion" id="" value="1" required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="interesa_curso_capacitacion" id="" value="0">
                                    <label class="form-check-label" for="">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">{{ $preguntas[89]['Descripcion'] }}</label>
                        <input type="text" class="form-control" name="que_tipo" id="">
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
                                    <input class="form-check-input" type="radio" name="aprender_nuevas_tecnologias" id="" value="1" required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="aprender_nuevas_tecnologias" id="" value="0">
                                    <label class="form-check-label" for="">No</label>
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
                                    <input class="form-check-input" type="radio" name="alguna_aprender_nuevas_tecnologias" id="" value="1" required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="alguna_aprender_nuevas_tecnologias" id="" value="0">
                                    <label class="form-check-label" for="">No</label>
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
                                    <input class="form-check-input" type="radio" name="cuenta_espacio_huerto" id="" value="1" required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cuenta_espacio_huerto" id="" value="0">
                                    <label class="form-check-label" for="">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">

                        <label for="inputPassword4">{{ $preguntas[93]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="" name="metros_cuadrados">

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
                                    <input class="form-check-input" type="radio" name="pondria_huerto_hogar" id="" value="1" required="">
                                    <label class="form-check-label" for="">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pondria_huerto_hogar" id="" value="0">
                                    <label class="form-check-label" for="">No</label>
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
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" name="sabe_tipos_violencia" type="radio" id="" value="1"
                                required="">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" name="sabe_tipos_violencia" type="radio" id="" value="0">
                        </div>
                    </div>
                </div>
                <!-- fin de fila-->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>{{ $preguntas[96]['Descripcion'] }}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="" name="violencia_tipoA" value="{{ $violencias[0]['id'] }}">
                            <label class="form-check-label" for=""> {{ $violencias[0]['Descripcion'] }}</label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" id="" name="violencia_tipoB" value="{{ $violencias[1]['id'] }}">
                            <label class="form-check-label" for="">{{ $violencias[1]['Descripcion'] }}</label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" id="" name="violencia_tipoC" value="{{ $violencias[2]['id'] }}">
                            <label class="form-check-label" for="">{{ $violencias[2]['Descripcion'] }}</label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" id="" name="violencia_tipoD" value="{{ $violencias[3]['id'] }}">
                            <label class="form-check-label" for="">{{ $violencias[3]['Descripcion'] }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="" name="violencia_tipoE" value="{{ $violencias[4]['id'] }}">
                            <label class="form-check-label" for="">{{ $violencias[4]['Descripcion'] }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="" name="violencia_tipoF" value="{{ $violencias[5]['id'] }}">
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
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" id="" name="saber_tema" value="1">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" id="" name="saber_tema" value="0">
                        </div>
                    </div>
                </div>
                <!--fin de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[98]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" id="" name="escuchado_adicciones_prevencion" value="1" required="">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" id="" name="escuchado_adicciones_prevencion" value="0">
                        </div>
                    </div>
                </div>
                <!--fin de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[99]['Descripcion'] }}</label>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" name="denunciar_tipo_violencia" id="" value="1"
                                required="">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" name="denunciar_tipo_violencia" id="" value="0">
                        </div>
                    </div>
                </div>
                <!--fin de fila-->
                <div class="form-group row">
                    <div class="col-sm-10"><label>{{ $preguntas[100]['Descripcion'] }}</label></div>
                    <div class="col-sm-2">
                        <div class="form-check form-check-inline">

                            <label class="form-check-label" for="">Si</label>
                            <input class="form-check-input" type="radio" name="siente_seguro_vivienda" id="" value="1"
                                required="">
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="">No</label>
                            <input class="form-check-input" type="radio" name="siente_seguro_vivienda" id="" value="0">
                        </div>
                    </div>
                </div>
                <!--fin de fila-->

            </div>
        </div>
        <!--fin de card body-->
        <!--fin de instrumentos de factores de riesgo-->
        <br><br>

            <button type="submit" name="send" class="btn btn-success"><strong>Enviar</strong></button>
            <button style="display: none;" type="button" name="accion" class="btn btn-primary" id="action" onclick="printHTML()">Imprimir</button>
            <a style="display: none;" href="/" name="rel" class="btn btn-info" role="button" aria-pressed="true">Recargar Formulario</a>
        </div>
    </form>
    <!--FIN  FACTORES DE RIESGO-->

@endsection
