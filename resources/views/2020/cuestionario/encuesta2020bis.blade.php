@extends('2020.layouts.app')

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
                        <input type="tex" class="form-control" id="curp" name="curp" onkeyup="mayusculas(this);" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rfc">{{ $preguntas[4]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="rfc" name="rfc" onkeyup="mayusculas(this);">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="clave_elector" for="clave_e">{{ $preguntas[5]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="clave_elector" name="clave_elector" onkeyup="mayusculas(this);" >
                    </div>
                </div>
                <!--fin de fila 2-->
                    <!-- aqui estaba lo de ser extranjero -->
                <!-- Fila 3-->
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="estadocivil">Estado Civil</label>
                        <br>
                        <select id="estadocivil" class="form-control" name="estadocivil" required="">
                            <option value="" selected>Seleccione una opcion</option>
                            @foreach ($estadosCiviles as $estadocivil)
                                <option value="{{$estadocivil->id}}">{{$estadocivil->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sexo">{{ $preguntas[7]['Descripcion'] }}</label>
                        <select id="sexo" class="form-control" name="sexo">
                            <option value="" selected>Seleccione una opcion</option>
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMENINO</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ciudad_nac">{{ $preguntas[8]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="ciudad_nac" name="ciudad_nac" onkeyup="mayusculas(this);" required="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="estado_nac">{{ $preguntas[9]['Descripcion'] }}</label>
                        <select id="estado_nac" class="form-control" name="estado_nac" required="">
                            <option value="" selected>Seleccione una opcion</option>
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
                        <label for="fecha_na">{{ $preguntas[10]['Descripcion'] }}</label><br>
                        <input type="date" class="form-control" id="fecha_na" name="fecha_na" required=""><br>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="grado_estudios">{{ $preguntas[11]['Descripcion'] }}</label>
                        <select value="" id="grado_estudios" class="form-control" name="grado_estudios">
                            <option value="" selected>Seleccione una opcion</option>
                            @foreach ($estudios as $estudio)
                                <option value="{{$estudio->id}}">{{$estudio->Descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="colonia">{{ $preguntas[12]['Descripcion'] }}</label><br>
                        <select for id="colonia" class="form-control" name="colonia" required="">
                            <option value="" selected>Seleccione una opcion</option>
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
                        <label for="cod_postal">{{ $preguntas[21]['Descripcion'] }}</label>
                        <input id="cod_postal" type="number" class="form-control" name="cod_postal">
                    </div>
                </div>
                <!-- fin fila 6-->
                <!--FILA 7-->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tel_cel">{{ $preguntas[22]['Descripcion'] }}</label>
                        <input id="tel_cel" type="number" class="form-control" name="tel_cel">
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
                    <div class="form-group col-md-8">
                        <label for="extranjero">{{ $preguntas[6]['Descripcion'] }}</label>
                        <input type="text" class="form-control" id="extranjero" name="extranjero" onkeyup="mayusculas(this);">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cuantas_per_viven_casa">{{ $preguntas[32]['Descripcion'] }}</label>
                        <input type="number" class="form-control" id="cuantas_per_viven_casa" name="cuantas_per_viven_casa" >
                    </div>
                </div>
                <!--fin fila 9-->
            </div>
        </div>
        <!--fin de datos personales-->
        <br><br>
        <!--informacion familiar y de vicienda-->
            <div class="container">
                
                <button type="submit" name="send" class="btn btn-success"><strong>Guardar</strong></button>
                <div class="row justify-content-around">
                    <a style="display: none;" href="" name="accion" class="btn btn-primary col-2" id="action" role="button" aria-pressed="true" target="_blank">Descargar Formato</a>
                    <a style="display: none;"  href="/registro2020/create" name="rel" class="btn btn-info col-2" role="button" aria-pressed="true">Recargar Formulario</a>
                    <a style="display: none;" href="/" name="rel" class="btn btn-secondary col-2" role="button" aria-pressed="true">Regresar</a>
                    {{-- <a style="display: none;" href="https://qroo.gob.mx/sedeso/hambreceroquintanaroo" name="rel" class="btn btn-secondary col-2" role="button" aria-pressed="true">Salir</a> --}}
                </div>
            </div>
        </div>
    </form>
    <br>
    <!--FIN  FACTORES DE RIESGO-->
    <a style="position: fixed; top: 10%; left: 10px;"  id="btnreturn" href="/registro2020" class="btn btn-dark" role="button" aria-pressed="true"><strong><span style="font-size: 1.5rem">&#8592; </span> Regresar</strong></a>

    {{-- <div id="modal_alerta" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{asset('img/ventana emergente.png')}}" class="img-fluid img-thumbnail">
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
            </div>
        </div>
    </div> --}}

@endsection
