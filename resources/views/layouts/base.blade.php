<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hambre Cero</title>
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

    </style>
</head>

<body>
    <div class="container row">
        <nav class="navbar fixed-top navbar-light">
            <a class="navbar-brand" href="#" style="color: white;">Secretaria de Desarrollo Social</a>
        </nav>
    </div>

    {{-- <form action="/exl" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button>mandar excel</button>
    </form> --}}
    <div class="container">

        @yield('content')

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
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
            }, 5000);       
                          
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
</body>

</html>