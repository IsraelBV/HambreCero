<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    

    <title>{{ config('app.name', 'Hambre Cero') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> // css default --}}
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <style type="text/css">
        .form-group2 {
            text-align: justify;
        }

        .navbar {
        background: #009DC7;
        }

        .card-title {
            background: #009DC7;
            text-align: center;
            color: white;
            font-size: 24px;
        }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
        }

        #modal_alerta{
            margin-top: 10%;
        }
        #modal_alerta .modal-header{
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .nav-link{
            color: white !important;
        }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand"  style="color: white;" href="{{ url('/') }}">
                    {{-- {{ config('app.name', '') }} --}}
                    Secretaria de Desarrollo Social
                </a>
                {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('buscar') }}">{{ __('Buscar') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            </li>
                            @if (Auth::user()->tipoUsuarioId == 0)                            
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Usuarios') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                    {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}&nbsp;&nbsp;&nbsp;&nbsp;</a> --}}
                                </li>
                                @endif
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">

                @yield('content')
        
            </div>
        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script> //se utiliza para cuestionario
        function printHTML() {  
            if (window.print) {
                window.print();
            }
        }
        function mayusculas(e) {
            e.value = e.value.toUpperCase();
        }

        $(document).ready(function() {
            $("[name='tel_cel'],[name='tel_casa']").attr({pattern:'[1-9]{1}[0-9]{9}', type:'text', title:'10 NUMEROS'});//validacion para numero de telefono 
            $("[name='cod_postal']").attr({pattern:'[7]{2}[0-9]{3}', type:'text', title:'5 NUMEROS'});//codigo postal validacion
            $("[name='curp']").attr({pattern:'[A-Z]{4}[0-9]{6}[HM]{1}[A-Z]{5}[A-Z0-9]{1}[0-9]{1}', type:'text', title:'FORMATO DE CURP VALIDA'});//codigo postal validacion

            $('#modal_alerta').modal('show');//muestra el modal
           
            if ($("#ntn").val() == 0) { //bloquea los campos en caso de no tener intentos
                // $('#encuestaupdate input').attr('readonly', 'readonly');
                $('#encuestaupdate input').attr('disabled', true);
                $('#encuestaupdate select').attr("disabled", true);
                $("[name='send']").hide();
                $("[name='accion']").show();
                $("[name='rel']").show();
            }

            setTimeout(function() { 
                $("#btnreturn").hide();
            }, 20000);       
                          
            $("#encuesta").submit(function(e) { //envia los datos para registro
                e.preventDefault();
                
                $.ajax({
                    type: "POST",
                    url: "/registro",
                    data: $("#encuesta").serialize(),
                    success: function(data) {
                        
                        if (data == 1) {
                            var alertcolor = "success";
                            var alerttxt = "Datos Guardados"
                            $("[name = 'send']").hide();
                            window.print();
                            $("[name='accion']").show();
                            $("[name='rel']").show();
                        } else  {
                            alertcolor = "danger";
                            alerttxt = "¡Ya se ha registrado antes!"
                            setTimeout(function() { 
                                window.location.replace("/registro");
                            }, 4500);   
                        }

                        $("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-'+alertcolor+' alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+alerttxt+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        
                        setTimeout(function() { 
                            $("#sccs").alert('close');
                        }, 3500);                        
                    }
                });
            });

            $("#findpersona").submit(function(e) { //busca a las personas
                e.preventDefault();
                
                $.ajax({
                    type: "POST",
                    url: "/findPersona",
                    data: $("#findpersona").serialize(),
                    success: function(data) {

                        var listastring = "<br/><br/><h3>No se encontraron registros con esta información.<h3>";

                        if(data.length > 0){
                            
                            var listastring =  '<br/><table class="table"><tr><th>NOMBRE</th><th>CURP</th><th>COLONIA</th></tr>';
                                
                                $.each(data, function(k, v) {
                                listastring +='<tr>';
                                    listastring +='<td>'+(v['Nombre']!= null?v['Nombre']:"")+(v['APaterno']!= null?v['APaterno']:"")+(v['AMaterno']!= null?v['AMaterno']:"")+'</td>';
                                    listastring +='<td>'+(v['CURP']!= null?v['CURP']:"N/D")+'</td>';
                                    listastring +='<td>'+(v['colonia']!= null?v['colonia']:"N/D")+'</td>';
                                    listastring +='<td><a class="btn btn-info" name="idpersona" href="/registro/'+v['id']+'/edit">Ir</a></td>';
                                listastring +='</tr>';
                                });
                        } 

                        $("#personasContenedor").html(listastring);

                    }
                });
            });

            $("#encuestaupdate").submit(function(e) { //envia los datos para actualizar
                e.preventDefault();
                
                $.ajax({
                    type: "PUT",
                    url: "/registro/"+$("#ntn").data('persona'),
                    data: $("#encuestaupdate").serialize(),
                    success: function(data) {
                        $("[name='send']").hide();
                        window.print();
                        $("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-success alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        $("[name='accion']").show();
                        $("[name='rel']").show();

                        setTimeout(function() { 
                            $("#sccs").alert('close');
                        }, 3500);                        
                    }
                });
            });

            $("#opcion").change(function(){ //para el primer select
                if (this.value == 1) {
                    window.location.replace("/registro/create");
                } else {
                    $("#opcionbusqueda").show();
                }
            });

            $("#opcion2").change(function(){ //para el segundo select
            
                if (this.value == 1) {
                    $("#findnombre").show();
                    $("#findcurp").hide();
                    $("#findcurp input").val("");
                    $("#personasContenedor").html("");
                } else {
                    $("#findnombre").hide();
                    $("#findcurp").show();
                    $("#findnombre input").val("");
                    $("#personasContenedor").html("");
                }
                $("[name='findfirst']").show();
            });
            

        });
    </script>
    <script> //se utiliza para admin
        $(document).ready(function() {
            $("#findentrega").submit(function(e) { //busca a las personas
                e.preventDefault();
                
                $.ajax({ //manda a buscar a los registros con la curp y de ahi busca todos lo que coincida con la direccion
                    type: "POST",
                    url: "/admin/findPersonaEntrega",
                    data: $("#findentrega").serialize(),
                    success: function(data) {

                        var listastring2 = "<br/><br/><h3>No se encontraron registros con esta CURP.<h3>";

                        if(data.length > 0 ){
                        // if(data['retper'] != undefined){    
                        //     if(data['retper'].length > 0 ){
                                
                                var listastring2 =  '<br/><table class="table"><tr><th>NOMBRE</th><th>CURP</th><th>ESTADO CIVIL</th><th>DIRECCION</th><th>ENTREGA</th></tr>';
                                    
                                    // $.each(data['retper'], function(k, v) {
                                    $.each(data, function(k, v) {  
                                        listastring2 +='<tr>';
                                            listastring2 +='<td>'+(v['Nombre']!= null?v['Nombre']:"")+" "+(v['APaterno']!= null?v['APaterno']:"")+" "+(v['AMaterno']!= null?v['AMaterno']:"")+'</td>';
                                            listastring2 +='<td>'+(v['CURP']!= null?v['CURP']:"N/D")+'</td>';
                                            listastring2 +='<td>'+(v['estadoc']!= null?v['estadoc']:"N/D")+'</td>';
                                            listastring2 +='<td>'+(v['colonia']!= null?v['colonia']:"")+" "+(v['Manzana']!= null?"MZ."+v['Manzana']:"")+" "+(v['Lote']!= null?"LT."+v['Lote']:"")+" "+(v['Calle']!= null?"C."+v['Calle']:"")+" "+(v['NoExt']!= null?"N°Int."+v['NoExt']:"")+" "+(v['NoInt']!= null?"N°Ext."+v['NoInt']:"")+'</td>';
                                            // if (data['userlvl'] == 0) {
                                                listastring2 +=(v['Entregado'] != 1)?'<td><button class="btn btn-outline-success" name="idpersonaentrega" data-entid="'+v['id']+'">Entregar</button></td>':'<td><button disabled class="btn btn-danger" name="" data-entid="'+v['id']+'">  ENTREGADO  </button></td>';
                                            // }
                                                
                                        listastring2 +='</tr>';
                                    });
                                    listastring2 +='</table>';
                                    
                        } 
                        //     } 
                        // } 

                        $("#entregaContenedor").html(listastring2);//despliega la lista de encontrados
                        
                        $("[name='idpersonaentrega']").click(function(){// si se hace click a algun boton 

                            var btnentrega = $(this);

                            $("#entregadoModal .modal-title").html("¿Seguro(a) que desea guardar como entregado a "+btnentrega.parent().siblings("td:first").text()+"?");//llena la pregunta del modal
                            $("#entregadoModal").modal('show');// abre el modal de desicion

                            $('#entregadoModal [data-btn="cpt"]').click(function(){//en caso de aceptar

                                $.ajax({//manda a guardar como entregado
                                    type: "PUT",
                                    url: "/admin/entrega/"+btnentrega.data("entid"),
                                    data: {
                                        "_token": "{{ csrf_token() }}"
                                        },
                                    success: function(data) {                        
                                        btnentrega.attr({
                                            class:"btn btn-danger",
                                            disabled:"true",
                                            name: ""
                                        }).html("  ENTREGADO  ");

                                        $("#entregadoModal").modal('hide');
                                    }
                                });

                            });                            
                        });

                    }
                });
            });

            
        });        
    </script>
</body>
</html>
