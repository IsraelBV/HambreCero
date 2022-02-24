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

							@if (Auth::user()->tipoUsuarioId == 0)
								@if (Route::has('register'))
									{{-- <li class="nav-item">
										<a class="nav-link" href="{{ route('usuarios2022') }}">{{ __('Usuarios') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
									</li> --}}
									<li class="nav-item">
										<a class="nav-link" href="{{ route('buscar2022') }}">{{ __('Entregas') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="{{ route('reporte2022') }}">{{ __('Reportes') }}&nbsp;&nbsp;&nbsp;&nbsp;</a>
									</li>
								@endif
							@endif
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->name }}
								</a>
								<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									@if (session()->has('centroEntrega'))
										<h5 class="dropdown-header"> {{__(session('centroEntregaNombre'))}}: {{__(session('NumeroDeEntregas'))}} </h5>
										<li>
											<hr class="dropdown-divider">
										</li>
									@endif
									@if (Auth::user()->tipoUsuarioId == 0)

										<h5 class="dropdown-header">
											CENTROS DE ENTREGA
										</h5>
										<li>
											<hr class="dropdown-divider">
										</li>
										<li>
											<a class="dropdown-item" href="#" id="addDespensas">{{ __('Agregar despensas') }}</a>
										</li>
										<li>
											<a class="dropdown-item" href="#" id="despensasTransfer">{{ __('Transferir despensas') }}</a>
										</li>

									@endif

									<li>
										<hr class="dropdown-divider">
									</li>
									<h5 class="dropdown-header">
										BUSCAR BENEFICIARIOS
									</h5>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li>
										<a class="dropdown-item" href="/2022/utils/buscarBeneficiario" >{{ __('Buscar') }}</a>
									</li>

									<li>
										<hr class="dropdown-divider">
									</li>
									<li class="dropdown-item" href="{{ route('logout') }}"
									   onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
										{{ __('Cerrar sesion') }}
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf
										</form>
									</li>
								</ul>
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
						url: "/2022/registro/Entrega/solicitar/"+$("#ntn").data('persona'),
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
					url: "/2022/documentacion/edit",
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
							url: "/2022/documentacion/delete/"+delbtn.data('docname'),//se manda el nombre del documento
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
							url: "/2022/documentacion/update/"+folio,
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
					url: "/2022/entrega/enUpdate",
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
							url: "/2022/entrega/enUpdate/"+folio,
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
					url: "/2022/entrega/enUpdatePost",
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
							url: "/2022/entrega/enUpdate/"+folio,
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

			$(document).on('click', '#addDespensas',function(){// abre el modal para aumentar despensas

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
						url: "/2022/catalogo/stock/update",
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

			$(document).on('click', '#despensasTransfer',function(){// abre el modal para transferir despensas

				$.ajax({
				type: "GET",
				url: "/2022/catalogo/stock/update/centrose/0"
				}).done(function(data) {

					var optionsCEString = "";
					$.each(data[0], function(k, v) {
						optionsCEString +='<option value="'+v['id']+'">'+v['Descripcion']+'</option>';

					});

					$cuerpo_modal = '<form id="stockTransfer" action="" method="">'+
										'<div class="form-row">'+
												'<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
												// '<input type="hidden" name="_method" value="PUT">'+
											'<div class="form-group col-md-5">'+
												'<label for="CEOrigen">Centro entrega origen:</label>'+
												'<select name="CEOrigen" id="CEOrigen" class="form-control" required="">'+
													'<option selected value="">seleccione una opcion...</option>'+
													optionsCEString+
												'</select>'+
											'</div>'+
											'<div class="form-group col-md-2">'+
												'<label for="despensasTransferinput">Cantidad</label>'+
												'<input type="number" name="despensasTransferinput" class="form-control" id="despensasTransferinput" placeholder="0" required="">'+
											'</div>'+
											'<div class="form-group col-md-5">'+
												'<label for="CEDestino">Centro entrega Destino:</label>'+
												'<select name="CEDestino" id="CEDestino" class="form-control" required="">'+
													'<option selected value="">seleccione una opcion...</option>'+
													// optionsCEString+
													// '<option value=""></option>'+
												'</select>'+
											'</div>'+
										'</div>'+
									'</form>';

					$("#modalMultiuso .modal-dialog").addClass('modal-lg');//<---------
					$("#modalMultiuso .modal-header .modal-title").html('Transferir Despensas');
					$("#modalMultiuso .modal-body").html($cuerpo_modal);
					$("#modalMultiuso .modal-footer .savemdl").attr('form','stockTransfer');

					$("#modalMultiuso").modal('show');

					$("#CEOrigen").change(function(){
						$.ajax({
							type: "GET",
							url: "/2022/catalogo/stock/update/centrose/"+this.value,
						}).done(function(data) {

							var optionsCEString = '<option selected value="">seleccione una opcion...</option>';
							$.each(data[0], function(k, v) {
								optionsCEString +='<option value="'+v['id']+'">'+v['Descripcion']+'</option>';
							});

							$("#CEDestino").html(optionsCEString);
							$("#despensasTransferinput").attr('max',data[1][0].stockDespensas);

						}).fail(function(jqXHR, textStatus, errorThrown){
							alert('2: Ocurrio un error al transferir stock, favor de reportarlo');
						});
					});

					$('#stockTransfer').off().submit(function(e){
						e.preventDefault();

						$.ajax({
							type: "POST",
							url: "/2022/catalogo/stock/update/transferencia",
							data: $("#stockTransfer").serialize(),
							beforeSend: function(){
								$("#modalMultiuso").modal('hide');//se cierra el modal

								$("#modalMultiuso .modal-dialog").removeClass('modal-lg');
								$("#modalMultiuso .modal-header .modal-title").html('');
								$("#modalMultiuso .modal-body").html('');
								$("#modalMultiuso .modal-footer .savemdl").removeAttr('form');
							}
						}).done(function(data) {
							if (data == 1) {
								location.reload();
							} else if (10) {
								alert('Ocurrio un error al actualizar el stock de los 2 centros de entrega, favor de reportarlo');
							} else if (11) {
								alert('Ocurrio un error al actualizar el stock del centro de entrega origen, favor de reportarlo');
							} else{
								alert('Ocurrio un error al actualizar el stock del centro de entrega destino, favor de reportarlo');
							}
						}).fail(function(jqXHR, textStatus, errorThrown){
							alert('3: Ocurrio un error al transferir el stock, favor de reportarlo');
						});

					});

				}).fail(function(jqXHR, textStatus, errorThrown){
					alert('1: Ocurrio un error al transferir stock, favor de reportarlo');
				});




			});

			$("#passpersonacreate").off().submit(function(e) { //cambia la contraseña de la persona
				e.preventDefault();

				$.ajax({
					type: "POST",
					url: "/2022/registro/pass/"+$("#passpersonacreate").data("user"),
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

			$("#findpersonaParcial").off().submit(function(e) { //busca a las personas
                e.preventDefault();

                $.ajax({
                    type: "get",
                    url: "/2022/utils/buscarBeneficiario/coincidencia",
                    data: $("#findpersonaParcial").serialize(),
                    success: function(data) {

                        $("#personasContenedor").html(data);

						$('#personasCoincidencia').DataTable({
							dom: 'frltp',
							pageLength: 10,
							lengthMenu: [10,20,30,50],
							// sScrollY:"30em",
							// sScrollX: "100%",
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

			$("#encuesta").off().submit(function(e) { //envia los datos para registro
				e.preventDefault();

				$.ajax({
					type: "POST",
					url: "/2022/registro",
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
								window.location.href = "/2022/registro";
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
					url: "/2022/registro/"+idpersona,
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
				url: "/2022/utils/localidad",
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
				url: "/2022/utils/colonia",
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


	 <script> //se utiliza para entregas
		$(document).ready(function() {

			$("#entregaupdate2022").off().submit(function(e) { //envia los datos para actualizar una entrega abierta en la lista de entregas
				e.preventDefault();

				var identrega = $("#hid").data('entrega');

				$.ajax({
					type: "PUT",
					url: "/admin2022/entrega/"+identrega,
					data: $("#entregaupdate2022").serialize()
				}).done(function(data) {
					$("[name='sendUpdateEntrega']").hide();
						$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-success alert-dismissible fade show" role="alert"> <h3 class="alert-heading">'+data+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						// $("[name='accion']").show();
						// $("[name='rel']").show();

						setTimeout(function() {
							$("#sccs").alert('close');
							window.close();
						}, 5000);
				}).fail(function(jqXHR, textStatus, errorThrown){
					$("[name='sendUpdateEntrega']").hide();
						$("body").append('<div style="position: fixed; top: 15%; right: 30px;" id="sccs" class="alert alert-danger alert-dismissible fade show" role="alert"> <h3 class="alert-heading">Por favor tomar captura y reportar el error <br> Status: '+ textStatus+' Error: ' + errorThrown+'</h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				});
			});

		});
	</script>


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
					url: "/admin2022/reporte/findReporte",
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

	<script>//centros de entrega

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
			//         url: "/2022/registro/"+idpersona,
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


