@extends('2022.layouts.app')

@section('content')

    <h2 class="col-6 offset-md-3">EDITAR ENTREGA</h2>
    <br>
    <br>
    <form id="findentrega" action="/admin2022/entrega/edit" method="get">
        {{-- @csrf --}}

        <div class="form-row">
            <div class="col-6 offset-md-3">

                <label for="idEntrega">ID ENTREGA</label>
                <div class="input-group">
                        <input required type="text" class="form-control" id="idEntrega" name="idEntrega" onkeyup="mayusculas(this); ">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-info"><strong>Buscar</strong></button>
                        </div>
                </div>
            </div>
        </div>

    </form>

@endsection
