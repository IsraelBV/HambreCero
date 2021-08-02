@extends('2021.layouts.app')

@section('content')
    
    <div class="container"> 
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <img src="{{asset('img/logo_nesesidades2021.jpeg')}}" class="img-fluid img-thumbnail">
            </div>
        </div>
    </div>
    @guest
        <br><br> 
        {{-- // mensaje de veda electoral se retiro el 07/06/2021 --}}
        {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                -- <h4 align="justify">Con fundamento en los artículos 41, fracción III, apartado C y 134, párrafos séptimo y octavo de la Constitución Política de los Estados Unidos Mexicanos; 209, numeral 1 y 449, numeral 1, incisos c) y e) de la Ley General de Instituciones y Procedimientos Electorales; 49 fracción III, numeral 6, segundo párrafo, 160 fracción IV, 166 y 166 BIS de la Constitución Política del Estado Libre y Soberano de Quintana Roo; 290 tercer y cuarto párrafo, 293 tercer párrafo, 394 fracción VI y 400 de la Ley de Instituciones y Procedimientos Electorales para el Estado de Quintana Roo; 5, 7 y II de la Ley General en Materia de Delitos Electorales, <strong>el registro al programa Hambre Cero Quintana Roo ha quedado suspendido temporalmente</strong> desde el día 4 de abril con el propósito de cumplir estrictamente con la legislación en materia electoral durante el periodo en que se lleven a cabo las campañas electorales. Para mayor información respecto al programa visite: <a href="https://qroo.gob.mx/sedeso/hambreceroquintanaroo">https://qroo.gob.mx/sedeso/hambreceroquintanaroo</a></h4> <== anterior --
                <h4 align="justify">El contenido de este sitio ha sido modificado temporalmente durante el periodo comprendido del 15 de julio al primero de agosto de 2021, en atención a las disposiciones legales con motivo de la consulta popular a cargo del Instituto Nacional Electoral.</h4>
                <h4 align="left">Para mayor información respecto al programa visite: <a href="https://qroo.gob.mx/sedeso/hambreceroquintanaroo">https://qroo.gob.mx/sedeso/hambreceroquintanaroo</a></h4>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> --}}
    
        <form id="findpersona" action="/findPersona" method="POST">
            @csrf
            <div id="findcurp" class="form-row">
                <div class="form-group col-md-12 text-center">
                    <label for="curp" style="font-weight: bold; font-size: 18pt; text-align: center">Ingrese su CURP (18 caracteres)</label>
                    <!-- <label for="curp" style="font-weight: bold; font-size: 18pt; text-align: center">CURP</label> -->
                    <input type="text" @isset($curp) value="{{$curp}}" @endisset class="form-control" id="curp" name="curp" onkeyup="mayusculas(this);" required>
                </div>
                <div class="form-group col-md-12 text-center" @if(!isset($verify)) style="display:none" @endif>
                    <label for="pass" style="font-weight: bold; font-size: 18pt; text-align: center">Ingrese una contraseña provisional</label>
                    <!-- <label for="pass" style="font-weight: bold; font-size: 18pt; text-align: center">CONTRASEÑA</label> -->
                    <input id="pass" type="password" class="form-control" @isset($verify) name="pass" @endisset >
                    <a href="#" data-toggle="modal" data-target="#passforgotmodal">Olvide mi contraseña</a>
                </div>
            </div>
            
            <button type="submit" class="btn btn-info col-md-2 offset-md-5 col-sm-4 offset-sm-4 col-12 "><strong>Buscar</strong></button>
        </form>
        
    @else

        <br><br>

        <form id="findpersona" action="/findPersona" method="POST">
            @csrf

            <div id="findcurp" class="form-row">
                <div class="form-group col-md-12 text-center">
                    <label for="curp" style="font-weight: bold; font-size: 18pt; text-align: center">CURP</label>
                    <input type="text" @isset($curp) value="{{$curp}}" @endisset class="form-control" id="curp" name="curp" onkeyup="mayusculas(this);" required>
                </div>
            </div>
            
            <button type="submit" name="findpersona" class="btn btn-info col-md-2 offset-md-5 col-sm-4 offset-sm-4 col-12 "><strong>Buscar</strong></button>
        </form>
    
    @endguest

    

    @isset($errmsg)
        <div style="position: fixed; top: 15%; right: 30px;" class="alertDefault alert alert-danger alert-dismissible fade show" role="alert"> 
            <label class="alert-heading" style="font-weight: bold; font-size: 14pt;">
                    {{$errmsg}}
            </label>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endisset
    @isset($scssmsg)
        <div style="position: fixed; top: 15%; right: 30px;" class="alertDefault alert alert-success alert-dismissible fade show" role="alert"> 
            <label class="alert-heading" style="font-weight: bold; font-size: 14pt;">
                    {{$scssmsg}}
            </label>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endisset


    <div id="passforgotmodal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Recuperar contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="passforgotform" action="/registro/passlost" method="POST">
                        <div class="form-group">
                            @csrf
                          <label for="phone">Ingrese el numero de telefono que registro:</label>
                          <input type="text" name="phone" class="form-control" id="phone" placeholder="">
                          <input type="hidden" name="persona" @isset($curp) value="{{$curp}}" @endisset>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="passforgotform" class="btn btn-primary">Enviar</button>
                  </div>
            </div>
        </div>
    </div>

    {{-- <div id="modal_alerta" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{asset('img/ventana emergente.png')}}" class="img-fluid img-thumbnail">
                </div>
            </div>
        </div>
    </div> --}}

@endsection
