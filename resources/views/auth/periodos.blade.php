@extends('layoutlogin')

@section('contentlogin')
 
    <form action="/redirectPeriodo" method="POST">
        @csrf
        <div class="form-row">
            
            <div class="form-group col-md-4">

                <h1>DATOS</h1>

                <select class="form-control" name="periodo" class="form-control" required> {{--@error('periodo') is-invalid @enderror --}}
                    <option value="" selected>Seleccione un periodo</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{$periodo->id}}">{{$periodo->Descripcion}}</option>
                    @endforeach
                </select>
                {{-- @error('periodo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
                
                <br>

                <select class="form-control" name="centroe" class="form-control" required> {{--@error('centroe') is-invalid @enderror --}}
                    <option value="" selected>Seleccione un centro de entrega</option>
                    @foreach ($centros as $centro)
                        <option value="{{$centro->id}}">{{$centro->Descripcion}}</option>
                    @endforeach
                </select>
                {{-- @error('centroe')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  --}}
            </div>
                
                
        </div>
        
        <button type="submit" class="btn btn-info"><strong>Aceptar</strong></button>
    </form>

@endsection