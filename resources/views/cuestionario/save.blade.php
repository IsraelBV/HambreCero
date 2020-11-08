@extends('layouts.base')
@section('content')

<div class="jumbotron">
    {{-- <h1 class="display-4">Datos Guardados</h1>
    <hr class="my-4"> --}}
    <p>Este programa utiliza recursos públicos y es ajeno a cualquier partido político. Queda prohibido el uso para fines distintos al desarrollo social.</p>
    {{-- <a class="btn btn-primary btn-lg" href="/" role="button">Regresar</a> --}}
  </div>
  {{-- esto es para importar el contenido de los catalogos de una excel --}}
    {{-- <form action="/exl" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <button>ex</button>
    </form> --}}
@endsection