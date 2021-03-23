@extends('2021.layouts.app')

@section('content')
    <h2 class="col-6 offset-md-3">BUSCAR CURP PARA ENTREGA</h2>
    <br>
    <br>
    <form id="findentrega" action="" method="">
        @csrf

        <div class="form-row">
            <div class="col-6 offset-md-3">

                <label for="curp">CURP</label>
                <div class="input-group">
                        <input required type="text" class="form-control" id="curp" name="curp" onkeyup="mayusculas(this); ">
                        <div class="input-group-prepend">
                            <button type="submit" name="findfirst" class="btn btn-info"><strong>Buscar</strong></button>
                        </div>
                </div> 
            </div>
        </div>
        
    </form>

    <div class="container" id="entregaContenedor"></div>

    <div class="modal fade" id="entregadoModal" tabindex="-1" role="dialog" aria-labelledby="entregadoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="entregadoModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-btn="cpt">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-btn="cnl">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


@endsection