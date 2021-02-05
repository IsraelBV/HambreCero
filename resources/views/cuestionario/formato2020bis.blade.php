<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <style>
            
            html {
                margin-left: 69pt;
                margin-right: 58pt;
                margin-bottom: 15pt;
            }

            body{
                font: sans-serif;
                font-size: 10.8;
                padding-top: 80;
            }
            
            #headerimg{
                position: absolute;
                width: 8.05in;
                top: -13;
                left: -52;
            }
        </style>
    </head>
    <body>
        
        <img id="headerimg" src="{{public_path('img/logo_formato3.jpg')}}">
        <!--Datos Personales-->
        
                    <h4 style='text-align: center;margin:0;'>
                        ANEXO 15<br>
                        PROGRAMA JUNTOS AVANZAMOS<br>
                        MODALIDAD APOYO ALIMENTARIO<br>
                        SOLICITUD DE APOYO ALIMENTARIO
                    </h4>
                    <br>
                    <p style='text-align: left;font-weight: bold;margin-top:20;'>
                        MTRA. ROCIO MORENO MENDOZA.<br>
                        ENCARGADA DE LA SECRETARÍA.<br>
                        PRESENTE:
                    </p>

                    <p style='text-align: right;'> 
                    @if ($persona[0]->LocalidadId != null)
                            @foreach ($localidades as $localidad)
                                @if ($localidad->id == $persona[0]->LocalidadId)
                                    {{$localidad->Descripcion}},
                                    @break
                                @endif
                            @endforeach
                        @endif Q. Roo a {{strftime("%e de %B de %Y")}}</p>
                    <p style='text-align: right; margin-top:25;'>ASUNTO: Solicitud de Apoyo <br> APOYO SOLICITADO: Paquete Alimentario</p>
                    
                    <p style='text-align: justify;line-height: 1.7; margin-top:20;'>

                        El que suscribe la presente C. {{ $persona[0]->Nombre != null?$persona[0]->Nombre:"" }} {{ $persona[0]->APaterno != null?$persona[0]->APaterno:"" }} {{ $persona[0]->AMaterno != null?$persona[0]->AMaterno:'' }},
                        nacido(a) el día {{ $persona[0]->FechaNacimiento != null?strftime("%e del mes de %B del año %Y", strtotime($persona[0]->FechaNacimiento)):'' }} en la
                        localidad de {{ $persona[0]->CiudadNacimiento != null?$persona[0]->CiudadNacimiento:''}} del Estado de
                        @if ($persona[0]->EstadoNacimientoId != null)
                            @foreach ($estados as $estado)
                                @if ($estado->id == $persona[0]->EstadoNacimientoId)
                                    {{$estado->Descripcion}}
                                @endif
                            @endforeach
                        @endif con CURP {{ $persona[0]->CURP != null?$persona[0]->CURP:'' }}, 
                        estado civil 
                        @if ($persona[0]->EstadoCivilId != null)
                            @foreach ($estadosCiviles as $estadocivil)
                                @if ($estadocivil->id == $persona[0]->EstadoCivilId)
                                    {{$estadocivil->Descripcion}}
                                    @break
                                @endif
                            @endforeach
                        @endif 
                        y con domicilio en @if ($persona[0]->ColoniaId != null)
                            @foreach ($colonias as $colonia)
                                @if ($colonia->id == $persona[0]->ColoniaId)
                                    {{$colonia->Descripcion}}
                                    @break
                                @endif
                            @endforeach
                        @endif
                        {{ $persona[0]->Calle != null?'Calle: '.$persona[0]->Calle:'' }} {{ $persona[0]->Manzana != null?'Mz.'.$persona[0]->Manzana:'' }} {{ $persona[0]->Lote != null?'Lt.'.$persona[0]->Lote:'' }} {{ $persona[0]->NoExt != null?'NoExt: '.$persona[0]->NoExt:'' }} {{ $persona[0]->NoInt != null?'NoInt: '.$persona[0]->NoInt:'' }}
                         de la localidad de
                        @if ($persona[0]->LocalidadId != null)
                            @foreach ($localidades as $localidad)
                                @if ($localidad->id == $persona[0]->LocalidadId)
                                    {{$localidad->Descripcion}}
                                    @break
                                @endif
                            @endforeach
                        @endif
                        , Municipio de  @if ($persona[0]->MunicipioId != null)
                            @foreach ($municipios as $municipio)
                                @if ($municipio->id == $persona[0]->MunicipioId)
                                    {{$municipio->Descripcion}}
                                    @break
                                @endif
                            @endforeach
                        @endif
                        , me dirijo a usted, para
                        solicitarle su invaluable apoyo, a efecto que se me considere en el <strong>“PROGRAMA JUNTOS
                        AVANZAMOS”</strong> en la Modalidad de Apoyo Alimentario con la Acción Hambre Cero y sea beneficiado
                        (a) con Un (1) Paquete Alimentario, que atinadamente se desarrolla en nuestra Comunidad con el
                        objetivo de contribuir al mejoramiento de la calidad de vida de la población.<br><br>
                        Sin otro particular, aprovecho la ocasión para saludarlo cordialmente y enviarle un afectuoso saludo.
                    </p>

                    <p style='text-align: center;font-weight: bold;'>ATENTAMENTE:</p>
                    <br>
                    <p style='text-align: center;'>_______________________________ <br> FIRMA</p>
                    <br>
                    <br>
            <!--fin de card body-->
            <!--fin de instrumentos de factores de riesgo-->
        <!--FIN  FACTORES DE RIESGO-->

            <p style='font-size: 7.6;'>Este programa utiliza recursos públicos y es ajeno a cualquier partido político. Queda prohibido el uso para fines distintos al desarrollo social. Quien haga uso indebido de los recursos de este programa deberá ser denunciado y sancionado conforme lo dispone la ley de la materia Los datos personales recabados, serán protegidos de acuerdo a lo establecido en la Ley General de Protección de Datos Personales en Posesión de los Sujetos Obligados y la Ley de Protección de Datos Personales Posesión de Sujetos Obligados para el Estado de Quintana Roo.</p>
    </body>
</html>