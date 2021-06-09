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
    <form id="encuesta" action="" method="">
        @csrf
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" align="center">DATOS PERSONALES</h5>
                <!--Fila 1-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nombre">{{ $preguntas[0]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" onkeyup="mayusculas(this);"required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="apellido_p">{{ $preguntas[1]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="apellido_p" name="apellido_p" onkeyup="mayusculas(this);" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="apellido_m">{{ $preguntas[2]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="apellido_m" name="apellido_m" onkeyup="mayusculas(this);" required="">
                    </div>
                </div>
                <!--Fin de Fila 1-->
                <!--fila 2-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="curp">{{ $preguntas[3]['Descripcion'] }}</label>
                        <input type="tex" class="form-control" id="curp" name="curp" onkeyup="mayusculas(this);" required="" @if($curp) value="{{$curp}}"  readonly @endif>
                        
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estadocivil">Estado Civil</label>
                        <br>
                        <select id="estadocivil" class="form-control" name="estadocivil" required="">
                            <option value="" selected>Seleccione una opcion</option>
                            @foreach ($estadosCiviles as $estadocivil)
                                <option value="{{$estadocivil->id}}">{{$estadocivil->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sexo">{{ $preguntas[7]['Descripcion'] }}</label>
                        <select id="sexo" class="form-control" name="sexo">
                            <option value="" selected>Seleccione una opcion</option>
                            <option value="M">HOMBRE</option>
                            <option value="F">MUJER</option>
                        </select>
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="rfc">{{ $preguntas[4]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="rfc" name="rfc" onkeyup="mayusculas(this);">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="clave_elector" for="clave_e">{{ $preguntas[5]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="clave_elector" name="clave_elector" onkeyup="mayusculas(this);" >
                    </div> --}}
                </div>
                <!--fin de fila 2-->
                    <!-- aqui estaba lo de ser extranjero -->
                <!-- Fila 3-->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="estado_nac">{{ $preguntas[9]['Descripcion'] }}</label>
                        <select id="estado_nac" class="form-control" name="estado_nac" required="">
                            <option value="" selected>Seleccione una opcion</option>
                            @foreach ($estados as $estado)
                                <option value="{{$estado->id}}">{{$estado->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ciudad_nac">{{ $preguntas[8]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="ciudad_nac" name="ciudad_nac" onkeyup="mayusculas(this);" required="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fecha_na">{{ $preguntas[10]['Descripcion'] }}</label><br>
                        <input type="date" class="form-control" id="fecha_na" name="fecha_na" required=""><br>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cod_postal">{{ $preguntas[21]['Descripcion'] }}</label>
                        <input id="cod_postal" type="number" class="form-control" name="cod_postal">
                    </div>
                </div>
                        <!-- Fin de Fila 3-->
                        <!--fila4-->
                        {{-- <div class="form-row"> --}}

                            
                            {{-- <div class="form-group col-md-4">
                                <label for="grado_estudios">{{ $preguntas[11]['Descripcion'] }}</label>
                                <select value="" id="grado_estudios" class="form-control" name="grado_estudios">
                                    <option value="" selected>Seleccione una opcion</option>
                                    @foreach ($estudios as $estudio)
                                        <option value="{{$estudio->id}}">{{$estudio->Descripcion}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            
                        {{-- </div> --}}
                        <!--fin fila 4-->
                        <!--fila5-->
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="calle">{{ $preguntas[13]['Descripcion'] }}</label><br>
                        <input id="calle" type="text" name="calle" class="form-control" onkeyup="mayusculas(this);" required="" /><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="manzana">{{ $preguntas[14]['Descripcion'] }}</label><br>
                        <input id="manzana" type="number" name="manzana" class="form-control" onkeyup="mayusculas(this);" required="" /><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="lote">{{ $preguntas[15]['Descripcion'] }}</label><br>
                        <input id="lote" type="tex" name="lote" class="form-control" onkeyup="mayusculas(this);" required=""/><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="num_exterior">{{ $preguntas[16]['Descripcion'] }}</label><br>
                        <input id="num_exterior" type="text" name="num_exterior" class="form-control" onkeyup="mayusculas(this);" required=""/><br>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="num_interior">{{ $preguntas[17]['Descripcion'] }}</label><br>
                        <input id="num_interior" type="tex" name="num_interior" class="form-control" onkeyup="mayusculas(this);" /><br>
                    </div>
                </div>
                <!--fin fila 5-->
                <!--Fila 6-->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="">{{ $preguntas[18]['Descripcion'] }}</label>
                        <input readonly type="text" class="form-control" aria-disabled="true" value="{{ $estados[22]['Descripcion'] }}">
                        <input hidden type="text" class="form-control" aria-disabled="true" name="estado" value="23">  <!--23 es el indice de quintana Roo-->
                    </div>
                    <div class="form-group col-md-3">
                        <label for="municipio">{{ $preguntas[19]['Descripcion'] }}</label>
                        {{-- <input type="text" class="form-control" name="municipio"> --}}
                        <select id="municipio" class="form-control" name="municipio" required="">
                            <option value="" selected>Seleccione una opcion</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{$municipio->id}}">{{$municipio->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="localidad">{{ $preguntas[20]['Descripcion'] }}</label>
                        {{-- <input type="text" class="form-control" name="localidad"> --}}
                        <select id="localidad" class="form-control" name="localidad" required="">
                            <option value="" selected>Seleccione una opcion</option>
                            @foreach ($localidades as $localidad)
                                <option value="{{$localidad->id}}">{{$localidad->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="colonia">{{ $preguntas[12]['Descripcion'] }}</label><br>
                        <select for id="colonia" class="form-control" name="colonia" >
                            <option value="" selected>Seleccione una opcion</option>
                            @foreach ($colonias as $colonia)
                                <option value="{{$colonia->id}}">{{$colonia->Descripcion}}</option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                </div>
                <!-- fin fila 6-->
                <!--FILA 7-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tel_cel">{{ $preguntas[22]['Descripcion'] }}</label>
                        <input id="tel_cel" type="number" class="form-control" name="tel_cel"  required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tel_casa">{{ $preguntas[23]['Descripcion'] }}</label>
                        <input id="tel_casa" type="number" class="form-control" name="tel_casa">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="correo_ele">{{ $preguntas[24]['Descripcion'] }}</label>
                        <input id="correo_ele" type="email" class="form-control" name="correo_ele">
                    </div>
                </div>
                <!-- FIN DE FILA 7-->
                <!--fila 8-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="extranjero">{{ $preguntas[6]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="extranjero" name="extranjero" onkeyup="mayusculas(this);">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cuantas_per_viven_casa">{{ $preguntas[32]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cuantas_per_viven_casa" name="cuantas_per_viven_casa" >
                    </div>
                    <div class="form-group col-md-3">
                        <label for="menores_sin_acta">{{ $preguntas[101]['Descripcion'] }}</label>
                        <select for id="menores_sin_acta" class="form-control" name="menores_sin_acta" >
                            <option value="" selected>Seleccione una opcion</option>
                            <option value="1">si</option>
                            <option value="0">no</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <label for="password">Registre y guarde una contraseña de al menos 8 caracteres (números y/o letras; esta le servirá para actualizaciones de datos o para complementar su documentación)</label>
                    <!-- <label for="password">Ingrese una contraseña por favor.</label> -->

                    <input id="password" type="password" class="form-control " name="contraseña" autocomplete="new-password">
                    
                </div>

                <!-- <div class="form-row">
                    
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div> -->
                <br>
                <div class="form-row">
                    <button type="submit" name="send" class="btn btn-success"><strong>Guardar</strong></button>
                </div>

            </div>
        </div>
        <br><br>
    </form>

        <div class="card">
            <div class="card-body" id="entcont">
                <a class="btn btn-success" id="solicitarD" name="solicitaD" role="button" aria-pressed="true" style="display: none;">Subir Documentos</a>
            </div>
        </div>
        <br><br>

        <div class="container">
            <div class="row justify-content-around">
                <a style="display: none;" href="/" name="rel" class="btn btn-secondary col-2" role="button" aria-pressed="true">Regresar</a>
                {{-- <a style="display: none;" href="https://qroo.gob.mx/sedeso/hambreceroquintanaroo" name="rel" class="btn btn-secondary col-2" role="button" aria-pressed="true">Salir</a> --}}
            </div>
        </div>

    <div class="container">
        <div class="row justify-content-around">
            <a style="position: fixed; top: 10%; left: 10px;"  id="btnreturn" href="/registro" class="btn btn-dark" role="button" aria-pressed="true"><strong><span style="font-size: 1.5rem">&#8592; </span> Salir</strong></a>
        </div>
    </div>

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
