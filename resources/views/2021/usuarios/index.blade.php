@extends('2021.layouts.app')

@section('content')

<table id="usrtble" class="table table-hover">
    <thead>
        <tr class="table-info">
            <th>NOMBRE</th>
            <th>EMAIL</th>
            <th>NIVEL</th>
            <th>EDITAR</th>
            <th>CONTRASEÑA</th>
            <th>DESHABILITAR</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->tipoUsuarioId == 0?'Aministrador':'Capturista'}}</td>
                <td><a href="/admin/user/{{$user->id}}/edit" class="btn btn-outline-info" name="idusuarioeditar" >Editar Usuario</a></td>
                <td><a href="/admin/user/pass/{{$user->id}}/edit" class="btn btn-outline-warning" name="idusuarioeditarcont" >Editar Contraseña</a></td>
                <td><button class="btn btn-outline-danger" name="idusuariodesh" data-usid="{{$user->id}}">Deshabilitar</button></td>
            </tr>
        @endforeach
    </tbody>
</table>
        
<div id="mdlusr"></div>

@endsection