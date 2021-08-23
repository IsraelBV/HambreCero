@extends('2021.layouts.app')

@section('content')
    <h2 class="col-4 offset-md-4">REPORTES</h2>
    <form id="findreporte" action="" method="">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="periodoent">Periodo Entrega:</label>
                <br>
                <select id="periodoent" class="form-control" name="periodoent">
                    <option value="" selected>Todos</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{$periodo->id}}">{{$periodo->periodo}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="centroent">Centro Entrega:</label>
                <br>
                <select id="centroent" class="form-control" name="centroent">
                    <option value="" selected>No</option>
                    @foreach ($centroent as $centro)
                        <option value="{{$centro->id}}">{{$centro->ce}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-1">
                <label for="donado">Donado:</label>
                <select id="donado" class="form-control" name="donado">
                    <option value="" selected>Todos</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div> 
            
            <div class="form-group col-md-2">
                <label for="municipio">Municipio</label>
                <br>
                <select id="municipio" class="form-control" name="municipio">
                    <option value="" selected>Todos</option>
                    @foreach ($municipios as $municipio)
                        <option value="{{$municipio->id}}">{{$municipio->municipio}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="localidad">Localidad</label>
                <br>
                <select id="localidad" class="form-control" name="localidad">
                    <option value="" selected>Todas</option>
                    {{-- @if ($ciudades)                           
                        @foreach ($ciudades as $ciudad)
                            <option value="{{$ciudad->id}}">{{$ciudad->localidad}}</option>
                        @endforeach
                    @endif --}}
                </select>
            </div>
            <div class="form-group col-md-2 cont-colonia">
                <label for="colonia">Colonia</label>
                <select id="colonia" class="form-control" name="colonia">
                    <option value="" selected>Todas</option>
                    {{-- @if ($colonias)
                        @foreach ($colonias as $colonia)
                            <option value="{{$colonia->id}}">{{$colonia->colonia}}</option>
                        @endforeach
                    @endif --}}
                </select>
            </div>
            
        </div>
    </form>
        <div class="row">
            <div class="col align-self-start">
                <button type="button" id="verentregados" form ="findreporte" class="btn btn-info"><strong>Buscar</strong></button>
                {{-- <button type="button" id="generarxlsentregados" form ="findreporte" target="_blank" class="btn btn-success"><strong>Descargar</strong></button> --}}
            </div>
            
            <div class="col col-7 align-self-end" id="stats">
            </div>
        </div>
        <input type="hidden" name="ntn" id="ntn">


    <div class="container" id="reportecontenedor"></div>

@endsection
