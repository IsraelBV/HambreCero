@extends('2021.layouts.app')

@section('content')

<h2 class="col-6 offset-md-3">BUSCAR BENEFICIARIO</h2>
    <br>
    <br>
    <form id="findpersonaParcial" action="" method="">
        <div class="form-row">
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
           
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="curp">CURP</label>
                <input type="text" class="form-control" id="curpParcial" name="curpParcial" onkeyup="mayusculas(this);">
            </div>
        </div>
        
        <button type="submit" name=""  class="btn btn-info"><strong>Buscar</strong></button>
    </form>

    <div class="container" id="personasContenedor"></div>

@endsection