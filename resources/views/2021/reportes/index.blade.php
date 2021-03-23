@extends('2021.layouts.app')

@section('content')
    <h2 class="col-4 offset-md-4">REPORTES</h2>
    <form id="findreporte" action="" method="">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="entregadorpt">Entregado</label>
                <select id="entregadorpt" class="form-control" name="entregadorpt" >
                    {{-- <option value="" selected>Seleccione una opcion</option> --}}
                    {{-- <option value="x" selected>Todos</option> --}}
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div> 
            <div class="form-group col-md-2">
                <label for="periodorpt">Periodo</label>
                <br>
                <select id="periodorpt" class="form-control" name="periodorpt">
                    <option value="x" selected>Todas</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{$periodo->id}}">{{$periodo->periodo}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="donadorpt">Donado</label>
                <select id="donadorpt" class="form-control" name="donadorpt">
                    {{-- <option value="" selected>Seleccione una opcion</option> --}}
                    <option value="x" selected>Todos</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div> 
            <div class="form-group col-md-3">
                <label for="ciudadrpt">Ciudad</label>
                    <br>
                    <select id="ciudadrpt" class="form-control" name="ciudadrpt">
                        {{-- <option value="" selected>Seleccione una opcion</option> --}}
                        <option value="x" selected>Todas</option>
                        @foreach ($ciudades as $ciudad)
                            <option value="{{$ciudad->id}}">{{$ciudad->localidad}}</option>
                        @endforeach
                    </select>
            </div>
                <div class="form-group col-md-3 cont-colonia">
                    <label for="coloniarpt">Colonia</label>
                    <select id="coloniarpt" class="form-control" name="coloniarpt">
                        {{-- <option value="" selected>Seleccione una opcion</option> --}}
                        <option value="x" selected>Todas</option>
                        @foreach ($colonias as $colonia)
                            <option value="{{$colonia->id}}">{{$colonia->colonia}}</option>
                        @endforeach
                    </select>
                </div> 
        </div>
            <div class="row">
                <div class="col align-self-start">
                    <button type="submit" name="" class="btn btn-info"><strong>Buscar</strong></button>
                </div>
                
                <div class="col col-4 align-self-end" id="stats">
                </div>
            </div>
    </form>

    <div class="container" id="reportecontenedor"></div>

@endsection
