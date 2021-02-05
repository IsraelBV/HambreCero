@extends('layouts.app')

@section('content')
    
    

    <form action="/redirectPeriodo" method="POST">
        @csrf
        <div class="form-row">
            
            <div class="form-group col-md-3">

                <h1>PERIODOS</h1>

                <select class="form-control" name="periodo" >
                    <option value="" selected>Seleccione una opcion</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{$periodo->id}}">{{$periodo->Descripcion}}</option>
                    @endforeach
                </select>

                <br>
            </div>
        </div>
        
        <button type="submit" class="btn btn-info"><strong>Aceptar</strong></button>
    </form>

@endsection