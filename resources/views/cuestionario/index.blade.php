@extends('layouts.app')

@section('content')
  
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <img src="{{asset('img/logo_nesesidades.jpg')}}" class="img-fluid img-thumbnail">
            </div>
        </div>
    </div>

    <br><br>
    <div class="form-group">
        <label for="opcion">Para ir a la encuesta seleccione una opcion:</label>
        <select name="opcion" id="opcion" class="form-control">
            <option selected value="">seleccione..</option>
            <option value="1">Voy a contestar por primera vez</option>
            <option value="2">Fui visitado previamente</option>
        </select>
    </div>

    <div class="form-group" style="display:none" id="opcionbusqueda">
        <label for="">Seleccione una opcion para busqueda:</label>
        <select name="opcion2" id="opcion2" class="form-control">
            <option selected value="">seleccione..</option>
            <option value="1">Nombre Completo</option>
            <option value="2">Curp</option>
        </select>
    </div>
    
    <form id="findpersona" action="" method="">
        @csrf
        <div id="findnombre" style="display:none" class="form-row">
            <div class="form-group col-md-3">
                <label for="nombre">NOMBRE</label>
                <input type="text" class="form-control" id="nombre" name="nombre" onkeyup="mayusculas(this);">
            </div>
            <div class="form-group col-md-3">
                <label for="apellido_p">APELLIDO PATERNO</label>
                <input type="text" class="form-control" id="apellido_p" name="apellido_p" onkeyup="mayusculas(this);">
            </div>
            <div class="form-group col-md-3">
                <label for="apellido_m">APELLIDO MATERNO</label>
                <input type="text" class="form-control" id="apellido_m" name="apellido_m" onkeyup="mayusculas(this);">
            </div>
            {{-- <div class="form-group col-md-3">
                <label for="colonia">COLONIA</label><br>
                <select for id="colonia" class="form-control" name="colonia">
                    <option value="" selected>Seleccione una opcion</option>
                     @foreach ($colonias as $colonia)
                        <option value="{{$colonia->id}}">{{$colonia->Descripcion}}</option>
                    @endforeach 
                </select>
                <br>
            </div> --}}
        </div>

        <div id="findcurp" style="display:none" class="form-row">
            <div class="form-group col-md-4">
                <label for="curp">CURP</label>
                <input type="text" class="form-control" id="curp" name="curp" onkeyup="mayusculas(this);">
            </div>
        </div>
        
        <button type="submit" name="findfirst" style="display:none" class="btn btn-info"><strong>Buscar</strong></button>
    </form>

    <div class="container" id="personasContenedor"></div>

    <div id="modal_alerta" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            </div>
        </div>
    </div>

@endsection
