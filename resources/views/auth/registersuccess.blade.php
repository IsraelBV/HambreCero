@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="jumbotron alert alert-success">
                    <h1 class="display-4">Datos Guardados</h1>
                    <hr class="my-4">
                    <p>El usuario ha sido registrado</p>
                    <a class="btn btn-primary btn-lg" href="/home" role="button">Regresar</a>
                  </div>
            </div>
        </div>
    </div>
@endsection