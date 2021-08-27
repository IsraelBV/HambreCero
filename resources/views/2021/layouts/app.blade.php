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
	<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />

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

						{{-- @if (session()->has('centroEntrega'))
							<ul class="nav navbar-nav">
								<li class="nav-item">
									<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true" style="font-size:1.2rem;">Disponibilidad: {{__(session('centroEntregaStock'))}}</a>
								</li>
							</ul>
						@endif --}}
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Authentication Links -->
						@guest
							@if (Route::has('login'))
								<li class="nav-item">
									<a class="nav-link" href="{{ route('login') }}">{{ __('Administración') }}</a>
								</li>
							@endif
						@else
							{{-- <li class="nav-item">
								<a class="nav-link" href="{{ route('buscar') }}">{{ __('Validacion') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
							</li> --}}
							@if (Auth::user()->tipoUsuarioId == 0)                            
								@if (Route::has('register'))
									{{-- <li class="nav-item">
										<a class="nav-link" href="{{ route('usuarios2021') }}">{{ __('Usuarios') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
									</li> --}}
									<li class="nav-item">
										<a class="nav-link" href="{{ route('reporte2021') }}">{{ __('Reportes') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
									</li> 
								@endif
							@endif
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->name }}
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									@if (session()->has('centroEntrega'))
											<h5 @if(Auth::user()->tipoUsuarioId == 0) id="nombreCentro" @endif class="dropdown-header">
												{{__(session('centroEntregaNombre'))}} 
											</h5>
											<div class="dropdown-divider"></div>
									@endif
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

			<div id="modalMultiuso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary closemdl" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary savemdl">Guardar</button>
						</div>
					</div>
				</div>
			</div>
			
		</main>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
	<script src="{{asset('js/webcam.js')}}"></script>
	
	<script> //se utiliza para cuestionario
		function printHTML() {  
			if (window.print) {
				window.print();
			}
		}

		function mayusculas(e) {
			e.value = e.value.toUpperCase();
		}

		function longitud(e) {
			// console.log();
			var max_chars = 250;

			var chars = e.value.length;
			var diff = max_chars - chars;
			$(e).siblings('.contador').html(diff); 
		}
		

		setTimeout(function() { 
			$("#btnreturn").hide();
		}, 20000);

		if ( $(".alertDefault").length > 0 ){
			setTimeout(function() { 
				$(".alertDefault").remove();
			}, 8000);
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
				// $("[name='accion']").show();
				$("[name='rel']").show();
			}
			
			$(document).on('click','#solicitarD',function(){
            // $("#solicitarD").off().click(function(){//abre y escribe el modal para subir los documentos y solicitar una despensa
				$("#encuestaupdatemodal .modal-title").html('Subir documentacion');

				var documentoshtml = '';
				documentoshtml +='<form id="documentosForm" action="" method="" enctype="multipart/form-data">@csrf';
                    documentoshtml +='  <div class="custom-file">';
                    documentoshtml +='      <input type="file" class="custom-file-input" id="IdentificacionFile" name="IdentificacionFile" >';
                    documentoshtml +='      <label class="custom-file-label" for="IdentificacionFile">Seleccionar Identificacion (parte frontal)</label>';
                    documentoshtml +='  </div><br><br>';
					documentoshtml +='  <div class="custom-file">';
                    documentoshtml +='      <input type="file" class="custom-file-input" id="IdentificacionatrasFile" name="IdentificacionatrasFile" >';
                    documentoshtml +='      <label class="custom-file-label" for="IdentificacionatrasFile">Seleccionar Identificacion (parte trasera)</label>';
                    documentoshtml +='  </div><br><br>';
                    documentoshtml +='  <div class="custom-file">';
                    documentoshtml +='      <input type="file" class="custom-file-input" id="CompDomFile" name="CompDomFile" lang="es">';
                    documentoshtml +='      <label class="custom-file-label" for="CompDomFile">Seleccionar Comprobante de Domicilio</label>';
                    documentoshtml +='  </div><br><br>';
                    documentoshtml +='  <div class="custom-file">';
                    documentoshtml +='      <input type="file" class="custom-file-input" id="CURPFile" name="CURPFile" lang="es">';
                    documentoshtml +='      <label class="custom-file-label" for="CURPFile">Seleccionar CURP</label>';
                    documentoshtml +='  </div><br><br>';
                    // documentoshtml +='  <div class="custom-file">';
                    // documentoshtml +='      <input type="file" class="custom-file-input" id="ComPagFile" name="ComPagFile" lang="es">';
                    // documentoshtml +='      <label class="custom-file-label" for="ComPagFile">Seleccionar Comprobante de pago </label>';
                    // documentoshtml +='  </div><br><br>';
                    // documentoshtml +='  <div class="custom-file">';
                    // documentoshtml +='      <input type="file" class="custom-file-input" id="ConstAutFiled" name="ConstAutFiled" lang="es">';
                    // documentoshtml +='      <label class="custom-file-label" for="ConstAutFiled">Seleccionar constancia de la autoridad local </label>';
                    // documentoshtml +='  </div>';
				documentoshtml +='</form>';

				$("#encuestaupdatemodal .modal-body").html(documentoshtml);
				bsCustomFileInput.init();
				$("#encuestaupdatemodal").modal('show');
				$('#encuestaupdatemodal [data-btn="cpt"]').attr({form:'documentosForm',type:'submit'});

				$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-info alert-dismissible fade show" role="alert"> <h3 class="alert-heading">Los documentos adjuntados deben de estar en formato PDF o JPG <br> y no exceder los 2 MB de tamaño</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				
				setTimeout(function() { 
					$("#sccs").alert('close');
					$("#sccs").remove();
				}, 5500);

				$('#documentosForm').off().submit(function(e){
					e.preventDefault();

					$.ajax({
						type: "POST",
						url: "/registro/Entrega/solicitar/"+$("#ntn").data('persona'),
						data: new FormData(this),
						contentType: false,
						cache: false,
						processData:false,
						beforeSend: function(){
							$("#encuestaupdatemodal .modal-body").html('<div class="text-center"></br></br><div class="spinner-border text-info" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div></div>');
							$('#encuestaupdatemodal [data-btn="cpt"]').attr("disabled", true);
						}
					}).done(function(data) {
						$("#entcont").html(data);            

						$("#encuestaupdatemodal").modal('hide');//se cierra el modal 

						$('#encuestaupdatemodal [data-btn="cpt"]').attr('type','button').removeAttr("form disabled");
						$("#encuestaupdatemodal .modal-body").html('');

					}).fail(function(jqXHR, textStatus, errorThrown){
						alert('Ocurrio un error favor de reportarlo');
						
						$("#encuestaupdatemodal").modal('hide');//se cierra el modal 

						$('#encuestaupdatemodal [data-btn="cpt"]').attr('type','button').removeAttr("form disabled");
						$("#encuestaupdatemodal .modal-body").html('');
					});
				});
					
				
			});

			$(document).on('click','#editarDoc',function(){
			//$("#editarDoc").off().click(function(){//trae el html de los archivos existentes y los no existentes
				$("#documentacionEdit").closest('.card').show();
				var folio = $(this).data('folio');

				Webcam.set({
							width: 640,
							height: 480,
							image_format: 'jpeg',
							jpeg_quality: 98
						});
				// // alert(folio);
				// console.log($(this).data('folio'));

				// bsCustomFileInput.init();

				$.ajax({
					type: "POST",
					url: "/documentacion/edit",
					data:{
						'folio':folio,
						"_token": "{{ csrf_token() }}"
						},
					beforeSend: function(){
						$("#entregaEnUpdate").html('').closest('.card').hide();
						$("#documentacionEdit").html('<div class="text-center"></br></br><div class="spinner-border text-info" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div></div>');
						$(this).attr("disabled", true);
					}
				}).done(function(data) {

					$("#documentacionEdit").html(data);

					$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-info alert-dismissible fade show" role="alert"> <h3 class="alert-heading">Los documentos adjuntados deben de estar en formato PDF o JPG <br> y no exceder los 2 MB de tamaño</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				
					setTimeout(function() { 
						$("#sccs").alert('close');
						$("#sccs").remove();
					}, 5500);


					$('.chkToggle').bootstrapToggle();
					bsCustomFileInput.init();

					$(document).on('click','.btncamera',function(){//boton de camara
					// $(".btncamera").off().click(function(){//
						var namedoc = $(this).data('name');
						$("#encuestaupdatemodal .modal-title").html('Tomar foto');
						$("#encuestaupdatemodal .modal-dialog").addClass('modal-lg');//<<------------------------corregir de nuevo 
						var htmlfoto = '<div id="camera" style="display:block;margin:auto;"></div>';
							htmlfoto += '<button id="take_photo" class="btn btn-info btn-block mt-2 mb-2" type=button>Tomar foto</button>';
							htmlfoto += '<div id="resultPhoto"></div>';


						$("#encuestaupdatemodal .modal-body").html(htmlfoto);

						$('#encuestaupdatemodal [data-btn="cpt"]').attr("disabled", true);
						
						Webcam.attach('#camera');

						$("#take_photo").off().click(function(){//solo captura la imagen
							Webcam.snap(function(data_uri) {
								$('#resultPhoto').html('<img style="display:block;margin:auto;" src="'+data_uri+'"/>');
							});
							$('#encuestaupdatemodal [data-btn="cpt"]').removeAttr("disabled");
						});

						$('#encuestaupdatemodal [data-btn="cpt"]').off().click(function(){//guarda el base64 de la imagen en un hidden
							var imgbase64 = $('#resultPhoto img').attr('src');
							$('#'+namedoc).attr('type','hidden').removeClass('custom-file-input');
							$('#'+namedoc).val(imgbase64);
							$('#'+namedoc).next().removeClass('custom-file-label');
							$("#encuestaupdatemodal").modal('hide');//se cierra el modal 
							$("#encuestaupdatemodal .modal-dialog").removeClass('modal-lg');
						});

						$("#encuestaupdatemodal").modal('show');							
					});

					$(".btndelfile").off().click(function(){//sirve para eliminar un documento
						var delbtn = $(this);

						$.ajax({
							type: "POST",
							url: "/documentacion/delete/"+delbtn.data('docname'),//se manda el nombre del documento
							data:{
								'folio':folio,
								'nameatr':delbtn.data('name'),
								"_token": "{{ csrf_token() }}"
								},
							beforeSend: function(){
								delbtn.attr("disabled", true);
							}
						}).done(function(data) {
							if (data[2] == 0 ) {//si es igual a 0 quiere decir que se descompletaron los documentos obligarios 
								if ($('#entregaenupdatebtn').length) {//entonces verifica si ya existia el boton de entrega 
									$('#entregaenupdatebtn').remove();//si existe lo borra
									$('#entregaenupdatedocbtn').remove();//si existe lo borra
								}
							}

							delbtn.closest('.form-row').html(data[0]);
							$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-success alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data[1]+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							bsCustomFileInput.init();
				
							setTimeout(function() { 
								$("#sccs").alert('close');
								$("#sccs").remove();
							}, 4500);

						}).fail(function(jqXHR, textStatus, errorThrown){
							delbtn.removeAttr("disabled");
							alert('Ocurrio un error al borrar el documento favor de reportarlo');
						});
					});

					$('#editDocumentosForm').off().submit(function(e){//manda a guardar
						e.preventDefault();
						$.ajax({
							type: "POST",
							url: "/documentacion/update/"+folio,
							data: new FormData(this),
							contentType: false,
							cache: false,
							processData:false,
							beforeSend: function(){
								$("#documentacionEdit").html('<div class="text-center"></br></br><div class="spinner-border text-info" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div></div>');
								// $('#encuestaupdatemodal [data-btn="cpt"]').attr("disabled", true);
							}
						}).done(function(data) {
							// $('#encuestaupdatemodal [data-btn="cpt"]').attr('type','button').removeAttr("form disabled");
							$("#documentacionEdit").html('');

							@if (auth()->check())
								if (data[0] == 1) {
									
									if ($('#entregaenupdatebtn').length) {//entonces verifica si ya existia el boton de entrega 
										// $('#entregaenupdatebtn').remove();//si existe lo borra
									} else {
										// if (data[2] == 0) {
											$('#editarDoc').after('<br><button style="color: white" id="entregaenupdatedocbtn" class="btn btn-info mb-1" data-folio="'+folio+'">Entrega Posterior</button>');
										// }
										$('#editarDoc').after('<br><button style="color: white" id="entregaenupdatebtn" class="btn btn-success mb-1" data-folio="'+folio+'">Entrega</button>');
									}
								}	
							@endif

							$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-success alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data[1]+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				
							setTimeout(function() { 
								$("#sccs").alert('close');
								$("#sccs").remove();
							}, 4500);

							$("#documentacionEdit").closest('.card').hide();

							// $("#entcont").html(data);                     
						}).fail(function(jqXHR, textStatus, errorThrown){

							$("#documentacionEdit").html('');
							$("#documentacionEdit").closest('.card').hide();
							var errores = jqXHR.responseJSON.errors;
							var msgerr = "";
							if (errores.IdentificacionFile != undefined) {
								msgerr = errores.IdentificacionFile [0];
							} else if( errores.IdentificacionatrasFile != undefined){
								msgerr = errores.IdentificacionatrasFile[0];
							}else if( errores.CompDomFile != undefined){
								msgerr = errores.CompDomFile[0];
							}else if( errores.CURPFile != undefined){
								msgerr = errores.CURPFile[0];
							}else if( errores.ComPagFile != undefined){
								msgerr = errores.ComPagFile[0];
							}else if( errores.ConstAutFiled != undefined){
								msgerr = errores.ConstAutFiled[0];
							} else {
								msgerr = "Sucedio algo inesperado, favor de reportarlo.";
							}

							$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-danger alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+msgerr+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				
							setTimeout(function() { 
								$("#sccs").alert('close');
								$("#sccs").remove();
							}, 4500);
						});
					});
            
				}).fail(function(jqXHR, textStatus, errorThrown){
					
					$("#documentacionEdit").html('');
					alert('Ocurrio un error favor de reportarlo');
				});								
			});

			$(document).on('click',"#entregaenupdatebtn",function(){//trae el html de la subida de foto de entrega
			// $("#entregaenupdatebtn").off().click(function(){
				$("#entregaEnUpdate").closest('.card').show();
				var folio = $(this).data('folio');

				Webcam.set({
							width: 680,
							height: 510,
							image_format: 'jpeg',
							jpeg_quality: 100
						});
				
				$.ajax({
					type: "GET",
					url: "/entrega/enUpdate",
					beforeSend: function(){
						$("#documentacionEdit").html('').closest('.card').hide();//por si se tiene abierto el lugar donde se suben documentos ya que se pueden borrar desde ahi 
						$("#entregaEnUpdate").html('<div class="text-center"></br></br><div class="spinner-border text-info" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div></div>');
						$(this).attr("disabled", true);
					}
				}).done(function(data) {

					$("#entregaEnUpdate").html(data);

					Webcam.attach('#camara');

					$("#tomar_foto").off().click(function(){//solo captura la imagen
						Webcam.snap(function(data_uri) {
							$('#foto').html('<img style="display:block;margin:auto;" src="'+data_uri+'"/>');
							if ($('#fotoentrega').length) {
								$('#fotoentrega').remove();
								$('#entregaEnUpdateForm').append('<input id="fotoentrega" name="fotoentrega" type="hidden" value="'+data_uri+'">');
							} else {
								$('#entregaEnUpdateForm').append('<input id="fotoentrega" name="fotoentrega" type="hidden" value="'+data_uri+'">');
							}
						});
						$('#guardarEntrega').removeAttr("disabled");
					});

					$('#entregaEnUpdateForm').off().submit(function(e){//manda a guardar la entrega
						e.preventDefault();

						$.ajax({
							type: "POST",
							url: "/entrega/enUpdate/"+folio,
							data: $('#entregaEnUpdateForm').serialize(),						
							// data: new FormData(this),// para enviar documentos
							// contentType: false,
							// cache: false,
							// processData:false,
							beforeSend: function(){
								$("#entregaEnUpdate").html('<div class="text-center"></br></br><div class="spinner-border text-info" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div></div>');
								// $('#encuestaupdatemodal [data-btn="cpt"]').attr("disabled", true);
							}
						}).done(function(data) {
							// $('#encuestaupdatemodal [data-btn="cpt"]').attr('type','button').removeAttr("form disabled");
							$("#entregaEnUpdate").html('');

							if (data[0] == 1) {
								$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-success alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data[1]+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
								$("#entcont").html(data[2]);
							} else {
								$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-danger alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data[1]+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							}
				
							setTimeout(function() { 
								$("#sccs").alert('close');
								$("#sccs").remove();
							}, 4500);
							
							$("#entregaEnUpdate").closest('.card').hide();

							$("#banerSotck h5 span").html(data[3][0].stockDespensas);//para actualizar el banner de stock
							if (data[3][0].stockDespensas >= 70) {
								$("#banerSotck h5").css('background','#5bc0de')
							} else if(data[3][0].stockDespensas >= 30){
								$("#banerSotck h5").css('background','#ffc107')
							} else {
								$("#banerSotck h5").css('background','#dc3545')
							}						

							// $("#entcont").html(data);                     
						}).fail(function(jqXHR, textStatus, errorThrown){

							// $('#encuestaupdatemodal [data-btn="cpt"]').attr('type','button').removeAttr("form disabled");
							$("#entregaEnUpdate").html('');
							$("#entregaEnUpdate").closest('.card').hide();
							alert('Ocurrio un error favor de reportarlo');
						});
					});
            
				}).fail(function(jqXHR, textStatus, errorThrown){
					
					$("#entregaEnUpdate").html('');
					alert('Ocurrio un error favor de reportarlo');
				});								
			});
			
			$(document).on('click',"#entregaenupdatedocbtn",function(){//trae el html de la subida de el documento jpg que se va a subir
			// $("#entregaenupdatebtn").off().click(function(){
				$("#entregaEnUpdate").closest('.card').show();
				var folio = $(this).data('folio');
				
				$.ajax({
					type: "GET",
					url: "/entrega/enUpdatePost",
					beforeSend: function(){
						$("#documentacionEdit").html('').closest('.card').hide();//por si se tiene abierto el lugar donde se suben documentos ya que se pueden borrar desde ahi 
						$("#entregaEnUpdate").html('<div class="text-center"></br></br><div class="spinner-border text-info" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div></div>');
						$(this).attr("disabled", true);
					}
				}).done(function(data) {
					$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-info alert-dismissible fade show" role="alert"> <h3 class="alert-heading">La imagen adjuntada debe de estar en formato JPG <br> y no exceder los 2 MB de tamaño</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				
					setTimeout(function() { 
						$("#sccs").alert('close');
						$("#sccs").remove();
					}, 5500);

					$("#entregaEnUpdate").html(data);
					bsCustomFileInput.init();

					$('#postEntregaEnUpdateForm').off().submit(function(e){//manda a guardar la entrega
						e.preventDefault();

						$.ajax({
							type: "POST",
							url: "/entrega/enUpdate/"+folio,						
							data: new FormData(this),// para enviar documentos
							contentType: false,
							cache: false,
							processData:false,
							beforeSend: function(){
								$("#entregaEnUpdate").html('<div class="text-center"></br></br><div class="spinner-border text-info" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div></div>');
								// $('#encuestaupdatemodal [data-btn="cpt"]').attr("disabled", true);
							}
						}).done(function(data) {
							$("#entregaEnUpdate").html('');

							if (data[0] == 1) {
								$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-success alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data[1]+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
								$("#entcont").html(data[2]);
							} else {
								$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-danger alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data[1]+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							}
				
							setTimeout(function() { 
								$("#sccs").alert('close');
								$("#sccs").remove();
							}, 4500);

							$("#entregaEnUpdate").closest('.card').hide();

							$("#banerSotck h5 span").html(data[3][0].stockDespensas);//para actualizar el banner de stock
							if (data[3][0].stockDespensas >= 70) {
								$("#banerSotck h5").css('background','#5bc0de')
							} else if(data[3][0].stockDespensas >= 30){
								$("#banerSotck h5").css('background','#ffc107')
							} else {
								$("#banerSotck h5").css('background','#dc3545')
							}	
            
						}).fail(function(jqXHR, textStatus, errorThrown){

							// $('#encuestaupdatemodal [data-btn="cpt"]').attr('type','button').removeAttr("form disabled");
							$("#entregaEnUpdate").html('');
							$("#entregaEnUpdate").closest('.card').hide();

							if (jqXHR.responseJSON.errors.fotoentrega == null) {
								var msgerr = jqXHR.responseJSON.errors.coments;
							} else {
								var msgerr = jqXHR.responseJSON.errors.fotoentrega;
							}

							$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-danger alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+msgerr+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				
							setTimeout(function() { 
								$("#sccs").alert('close');
								$("#sccs").remove();
							}, 4500);

						});
					});
            
				}).fail(function(jqXHR, textStatus, errorThrown){
					
					$("#entregaEnUpdate").html('');
					alert('Ocurrio un error favor de reportarlo');
				});								
			});

			$(document).on('click', '#nombreCentro',function(){// abre el modal para aumentar despensas
				
				$cuerpo_modal = '<form id="stockform" action="" method="">'+
									'<div class="form-group">'+
										'<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
										// '<input type="hidden" name="_method" value="PUT">'+
									'<label for="addStock">¿Cuantas despensas desea agregar?</label>'+
									'<input type="number" name="addStock" class="form-control" id="addStock" placeholder="">'+
									'</div>'+
								'</form>';

				$("#modalMultiuso .modal-header .modal-title").html('Agregar Stock');
				$("#modalMultiuso .modal-body").html($cuerpo_modal);
				$("#modalMultiuso .modal-footer .savemdl").attr('form','stockform');

				$("#modalMultiuso").modal('show');

				$('#stockform').off().submit(function(e){
					e.preventDefault();

					$.ajax({
						type: "POST",
						url: "/catalogo/stock/update",
						data: $("#stockform").serialize(),
						beforeSend: function(){
							$("#modalMultiuso").modal('hide');//se cierra el modal 

							$("#modalMultiuso .modal-header .modal-title").html('');
							$("#modalMultiuso .modal-body").html('');
							$("#modalMultiuso .modal-footer .savemdl").removeAttr('form');
						}
					}).done(function(data) {
						console.log(data);
						if (data == 0) {
							alert('Ocurrio un error al actualizar el stock, favor de reportarlo');
						} else {
							location.reload();
						} 
					}).fail(function(jqXHR, textStatus, errorThrown){
						alert('Ocurrio un error al aumentar el stock, favor de reportarlo');
					});

				});
				

			});
			$("#passpersonacreate").off().submit(function(e) { //cambia la contraseña de la persona
				e.preventDefault();
				
				$.ajax({
					type: "POST",
					url: "/registro/pass/"+$("#passpersonacreate").data("user"),
					data: $("#passpersonacreate").serialize(),
					beforeSend: function(){
						if ($("#password").hasClass("is-invalid")) { //verifica si hay alguna alerta de error
								$("#password").removeClass("is-invalid")
								$(".invalid-feedback").remove();
						}
					},
					success: function(data) {
						$(document.body).html(data);
					}, 
					error: function( jqXHR, textStatus, errorThrown){
						// console.log(jqXHR.responseJSON.errors.contraseña[0]);
						if ($("#password").hasClass("is-invalid")) {//si hay una alerta de error solo elimina y pone una nueva
							$(".invalid-feedback").remove();
							$("#password").after('<span class="invalid-feedback" role="alert"><strong>'+jqXHR.responseJSON.errors.contraseña[0]+'</strong></span>');
							
						} else {// si no hay alertas agrega la clase de rror y la alerta
							$("#password").addClass('is-invalid')
							$("#password").after('<span class="invalid-feedback" role="alert"><strong>'+jqXHR.responseJSON.errors.contraseña[0]+'</strong></span>');
						}
					}
				});
			});
		   
			$("#encuesta").off().submit(function(e) { //envia los datos para registro
				e.preventDefault();
				
				$.ajax({
					type: "POST",
					url: "/registro",
					data: $("#encuesta").serialize(),
					beforeSend: function(){
						$("[name = 'send']").hide();

						if ($("#password").hasClass("is-invalid")) { //verifica si hay alguna alerta de error
								$("#password").removeClass("is-invalid")
								$(".invalid-feedback").remove();
						}

						$("#entcont").append('<div id="spinnerprov" class="text-center"></br></br><div class="spinner-border text-info" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div></div>');
					},
					success: function(data) {
						$("[name='rel']").show();

						if (data[0] != 0) {

							$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-success alert-dismissible fade show" role="alert"> <h3 class="alert-heading">Datos Guardados, ID: '+data[1]+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							
							$("#encuesta").append('<input type="hidden" data-persona="'+data[1]+'" id="ntn">');       

							$("#spinnerprov").remove();
							
							$("#solicitarD").show();  
						} else {
							$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-danger alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data[1]+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							
							setTimeout(function() { 
								window.location.href = "/registro";
							}, 14000);
						}

						setTimeout(function() { 
							$("#sccs").alert('close');
						}, 12000);
					}, 
					error: function( jqXHR, textStatus, errorThrown){
						$("[name = 'send']").show();
						$("#spinnerprov").remove();
						// console.log(jqXHR.responseJSON.errors.contraseña[0]);
						if ($("#password").hasClass("is-invalid")) {//si hay una alerta de error solo elimina y pone una nueva
							$(".invalid-feedback").remove();
							$("#password").after('<span class="invalid-feedback" role="alert"><strong>'+jqXHR.responseJSON.errors.contraseña[0]+'</strong></span>');
							
						} else {// si no hay alertas agrega la clase de rror y la alerta
							$("#password").addClass('is-invalid')
							$("#password").after('<span class="invalid-feedback" role="alert"><strong>'+jqXHR.responseJSON.errors.contraseña[0]+'</strong></span>');
						}
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
					beforeSend: function(){
						$("[name='send']").hide();
					},
					success: function(data) {

						if (data[0] != 0) {
							// window.location.href = "/imprimir/"+idpersona; //no imprimir automaticamente
							//window.print();// formato anterior de impresion de pdf
							$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-success alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data[1]+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
							// $("[name='accion']").show();
							$("[name='rel']").show();
						} else {
							$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-danger alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data[1]+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						}

						setTimeout(function() { 
							$("#sccs").alert('close');
						}, 5000);       
					}, 
					error: function( jqXHR, textStatus, errorThrown){
						$("[name = 'send']").show();
						// console.log(jqXHR.responseJSON.errors.contraseña[0]);
						if ($("#password").hasClass("is-invalid")) {//si hay una alerta de error solo elimina y pone una nueva
							$(".invalid-feedback").remove();
							$("#password").after('<span class="invalid-feedback" role="alert"><strong>'+jqXHR.responseJSON.errors.contraseña[0]+'</strong></span>');
							
						} else {// si no hay alertas agrega la clase de rror y la alerta
							$("#password").addClass('is-invalid')
							$("#password").after('<span class="invalid-feedback" role="alert"><strong>'+jqXHR.responseJSON.errors.contraseña[0]+'</strong></span>');
						}
					}
				});
			});
		});
	</script>

	{{-- scrip de utilidades --}}
	<script>
		$(document).on('change', '#municipio',function(){ //busca las localidades y colonias cuando se cambia el select de municipio
			$.ajax({
				type: "get",
				url: "/utils/localidad",
				data: {
						'municipio':$("#municipio").val(),
						'localidad':$("#localidad").val(),
						'colonia':$("#colonia").val(),
						'from': $("#ntn").length
					},
				beforeSend: function(){
					$("#localidad").html('');
					$("#colonia").html('');
				}
			}).done(function(data) {
				$("#localidad").html(data[0]);
				$("#colonia").html(data[1]);
			}).fail(function(jqXHR, textStatus, errorThrown){
				alert('Ocurrio un error, cambie el municipio y vuelva a elegir el correcto');
			});
		});

		$(document).on('change', '#localidad',function(){ ////busca las colonias cuando se cambia el select de localidades
			$.ajax({
				type: "get",
				url: "/utils/colonia",
				data: {
						'localidad':$("#localidad").val(),
						'colonia':$("#colonia").val(),
						'from': $("#ntn").length
					},
				beforeSend: function(){
					$("#colonia").html('');
				}
			}).done(function(data) {
				$("#colonia").html(data);
			}).fail(function(jqXHR, textStatus, errorThrown){
				alert('Ocurrio un error, cambie la localidad y vuelva a elegir la correcta');
			});
		});
	</script>


	 {{--<script> //se utiliza para entregas
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
	</script> --}}


	<script>//reportes
		$(document).ready(function() {
			//ya esta cubierto el cambio de localidad y colnia en la parte de utilidades
			

			$('#centroent').off().change(function(){
				var centroent = $(this);
				if (centroent.val() == '') {
					$('#municipio').prop('disabled', false);
					$('#localidad').prop('disabled', false);
					$('#colonia').prop('disabled', false);
				} else { 
					$('#municipio').val('');
					$('#localidad').val('');
					$('#colonia').val('');
					$('#municipio').prop('disabled', true);
					$('#localidad').prop('disabled', true);
					$('#colonia').prop('disabled', true);
				}
			});
			
			$('#verentregados').off().click(function(e){
				// e.preventDefault();
				
				var sppiner = '<div class="text-center"></br></br><div class="spinner-border text-info" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div></div>';
				$('#stats').html('');

				$.ajax({
					type: "POST",
					url: "/admin2021/reporte/findReporte",
					data:{"_token": "{{ csrf_token() }}",
						"localidad":$('#localidad').val(),
						"colonia":$('#colonia').val(),
						"periodoent":$('#periodoent').val(),
						"donado":$('#donado').val(),
						"municipio":$('#municipio').val(),
						"centroent":$('#centroent').val()
						},
					beforeSend:function(){
						$('#reportecontenedor').html(sppiner);
					}
				}).done(function(data) {
						var reporte = "<br/><br/><h3>No se encontraron registros con la informacion proporcionada.<h3>";
						var mujeres = 0;
						var hombres = 0;
						var nobinario = 0
						var donados = 0;

						if(data != undefined){    
							if(data.length > 0 ){
								
								var reporte = '<br/><table class="table table-hover" id="reptable"><thead><tr class="table-info"><th>NOMBRE</th><th>CURP</th><th>MUNICIPIO</th><th>LOCALIDAD</th><th>COLONIA</th><th>DIRECCION</th><th>TELEFONO</th><th>FOLIO ENTREGA</th><th>ID ENTREGA</th><th>DONADO</th><th>PERIODO ENTREGA</th><th>CENTRO ENTREGA</th><th>ENTREGO</th><th>FECHA ENTREGA</th><th>OBSERVACION</th></tr></thead><tbody>';
									
								$.each(data, function(k, v) {
									reporte +='<tr>';
										reporte +='<td>'+(v['Nombre']!= null?v['Nombre']:"")+" "+(v['APaterno']!= null?v['APaterno']:"")+" "+(v['AMaterno']!= null?v['AMaterno']:"")+'</td>';
										reporte +='<td>'+(v['CURP']!= null?v['CURP']:"N/D")+'</td>';
										reporte +='<td>'+(v['municipio']!= null?v['municipio']:"N/D")+'</td>';
										reporte +='<td>'+(v['localidad']!= null?v['localidad']:"N/D")+'</td>';
										reporte +='<td>'+(v['colonia']!= null?v['colonia']:"N/D")+'</td>';
										reporte +='<td>'+(v['Manzana']!= null?"MZ."+v['Manzana']:"")+" "+(v['Lote']!= null?"LT."+v['Lote']:"")+" "+(v['Calle']!= null?"C."+v['Calle']:"")+" "+(v['NoExt']!= null?"N°Int."+v['NoExt']:"")+" "+(v['NoInt']!= null?"N°Ext."+v['NoInt']:"")+'</td>';
										reporte +='<td>'+(v['TelefonoCelular']!= null?v['TelefonoCelular']:"N/D")+'</td>';
										reporte +='<td>'+(v['folioEnt']!= null?v['folioEnt']:"N/D")+'</td>';
										reporte +='<td>'+(v['idEnt']!= null?v['idEnt']:"N/D")+'</td>';
										reporte +='<td>'+(v['Donado']!= null?(v['Donado']==1?'SI':'NO'):"N/D")+'</td>';
										reporte +='<td>'+(v['periodoentrega']!= null?v['periodoentrega']:"N/D")+'</td>';
										reporte +='<td>'+(v['centroentrega']!= null?v['centroentrega']:"N/D")+'</td>';
										reporte +='<td>'+(v['name']!= null?v['name']:"N/D")+'</td>';
																		

										if (v['fechaE']!= null) {
											var d = new Date(v['fechaE']);
											d = d.toLocaleString();
										} else {
											var d = "N/D";
										}
										
										reporte +='<td>'+d+'</td>';
										reporte +='<td>'+(v['comentario']!= null?v['comentario']:"N/D")+'</td>';

										reporte +='</tr>';

										if (v['sexo'] == 'M') {
											hombres++;
										} else if(v['sexo'] == 'F'){
											mujeres++;
										} else {
											nobinario++;
										}

										if (v['Donado']==1) {
											donados++;
										}
								});
								reporte +='</tbody></table>';
								$('#stats').html('<strong>Registros: </strong>'+data.length+'&nbsp;&nbsp;&nbsp;&nbsp;<strong>Donados: </strong>'+donados+'&nbsp;&nbsp;&nbsp;&nbsp;<strong>Mujeres: </strong>'+mujeres+'&nbsp;&nbsp;&nbsp;&nbsp;<strong>Hombres: </strong>'+hombres+'&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sin especificar: </strong>'+nobinario);

							} 
						} 
						$('#reportecontenedor').html(reporte);
						
						$('#reptable').DataTable({
							//  dom: 'frltp',
							dom: 'frltpB',
							pageLength: 15,
							lengthMenu: [15,30,50,100,200,500],
							sScrollY:"30em",
							sScrollX: "100%",  
							buttons: [{
								extend: 'excel',
								className: "btn btn-success",
								text: 'Exportar Reporte',
								title: '',
								filename: 'Reporte de Entregas',
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
				}).fail(function(jqXHR, textStatus, errorThrown){
				});
			});
			
			
		});
	</script>
	{{-- <script>//usuarios
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




	</script> --}}
</body>
</html>


