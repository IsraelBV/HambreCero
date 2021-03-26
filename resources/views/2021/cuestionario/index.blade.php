@extends('2021.layouts.app')

@section('content')
  
    <div class="container"> 
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <img src="{{asset('img/logo_nesesidades2021.jpeg')}}" class="img-fluid img-thumbnail">
            </div>
        </div>
    </div>

    <br><br>
    
    
    <form id="findpersona" action="/findPersona" method="POST">
        @csrf

        <div id="findcurp" class="form-row">
            <div class="form-group col-md-12 text-center">
                <label for="curp" style="font-weight: bold; font-size: 18pt; text-align: center">Ingrese su CURP (18 caracteres)</label>
                <!-- <label for="curp" style="font-weight: bold; font-size: 18pt; text-align: center">CURP</label> -->
                <input type="text" @isset($curp) value="{{$curp}}" @endisset class="form-control" id="curp" name="curp" onkeyup="mayusculas(this);" required>
            </div>
            <div class="form-group col-md-12 text-center">
                <label for="pass" style="font-weight: bold; font-size: 18pt; text-align: center">Ingrese una contraseña provisional</label>
                <!-- <label for="pass" style="font-weight: bold; font-size: 18pt; text-align: center">CONTRASEÑA</label> -->
                <input id="pass" type="password" class="form-control" name="pass" required>
            </div>
        </div>
        
        <button type="submit" name="findpersona" class="btn btn-info col-md-2 offset-md-5 col-sm-4 offset-sm-4 col-12 "><strong>Buscar</strong></button>
    </form>
    

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
