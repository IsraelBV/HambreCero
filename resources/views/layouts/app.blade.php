<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"> --}}

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
                    @if (session()->has('periodo'))
                         {{' / '.session('periodoNombre')}}
                    @endif

                    
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
                                <a class="nav-link" href="{{ route('buscar') }}">{{ __('Validacion') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            </li>
                            @if (Auth::user()->tipoUsuarioId == 0)                            
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('usuarios') }}">{{ __('Usuarios') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                    {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}&nbsp;&nbsp;&nbsp;&nbsp;</a> --}}
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('reporte') }}">{{ __('Reportes') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                </li>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
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
                          
            $("#encuesta").off().submit(function(e) { //envia los datos para registro
                e.preventDefault();
                
                $.ajax({
                    type: "POST",
                    url: "/registro",
                    data: $("#encuesta").serialize(),
                    success: function(data) {
                        if (data[0] == 1) {
                            var alertcolor = "success";
                            var alerttxt = "Datos Guardados, ID: "+data[1];
                            $("[name = 'send']").hide();
                            $("[name='accion']").prop('href','/imprimir/'+data[1]);
                            // window.location.href = "/imprimir/"+data[1];//no imprimir automaticamente
                            //window.print();// formato anterior de impresion de pdf
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
                        }, 12000);                        
                    }
                });
            });

            $("#findpersona").off().submit(function(e) { //busca a las personas
                e.preventDefault();
                
                $.ajax({
                    type: "POST",
                    url: "/findPersona",
                    data: $("#findpersona").serialize(),
                    success: function(data) {

                        var listastring = "<br/><br/><h3>No se encontraron registros con esta información.<h3>";

                        if(data.length > 0){
                            
                            var listastring =  '<br/><table class="table"><tr><th>NOMBRE</th><th>CURP</th><th>MUNICIPIO</th><th>LOCALIDAD</th><th>COLONIA</th></tr>';
                                
                                $.each(data, function(k, v) {
                                listastring +='<tr>';
                                    listastring +='<td>'+(v['Nombre']!= null?v['Nombre']:"")+(v['APaterno']!= null?v['APaterno']:"")+(v['AMaterno']!= null?v['AMaterno']:"")+'</td>';
                                    listastring +='<td>'+(v['CURP']!= null?v['CURP']:"N/D")+'</td>';
                                    listastring +='<td>'+(v['municipio']!= null?v['municipio']:"N/D")+'</td>';
                                    listastring +='<td>'+(v['localidad']!= null?v['localidad']:"N/D")+'</td>';
                                    listastring +='<td>'+(v['colonia']!= null?v['colonia']:"N/D")+'</td>';
                                    listastring +='<td><a class="btn btn-info" name="idpersona" href="/registro/'+v['id']+'/edit">Ir</a></td>';
                                listastring +='</tr>';
                                });
                        } 

                        $("#personasContenedor").html(listastring);

                    }
                });
            });

            $("#encuestaupdate").off().submit(function(e) { //envia los datos para actualizar
                e.preventDefault();
                
                var idpersona = $("#ntn").data('persona');
                $.ajax({
                    type: "PUT",
                    url: "/registro/"+idpersona,
                    data: $("#encuestaupdate").serialize(),
                    success: function(data) {
                        $("[name='send']").hide();
                        // window.location.href = "/imprimir/"+idpersona; //no imprimir automaticamente
                        //window.print();// formato anterior de impresion de pdf
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
    <script> //se utiliza para entregas
        $(document).ready(function() {
            $("#findentrega").off().submit(function(e) { //busca a las personas
                e.preventDefault();
                
                $.ajax({ //manda a buscar a los registros con la curp y de ahi busca todos lo que coincida con la direccion
                    type: "POST",
                    url: "/admin/findPersonaEntrega",
                    data: $("#findentrega").serialize(),
                    success: function(data) {

                        var userlvl = data['userlvl'];
                        var listastring2 = "<br/><br/><h3>No se encontraron registros con esta CURP.<h3>";

                            if(data['retper'] != undefined){    
                                if(data['retper'].length > 0 ){

                                    var listastring2 =  '<br/><table class="table"><tr><th>NOMBRE</th><th>CURP</th><th>MUNICIPIO</th><th>LOCALIDAD</th><th>DIRECCION</th><th>ENTREGAS</th><th>DOCUMENTOS</th><th>ENTREGAR</th></tr>';//+((data['userlvl'] == 0)?'<th>REVERTIR</th>':'')+'</tr>';<th>ESTADO CIVIL</th>
                                        
                                    $.each(data['retper'], function(k, v) {
                                        listastring2 +='<tr>';
                                            listastring2 +='<td>'+(v['Nombre']!= null?v['Nombre']:"")+" "+(v['APaterno']!= null?v['APaterno']:"")+" "+(v['AMaterno']!= null?v['AMaterno']:"")+'</td>';
                                            listastring2 +='<td>'+(v['CURP']!= null?v['CURP']:"N/D")+'</td>';
                                            listastring2 +='<td>'+(v['municipio']!= null?v['municipio']:"N/D")+'</td>';
                                            listastring2 +='<td>'+(v['localidad']!= null?v['localidad']:"N/D")+'</td>';
                                            // listastring2 +='<td>'+(v['estadoc']!= null?v['estadoc']:"N/D")+'</td>';
                                            listastring2 +='<td>'+(v['colonia']!= null?v['colonia']:"")+" "+(v['Manzana']!= null?"MZ."+v['Manzana']:"")+" "+(v['Lote']!= null?"LT."+v['Lote']:"")+" "+(v['Calle']!= null?"C."+v['Calle']:"")+" "+(v['NoExt']!= null?"N°Ext."+v['NoExt']:"")+" "+(v['NoInt']!= null?"N°Int."+v['NoInt']:"")+'</td>';
                                            listastring2 +='<td><button class="btn btn-outline-info" name="idpersonalistaentrega" data-entid="'+v['id']+'">Entregas</button></td>';
                                            listastring2 +='<td><button class="btn btn-outline-warning" name="idpersonadocumentacion" data-entid="'+v['id']+'">Documentos</button></td>';
                                            listastring2 +=(data['docper'] !== 0)?'<td><button disabled class="btn btn-outline-danger" name="idpersonaentrega" data-entid="'+v['id']+'"> ENTREGADO </button></td>':'<td><button class="btn btn-outline-success" name="idpersonaentrega" data-entid="'+v['id']+'">Entregar</button></td>';
                                        listastring2 +='</tr>';
                                    });
                                    listastring2 +='</table>';
                                        
                                } 
                            } 

                        $("#entregaContenedor").html(listastring2);//despliega la lista de encontrados
                        
                        $("[name='idpersonalistaentrega']").off().click(function(){// si se hace click a algun boton de listado de entregas

                            var btnlistaentregas = $(this);

                            $("#entregadoModal .modal-title").html("LISTA DE ENTREGAS");//llena el titulo

                            $.ajax({//manda a buscar los registros de entregas de la persona
                                type: "POST",
                                url: "/admin/findListaEntregas/"+btnlistaentregas.data("entid"),
                                data: {
                                        "_token": "{{ csrf_token() }}"
                                    },
                                success: function(data) {
                                    //tabla de entregas
                                    var strlistaentregas =  '<br/><table class="table table-hover"><tr><th>ID ENT.</th><th>DIRECCION</th><th>PERIODO</th><th>DONADO</th><th>FECHA</th><th>ENTREGO</th>'+((userlvl == 0)?'<th>EDITAR</th><th>REVERTIR</th>':'')+'</tr>';
                                    $.each(data, function(k, v) {
                                        strlistaentregas +='<tr>';
                                        strlistaentregas +='<td>'+(v['id']!= null?v['id']:"N/D")+'</td>';
                                        strlistaentregas +='<td>'+'Mpio. '+(v['municipio']!= null?v['municipio']:"N/D")+' Loc. '+(v['localidad']!= null?v['localidad']:"N/D")+' '+(v['Direccion']!= null?v['Direccion']:"N/D")+'</td>';
                                        strlistaentregas +='<td>'+(v['periodo']!= null?v['periodo']:"N/D")+'</td>';
                                        strlistaentregas +='<td>'+(v['Donado']!= null?(v['Donado'] == 1 ?'Si':'No'):"N/D")+'</td>';
                                        strlistaentregas +='<td>'+(v['created_at']!= null?v['created_at']:"N/D")+'</td>';
                                        strlistaentregas +='<td>'+(v['name']!= null?v['name']:"N/D")+'</td>';
                                        strlistaentregas +=(userlvl == 0)?'<td><a class="btn btn-outline-warning" name="identregaeditar" href="/admin/entrega/'+v['id']+'/edit" target="_blank">Editar</a></td><td><input type="checkbox" class="chkToggle" data-onstyle="danger" data-offstyle="outline-warning"><button class="btn btn-outline-danger" name="identregarevertir" data-entid="'+v['id']+'" disabled>Revertir</button></td>':'';
                                        strlistaentregas +='</tr>';
                                    });
                                    strlistaentregas +='</table>';

                                    $("#entregadoModal .modal-body").html(strlistaentregas);//llena la lista de entregas en el body

                                    $('.chkToggle').bootstrapToggle();//inicializar los toggle de on off
                                    $('.chkToggle').off().change(function(){//al cambiar el switch
                                        
                                        if ($(this).prop('checked')){
                                            $(this).parent().next("button").prop( "disabled", false);
                                        } else {
                                            $(this).parent().next("button").prop( "disabled", true);
                                        }
                                    });

                                    $("#entregadoModal .modal-dialog").addClass("modal-lg");//se hace grande el modal para mejor visualizacion
                                    $('#entregadoModal [data-btn="cnl"]').text("Salir");
                                    $("#entregadoModal").modal('show');
                                    
                                    $('#entregadoModal [data-btn="cpt"]').hide();//ocultar el boton de guardar por que no sirve de nada
                                    
                                    $("[name='identregaeditar']").off().click(function(){//se utiliza solo para cerrar el modal cuando le dan clic a editar una entrega ya que redirecciona al volver a abrir refresca la info del modal
                                        $("#entregadoModal").modal('hide');
                                    });

                                    $("[name='identregarevertir']").off().click(function(){// si se hace click para revertir entrega 

                                        var btnrevertir = $(this);
                                        $.ajax({//manda a revertir la entrega segun el id
                                            type: "DELETE",
                                            url: "/admin/entrega/revertirEntrega/"+btnrevertir.data("entid"),
                                            data: {
                                                "_token": "{{ csrf_token() }}"
                                                },
                                            success: function(data) {
                                                btnrevertir.parent().parent().remove();
                                            }
                                        });
                                    });

                                    $("#entregadoModal").on('hidden.bs.modal', function (e) {// despues de cerrar el modal se quita el modal grande y se vuelve a mostrar el boton de guardar
                                        $("#entregadoModal .modal-dialog").removeClass("modal-lg");
                                        $('#entregadoModal [data-btn="cpt"]').show();
                                        $('#entregadoModal [data-btn="cnl"]').text("Cancelar");
                                    });
                                }
                            });                                                         
                        });

                        $("[name='idpersonadocumentacion']").off().click(function(){// si se hace click a algun boton de documentacion

                            var btndocumentacion = $(this);
                            $("#entregadoModal .modal-title").html("DOCUMENTACION");//llena el titulo

                            var strdocumentacion = '<div id="skidconcurp">';
                                strdocumentacion += '<label for="">';
                                    strdocumentacion += '¿La identificacion tiene la curp?';
                                strdocumentacion += '</label>';
                                strdocumentacion += '<br>';
                                strdocumentacion += '<div class="form-check-inline">';
                                    strdocumentacion += '<input class="form-check-input" type="radio" name="curpid" id="curpid" value="1">';
                                    strdocumentacion += '<label class="form-check-label" for="curpid">';
                                        strdocumentacion += 'Si';
                                    strdocumentacion += '</label>';
                                strdocumentacion += '</div>';
                                strdocumentacion += '<div class="form-check-inline">';
                                    strdocumentacion += '<input class="form-check-input" type="radio" name="curpid" id="curpid1" value="0">';
                                    strdocumentacion += '<label class="form-check-label" for="curpid1">';
                                        strdocumentacion += 'No';
                                    strdocumentacion += '</label>';
                                strdocumentacion += '</div>';
                                strdocumentacion += '</div>';
                            
                                strdocumentacion += '<form id="formdocumentos">@csrf';
                                strdocumentacion += '<div id="sktipodespensa">';
                                strdocumentacion += '<label for="">¿Que tipo de despensa es?</label>';
                                strdocumentacion += '<br>';
                                strdocumentacion += '<div class="form-check-inline">';
                                    strdocumentacion += '<input class="form-check-input" type="radio" name="donado" id="donado2" value="0">';
                                    strdocumentacion += '<label class="form-check-label" for="donado2">Pagada</label>';
                                strdocumentacion += '</div>';
                                strdocumentacion += '<div class="form-check-inline">';
                                    strdocumentacion += '<input class="form-check-input" type="radio" name="donado" id="donado1" value="1">';
                                    strdocumentacion += '<label class="form-check-label" for="donado1">Donacion</label>';
                                strdocumentacion += '</div>';
                                strdocumentacion += '</div>';
                                strdocumentacion += '<br>';
                            strdocumentacion += '<div id="docscont"> </div>';

                            $("#entregadoModal .modal-body").html(strdocumentacion);//llena opciones del body
                            console.log(btndocumentacion.data("entid"));
                                $.ajax({//manda a buscar registros de documentacion en caso de existir
                                    type: "POST",
                                    url: "/admin/findDocumentacion/"+btndocumentacion.data("entid"),
                                    data: {
                                            "_token": "{{ csrf_token() }}",
                                        },
                                    success: function(data) {         
                                        if (data != 0) {

                                            if (data.Donado == 1) {                                                
                                                $('#donado1').attr("checked", "checked");
                                            } else {
                                                $('#donado2').attr("checked", "checked");
                                            }
                                            
                                            $('#skidconcurp').hide();

                                            strdocumentacion = '<label for="">Documentacion</label>';
                                                    strdocumentacion += '<br>';
                                                        strdocumentacion += '<div class="form-group">';
                                                            strdocumentacion += '<div class="form-check">';
                                                                strdocumentacion += '<input class="form-check-input" type="checkbox" id="comprobante" name="comprobante" '+(data.Comprobante == 1?'checked':'')+'>';
                                                                strdocumentacion += '<label class="form-check-label" for="comprobante" id="comprolabel">'+(data.Donado == 0?'Recibo de pago':'Anexo 16 - Carta de no pago')+'</label>';                                                            
                                                                strdocumentacion += '</div>';
                                                            strdocumentacion += '<div class="form-check">';
                                                                strdocumentacion += '<input class="form-check-input" type="checkbox" id="cuestionario" name="cuestionario" '+(data.CuestionarioCompleto == 1?'checked':'')+'>';
                                                                strdocumentacion += '<label class="form-check-label" for="cuestionario">';
                                                                    strdocumentacion += 'Cuestionario Necesidades (2020)/ Solicitud de Apoyo (2020bis)';
                                                                strdocumentacion += '</label>';
                                                            strdocumentacion += '</div>';
                                                            strdocumentacion += '<div class="form-check">';
                                                                strdocumentacion += '<input class="form-check-input" type="checkbox" id="formato1" name="formato1" '+(data.F1SolicitudApoyo == 1?'checked':'')+'>';
                                                                strdocumentacion += '<label class="form-check-label" for="formato1">';
                                                                    strdocumentacion += 'Formato 1 Solicitud apoyo firmado';
                                                                strdocumentacion += '</label>';
                                                            strdocumentacion += '</div>';
                                                            strdocumentacion += '<div class="form-check">';
                                                                strdocumentacion += '<input class="form-check-input" type="checkbox" id="idoficial" name="idoficial" '+(data.Identificacion == 1?'checked':'')+'>';
                                                                strdocumentacion += '<label class="form-check-label" for="idoficial">';
                                                                    strdocumentacion += 'Identificación oficial vigente';
                                                                strdocumentacion += '</label>';
                                                            strdocumentacion += '</div>';   
                                                                strdocumentacion += '<div class="form-check">';
                                                                    strdocumentacion += '<input class="form-check-input" type="checkbox" id="curpdoc" name="curpdoc" '+(data.CURP == 1?'checked':'')+'>';
                                                                    strdocumentacion += '<label class="form-check-label" for="curpdoc">';
                                                                        strdocumentacion += 'CURP';
                                                                    strdocumentacion += '</label>';
                                                                strdocumentacion += '</div>';
                                                            strdocumentacion += '<div class="form-check">';
                                                                strdocumentacion += '<input class="form-check-input" type="checkbox" id="domicilio" name="domicilio" '+(data.ComprobanteDomicilio == 1?'checked':'')+'>';
                                                                strdocumentacion += '<label class="form-check-label" for="domicilio">';
                                                                    strdocumentacion += 'Comprobante de domicilio no mayor a 3 meses de antigüedad ';
                                                                strdocumentacion += '</label>';
                                                            strdocumentacion += '</div>';
                                                            strdocumentacion += '<div class="form-check">';
                                                                strdocumentacion += '<input class="form-check-input" type="checkbox" id="anexo17" name="anexo17" '+(data.Anexo17 == 1?'checked':'')+'>';
                                                                strdocumentacion += '<label class="form-check-label" for="anexo17">';
                                                                    strdocumentacion += 'Anexo 17 - Comprobante de recepción de apoyo';
                                                                strdocumentacion += '</label>';
                                                            strdocumentacion += '</div>';
                                                                strdocumentacion += '<input type="hidden" name="docid" value="'+data.id+'">';
                                                        strdocumentacion += '</div>';
                                                    strdocumentacion += '</form>';

                                                    $("#docscont").html(strdocumentacion);
                                                    
                                                    
                                                    $("[name='donado']").click(function(){
                                                        if ($(this).val() == 0) {
                                                            $('#comprolabel').html('Recibo de pago');
                                                        } else {
                                                            $('#comprolabel').html('Anexo 16 - Carta de no pago');
                                                        }
                                                    });
                                                    
                                            $("#entregadoModal").modal('show');// abre el modal de documentacion
                                        } else {
                                            $("#entregadoModal").modal('show');// abre el modal de documentacion

                                            $("[name='donado'],[name='curpid']").click(function(){
                                                    if (typeof $("[name='donado']:checked").val() != "undefined" && typeof $("[name='curpid']:checked").val() != "undefined") {
                                                        var strdocumentacion2 = '<label for="">Documentacion</label>';
                                                        strdocumentacion2 += '<br>';
                                                            strdocumentacion2 += '<div class="form-group">';
                                                                strdocumentacion2 += '<div class="form-check">';
                                                                    strdocumentacion2 += '<input class="form-check-input" type="checkbox" id="comprobante" name="comprobante">';
                                                                    strdocumentacion2 += '<label class="form-check-label" for="comprobante" id="rp">'+($("[name='donado']:checked").val() == 0?'Recibo de pago':'Anexo 16 - Carta de no pago')+'</label>';                         
                                                                strdocumentacion2 += '</div>';
                                                                strdocumentacion2 += '<div class="form-check">';
                                                                    strdocumentacion2 += '<input class="form-check-input" type="checkbox" id="cuestionario" name="cuestionario">';
                                                                    strdocumentacion2 += '<label class="form-check-label" for="cuestionario">';
                                                                        strdocumentacion2 += 'Cuestionario Necesidades (2020)/ Solicitud de Apoyo (2020bis)';
                                                                    strdocumentacion2 += '</label>';
                                                                strdocumentacion2 += '</div>';
                                                                strdocumentacion2 += '<div class="form-check">';
                                                                    strdocumentacion2 += '<input class="form-check-input" type="checkbox" id="formato1" name="formato1">';
                                                                    strdocumentacion2 += '<label class="form-check-label" for="formato1">';
                                                                        strdocumentacion2 += 'Formato 1 Solicitud apoyo firmado';
                                                                    strdocumentacion2 += '</label>';
                                                                strdocumentacion2 += '</div>';
                                                                strdocumentacion2 += '<div class="form-check">';
                                                                    strdocumentacion2 += '<input class="form-check-input" type="checkbox" id="idoficial" name="idoficial">';
                                                                    strdocumentacion2 += '<label class="form-check-label" for="idoficial">';
                                                                        strdocumentacion2 += 'Identificación oficial vigente';
                                                                    strdocumentacion2 += '</label>';
                                                                strdocumentacion2 += '</div>';
                                                                if ($("[name='curpid']:checked").val() == 0) {    
                                                                    strdocumentacion2 += '<div class="form-check">';
                                                                        strdocumentacion2 += '<input class="form-check-input" type="checkbox" id="curpdoc" name="curpdoc">';
                                                                        strdocumentacion2 += '<label class="form-check-label" for="curpdoc">';
                                                                            strdocumentacion2 += 'CURP';
                                                                        strdocumentacion2 += '</label>';
                                                                    strdocumentacion2 += '</div>';
                                                                }
                                                                strdocumentacion2 += '<div class="form-check">';
                                                                    strdocumentacion2 += '<input class="form-check-input" type="checkbox" id="domicilio" name="domicilio">';
                                                                    strdocumentacion2 += '<label class="form-check-label" for="domicilio">';
                                                                        strdocumentacion2 += 'Comprobante de domicilio no mayor a 3 meses de antigüedad ';
                                                                    strdocumentacion2 += '</label>';
                                                                strdocumentacion2 += '</div>';
                                                                strdocumentacion2 += '<div class="form-check">';
                                                                    strdocumentacion2 += '<input class="form-check-input" type="checkbox" id="anexo17" name="anexo17">';
                                                                    strdocumentacion2 += '<label class="form-check-label" for="anexo17">';
                                                                        strdocumentacion2 += 'Anexo 17 - Comprobante de recepción de apoyo';
                                                                    strdocumentacion2 += '</label>';
                                                                strdocumentacion2 += '</div>';
                                                                strdocumentacion2 += '<input type="hidden" name="docid" value="0">';
                                                            strdocumentacion2 += '</div>';
                                                        strdocumentacion2 += '</form>';

                                                        $("#docscont").html(strdocumentacion2);
                                                    }
                                            });
                                        }

                                        $('#entregadoModal [data-btn="cpt"]').off().click(function(){//en caso de mandar a guardar la documentacion

                                            $.ajax({//manda a guardar la documentacion
                                                type: "POST",
                                                url: "/admin/entrega/documentacion/"+btndocumentacion.data("entid"),
                                                data:$('#formdocumentos').serialize(),
                                                success: function(data) {                        
                                                    
                                                    $("#entregadoModal").modal('hide');
                                                }
                                            });
                                        });
                                    }
                                });                                                         
                        });

                        $("[name='idpersonaentrega']").off().click(function(){// si se hace click a algun boton de entrega 

                            var btnentrega = $(this);

                            $("#entregadoModal .modal-title").html("¿Seguro(a) que desea guardar como entregado a "+btnentrega.parent().siblings("td:first").text()+"?");//llena la pregunta del modal
                            $("#entregadoModal .modal-body").html("");//vacia el body de modal
                            $("#entregadoModal").modal('show');// abre el modal de desicion

                            $('#entregadoModal [data-btn="cpt"]').off().click(function(){//en caso de aceptar

                                $.ajax({//manda a guardar como entregado
                                    type: "POST",
                                    url: "/admin/entrega/"+btnentrega.data("entid"),
                                    data: {
                                        "_token": "{{ csrf_token() }}"
                                        },
                                    success: function(data) {
                                        if (data == 1) {                                            
                                            btnentrega.attr({
                                                class:"btn btn-danger",
                                                disabled:"true"
                                            }).html("  ENTREGADO  ");

                                            $("#entregadoModal").modal('hide');
                                        } else {
                                            $("#entregadoModal").modal('hide');
                                            $("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-danger alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        
                                            setTimeout(function() { 
                                                $("#sccs").alert('close');
                                            }, 5000);  
                                        }                      
                                    }
                                });

                            });                            
                        });

                    }
                });
            });

            $("#entregaupdate").off().submit(function(e) { //envia los datos para actualizar una entrega abierta en la lista de entregas
                e.preventDefault();
                
                var identrega = $("#hid").data('entrega');
                $.ajax({
                    type: "PUT",
                    url: "/admin/entrega/"+identrega,
                    data: $("#entregaupdate").serialize(),
                    success: function(data) {
                        $("[name='send']").hide();
                        $("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-success alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        // $("[name='accion']").show();
                        // $("[name='rel']").show();

                        setTimeout(function() { 
                            $("#sccs").alert('close');
                            window.close();
                        }, 5000);                        
                    }, 
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        $("[name='send']").hide();
                        $("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-danger alert-dismissible fade show" role="alert"> <h3 class="alert-heading">Por favor tomar captura y reportar el error <br> Status: '+ textStatus+' Error: ' + errorThrown+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); 
                    }
                });
            });
            
        });        
    </script>
    <script>//reportes
        $(document).ready(function() {
            
            $('#ciudadrpt').off().change(function(){
                var ciudadrpt = $(this);
                $.ajax({
                    type: "POST",
                    url: "/admin/reporte/findcolonias/"+ciudadrpt.val(),
                    data: {
                        "_token": "{{ csrf_token() }}"
                        },
                    success: function(data) {
                        // var selectcolonia = '<option value="" selected>Seleccione una opcion</option>';
                            var selectcolonia = '<option value="x" selected>Todas</option>';
                        $.each(data, function(k, v) {
                            selectcolonia += '<option value="'+v['id']+'" >'+v['colonia']+'</option>';
                        });
                        $('#coloniarpt').html(selectcolonia);
                    }
                });
            });

            $('#entregadorpt').off().change(function(){
                var ciudadrpt = $(this);

                if (ciudadrpt.val() == 1) {
                    $('#periodorpt').prop('disabled', false);
                    $('#donadorpt').prop('disabled', false);
                } else { 
                    $("#periodorpt").val('x');
                    $("#donadorpt").val('x');
                    $('#periodorpt').prop('disabled', true)
                    $('#donadorpt').prop('disabled', true);
                }
            });
            
            $('#findreporte').off().submit(function(e){
                e.preventDefault();
                
                var sppiner = '<div class="text-center"></br></br><div class="spinner-border text-info" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div></div>';
                $('#stats').html('');

                $('#reportecontenedor').html(sppiner);

                $.ajax({
                    type: "POST",
                    url: "/admin/reporte/findReporte",
                    data:{"_token": "{{ csrf_token() }}",
                        "ciudadrpt":$('#ciudadrpt').val(),
                        "coloniarpt":$('#coloniarpt').val(),
                        "entregadorpt":$('#entregadorpt').val(),
                        "donadorpt":$('#donadorpt').val(),
                        "periodorpt":$('#periodorpt').val(),
                        },
                    success: function(data) {
                        var reporte = "<br/><br/><h3>No se encontraron registros con la informacion proporcionada.<h3>";
                        var entregados = 0;
                        var donados = 0;

                        if(data != undefined){    
                            if(data.length > 0 ){
                                
                                var reporte = '<br/><table class="table table-hover" id="reptable"><thead><tr class="table-info"><th>NOMBRE</th><th>CURP</th><th>MUNICIPIO</th><th>LOCALIDAD</th><th>COLONIA</th><th>DIRECCION</th><th>TELEFONO</th><th>ID ENTREGA</th><th>ENTREGADO</th><th>DONADO</th><th>VALIDO</th><th>FECHA ENTREGA</th></tr></thead><tbody>';
                                    
                                $.each(data, function(k, v) {
                                    reporte +='<tr>';
                                        reporte +='<td>'+(v['Nombre']!= null?v['Nombre']:"")+" "+(v['APaterno']!= null?v['APaterno']:"")+" "+(v['AMaterno']!= null?v['AMaterno']:"")+'</td>';
                                        reporte +='<td>'+(v['CURP']!= null?v['CURP']:"N/D")+'</td>';
                                        reporte +='<td>'+(v['municipio']!= null?v['municipio']:"N/D")+'</td>';
                                        reporte +='<td>'+(v['localidad']!= null?v['localidad']:"N/D")+'</td>';
                                        reporte +='<td>'+(v['colonia']!= null?v['colonia']:"N/D")+'</td>';
                                        reporte +='<td>'+(v['Manzana']!= null?"MZ."+v['Manzana']:"")+" "+(v['Lote']!= null?"LT."+v['Lote']:"")+" "+(v['Calle']!= null?"C."+v['Calle']:"")+" "+(v['NoExt']!= null?"N°Int."+v['NoExt']:"")+" "+(v['NoInt']!= null?"N°Ext."+v['NoInt']:"")+'</td>';
                                        reporte +='<td>'+(v['TelefonoCelular']!= null?v['TelefonoCelular']:"N/D")+'</td>';
                                        reporte +='<td>'+(v['idEnt']!= null?v['idEnt']:"N/D")+'</td>';
                                        reporte +='<td>'+(v['Donado']!= null?'SI':'NO')+'</td>';
                                        reporte +='<td>'+(v['Donado']!= null?(v['Donado']==1?'SI':'NO'):"N/D")+'</td>';
                                        reporte +='<td>'+(v['name']!= null?v['name']:"N/D")+'</td>';
                                        if (v['fechaE']!= null) {
                                            var d = new Date(v['fechaE']);
                                            d.setHours(d.getHours() - 5);
                                            //d = d.getFullYear()+'-'+("0"+ (d.getMonth() + 1)).slice(-2)+'-'+("0"+d.getDate()).slice(-2)+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
                                            d = d.toLocaleString();
                                        } else {
                                            var d = "N/D";
                                        }
                                        
                                        reporte +='<td>'+d+'</td>';
                                        reporte +='</tr>';

                                        if (v['Donado']!= null) {
                                            entregados++;
                                        }
                                        if (v['Donado']==1) {
                                            donados++;
                                        }
                                });
                                reporte +='</tbody></table>';
                                $('#stats').html('<strong>Registros: </strong>'+data.length+'&nbsp;&nbsp;&nbsp;&nbsp;<strong>Entregados: </strong>'+entregados+'&nbsp;&nbsp;&nbsp;&nbsp;<strong>Donados: </strong>'+donados);


                            } 
                        } 
                        $('#reportecontenedor').html(reporte);
                        
                        $('#reptable').DataTable({
                            dom: 'frltpB',
                            pageLength: 10,
                            lengthMenu: [10,30,50,100,200,500],
                            sScrollY:"30em",
                            sScrollX: "100%",  
                            buttons: [{
                                extend: 'excel',
                                className: "btn btn-success",
                                text: 'Exportar Reporte',
                                title: '',
                                filename: 'Reporte Hambre Cero',
                            }],
                            "language": {
                                "decimal":        "",
                                "emptyTable":     "No data available in table",
                                "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                "infoEmpty":      "Mostrando 0 to 0 of 0 entries",
                                "infoFiltered":   "(filtered from _MAX_ total entries)",
                                "infoPostFix":    "",
                                "thousands":      ",",
                                "lengthMenu":     "Mostrar _MENU_ registros",
                                "loadingRecords": "Cargando...",
                                "processing":     "Procesando...",
                                "search":         "Buscar:",
                                "zeroRecords":    "No matching records found",
                                "paginate": {
                                    "first":      "Primero",
                                    "last":       "Ultimo",
                                    "next":       "Siguiente",
                                    "previous":   "Anterior"
                                },
                                "aria": {
                                    "sortAscending":  ": activate to sort column ascending",
                                    "sortDescending": ": activate to sort column descending"
                                }
                            }
                        });
                    }
                });
            });     
        });
    </script>
    <script>//usuarios
        $(document).ready(function() {
            
            $("[name='idusuariodesh']").off().click(function(){// para deshabilitar usuario 
                var btndeshabilitar = $(this);
                var modalconfirmuser = '<div class="modal fade" id="usuariomodal" tabindex="-1" role="dialog" aria-labelledby="usuariomodalLabel" aria-hidden="true">';
                    modalconfirmuser+='<div class="modal-dialog" role="document">';
                        modalconfirmuser+='<div class="modal-content">';
                            modalconfirmuser+='<div class="modal-header">';
                                modalconfirmuser+='<h5 class="modal-title" id="usuariomodalLabel">¿Seguro(a) que desea deshabilitar a '+btndeshabilitar.parent().siblings("td:first").text()+'?</h5>';
                                modalconfirmuser+='<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                    modalconfirmuser+='<span aria-hidden="true">&times;</span>';
                                modalconfirmuser+='</button>';
                            modalconfirmuser+='</div>';
                            modalconfirmuser+='<div class="modal-footer">';
                                modalconfirmuser+='<button type="button" class="btn btn-primary" data-btn="cpt">Si</button>';
                                modalconfirmuser+='<button type="button" class="btn btn-secondary" data-dismiss="modal" data-btn="cnl">No</button>';
                            modalconfirmuser+='</div>';
                        modalconfirmuser+='</div>';
                    modalconfirmuser+='</div>';
                modalconfirmuser+='</div>';

                $('#mdlusr').html(modalconfirmuser)

                
                $("#usuariomodal").modal('show');// abre el modal de desicion

                $('#usuariomodal [data-btn="cpt"]').off().click(function(){//en caso de aceptar deshabilitar el usuario

                    $.ajax({//manda deshabilitar el usuario
                        type: "PUT",
                        url: "/admin/user/deshabilitar/"+btndeshabilitar.data("usid"),
                        data: {
                            "_token": "{{ csrf_token() }}"
                            },
                        success: function() {                            
                            btndeshabilitar.parent().parent().remove();
                            $("#usuariomodal").modal('hide');            
                        }
                    });

                });                            
            });

            var datatableuser = $('#usrtble').DataTable({ // datatable para tabla de usuarios
                            dom: 'frltpB',
                            pageLength: 10, 
                            lengthMenu: [10,30,50],
                            sScrollY: '35em' ,
                            scrollCollapse: true,
                            
                            buttons: [
                                        {
                                            text: 'Registar Usuario',
                                            className: "btn btn-success",
                                            action: function ( e, dt, node, config ) {
                                                window.location = "{{ route('register') }}";
                                            }
                                        }
                                    ],
                            "language": {
                                "decimal":        "",
                                "emptyTable":     "No data available in table",
                                "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                "infoEmpty":      "Mostrando 0 to 0 of 0 entries",
                                "infoFiltered":   "(filtered from _MAX_ total entries)",
                                "infoPostFix":    "",
                                "thousands":      ",",
                                "lengthMenu":     "Mostrar _MENU_ registrtos",
                                "loadingRecords": "Cargando...",
                                "processing":     "Procesando...",
                                "search":         "Buscar:",
                                "zeroRecords":    "No matching records found",
                                "paginate": {
                                    "first":      "Primero",
                                    "last":       "Ultimo",
                                    "next":       "Siguiente",
                                    "previous":   "Anterior"
                                }
                            }
            });

            

            // $("#formularioedicionusuario").off().submit(function(e){
            //     e.preventDefault();

            //     var idpersona = $("#ntn").data('persona');
            //     $.ajax({
            //         type: "PUT",
            //         url: "/registro/"+idpersona,
            //         data: $("#encuestaupdate").serialize(),
            //         success: function(data) {
            //             $("[name='send']").hide();
            //             window.location.href = "/imprimir/"+idpersona;
            //             //window.print();// formato anterior de impresion de pdf
            //             $("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-success alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            //             $("[name='accion']").show();
            //             $("[name='rel']").show();

            //             setTimeout(function() { 
            //                 $("#sccs").alert('close');
            //             }, 3500);                        
            //         }
            //     });


            // });

        });




    </script>
</body>
</html>


