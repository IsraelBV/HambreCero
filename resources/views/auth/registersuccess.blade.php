@extends('layoutlogin')

@section('contentlogin')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="jumbotron alert alert-success">
                    <h1 class="display-4">Datos Guardados</h1>
                    <hr class="my-4">
                    <p>{{$msg}}</p>
                    @if (session('periodo') == 3)
                        <a class="btn btn-primary btn-lg" href="/admin/user" role="button">Regresar</a>
                    @else
                    <a class="btn btn-primary btn-lg" href="/admin2020/user" role="button">Regresar</a>
                    @endif
                  </div>
            </div>
        </div>
    </div>
@endsection