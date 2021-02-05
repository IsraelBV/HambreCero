<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <style>
            html {
                margin: 30pt 15pt;
            }
            h4{
                text-align: center;
                text-transform: uppercase;
                width: 7.5in;
                margin-top: 1.2em;
                margin-bottom: .7em;
            }
            body{
                font-size: .6em;
            }
            p{ 
                margin-bottom: .1em;
                margin-top: .1em;
                margin-right: 0.1in; 
                margin-left: 0.1in; 
                line-height: 100%;
            } 
            p.espp2{
                font-size: 1.2em !important;
            }
            p:not(.espp){ 
                width: auto;
            }
            p.espp{
                width: auto;
            }
            .divcont{
                clear:both; 
                position:relative;
            }
            .diviz{
                position: absolute; 
                left: 0pt; 
                width: 3.8in;
                /* background-color: brown; */
            }
            .divder{
                margin-left:4in;
                width: 3.8in;
                /* background-color: aqua; */
            }
            #headerimg{
                margin-left: .45in;
                width: 6.5in;
                max-width: 100%;
            }
            /* .cardsd {
                width: auto;
            } */
            input[type="radio"] {
                vertical-align: bottom;
                transform: scale(0.5);
                margin: 0;
            }
            input[type="checkbox"]{
                vertical-align: bottom;
                transform: scale(0.7);
                margin: 0;
            }
        </style>
    </head>
    <body>
        
        <img id="headerimg" src="{{public_path('img/logo_nesesidades2.jpg')}}">
        <!--Datos Personales-->
           
        <h4>DATOS PERSONALES</h4>
            <div class="divcont" >
                <div class="diviz" >

                    <p><strong>{{ $preguntas[0]['Descripcion'] }}:</strong> {{ $persona[0]->Nombre != null?$persona[0]->Nombre:"" }} </p>
                    
                    <p><strong>{{ $preguntas[1]['Descripcion'] }}:</strong> {{ $persona[0]->APaterno != null?$persona[0]->APaterno:"" }}</p> 
                    
                    <p><strong>{{ $preguntas[2]['Descripcion'] }}:</strong> {{ $persona[0]->AMaterno != null?$persona[0]->AMaterno:'' }}</p> 
                
                    <p><strong>{{ $preguntas[3]['Descripcion'] }}:</strong> {{ $persona[0]->CURP != null?$persona[0]->CURP:'' }}</p>
                    
                    <p><strong>{{ $preguntas[4]['Descripcion'] }}:</strong> {{ $persona[0]->RFC != null?$persona[0]->RFC:'' }}</p>
                    
                    <p><strong>{{ $preguntas[5]['Descripcion'] }}:</strong> {{ $persona[0]->ClaveElector != null?$persona[0]->ClaveElector:'' }}</p>
                    
                    <p><strong>{{ $preguntas[6]['Descripcion'] }}:</strong> {{ $persona[0]->IdentificacionMigratoria != null?$persona[0]->IdentificacionMigratoria :'' }}</p>
                    
                    {{-- <p>Grupo Social: 
                        @if ($persona[0]->GrupoSocialId != null)
                            @foreach ($gruposociales as $gruposocial)
                                @if ($gruposocial->id == $persona[0]->GrupoSocialId)
                                    {{$gruposocial->Descripcion}}
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </p> --}}
                    
                    <p><strong>Estado Civil: </strong>
                        @if ($persona[0]->EstadoCivilId != null)
                            @foreach ($estadosCiviles as $estadocivil)
                                @if ($estadocivil->id == $persona[0]->EstadoCivilId)
                                    {{$estadocivil->Descripcion}}
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </p>
                       
                    <!-- Fila 3-->
                    
                    <p><strong>{{ $preguntas[7]['Descripcion'] }}:</strong> {{ $persona[0]->Sexo != null?($persona[0]->Sexo == 'M'?'MASCULINO':'FEMENINO'):''}}</p>
                        
                    <p><strong>{{ $preguntas[8]['Descripcion'] }}:</strong> {{ $persona[0]->CiudadNacimiento != null?$persona[0]->CiudadNacimiento:''}}</p>
                    
                    <p><strong>{{ $preguntas[9]['Descripcion'] }}:</strong> 
                        @if ($persona[0]->EstadoNacimientoId != null)
                            @foreach ($estados as $estado)
                                @if ($estado->id == $persona[0]->EstadoNacimientoId)
                                    {{$estado->Descripcion}}
                                @endif
                            @endforeach
                        @endif
                    </p>

                    <!-- Fin de Fila 3-->
                    <!--fila4-->
                   
                    <p><strong>{{ $preguntas[10]['Descripcion'] }}:</strong> {{ $persona[0]->FechaNacimiento != null?$persona[0]->FechaNacimiento:'' }}</p>

                    <p><strong>{{ $preguntas[11]['Descripcion'] }}:</strong> 
                        @if ($persona[0]->GradoEstudiosId != null)
                            @foreach ($estudios as $estudio)
                                @if ($estudio->id == $persona[0]->GradoEstudiosId)
                                    {{$estudio->Descripcion}}
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </p>

                    <p><strong>{{ $preguntas[12]['Descripcion'] }}:</strong>
                        @if ($persona[0]->ColoniaId != null)
                            @foreach ($colonias as $colonia)
                                @if ($colonia->id == $persona[0]->ColoniaId)
                                    {{$colonia->Descripcion}}
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </p>
                    <!--fin fila 4-->
                    <!--fila5-->
                    <p><strong>{{ $preguntas[13]['Descripcion'] }}:</strong> {{ $persona[0]->Calle != null?$persona[0]->Calle:'' }}</p>
                </div>
                <div class="divder">
                    <p><strong>{{ $preguntas[14]['Descripcion'] }}:</strong> {{ $persona[0]->Manzana != null?$persona[0]->Manzana:'' }}</p>
                    <p><strong>{{ $preguntas[15]['Descripcion'] }}:</strong> {{ $persona[0]->Lote != null?$persona[0]->Lote:'' }}</p>
                    <p><strong>{{ $preguntas[16]['Descripcion'] }}:</strong> {{ $persona[0]->NoExt != null?$persona[0]->NoExt:'' }}</p>
                    <p><strong>{{ $preguntas[17]['Descripcion'] }}:</strong> {{ $persona[0]->NoInt != null?$persona[0]->NoInt:'' }}</p>
                    <!--fin fila 5-->
                    <!--Fila 6-->
                    <p><strong>{{ $preguntas[18]['Descripcion'] }}:</strong> {{ $estados[22]['Descripcion'] }}</p>
                    <p><strong>{{ $preguntas[19]['Descripcion'] }}:</strong> 
                        @if ($persona[0]->MunicipioId != null)
                            @foreach ($municipios as $municipio)
                                @if ($municipio->id == $persona[0]->MunicipioId)
                                    {{$municipio->Descripcion}}
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </p>
                    <p><strong>{{ $preguntas[20]['Descripcion'] }}:</strong> 
                        @if ($persona[0]->LocalidadId != null)
                            @foreach ($localidades as $localidad)
                                @if ($localidad->id == $persona[0]->LocalidadId)
                                    {{$localidad->Descripcion}}
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </p>
                    <p><strong>{{ $preguntas[21]['Descripcion'] }}:</strong> {{ $persona[0]->CP != null?$persona[0]->CP:'' }}</p>
                    <!-- fin fila 6-->
                    <!--FILA 7-->
                    <p><strong>{{ $preguntas[22]['Descripcion'] }}:</strong> {{ $persona[0]->TelefonoCelular != null?$persona[0]->TelefonoCelular:'' }}</p>
                    <p><strong>{{ $preguntas[23]['Descripcion'] }}:</strong> {{ $persona[0]->TelefonoCasa != null?$persona[0]->TelefonoCasa:'' }}</p>
                    <p><strong>{{ $preguntas[24]['Descripcion'] }}:</strong> {{ $persona[0]->Email != null?$persona[0]->Email:'' }}</p>
                    <!-- FIN DE FILA 7-->
                    <!--fila 8-->
                    <p><strong>{{ $preguntas[25]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_26 == 1?'checked':'' }}>
                        No <input type="radio" {{ $persona[0]->Pregunta_26 === 0?'checked=':'' }}>
                    </p>
                    
                        <!-- fin fila 8-->
                        <!--fila9-->
                        <p><strong>{{ $preguntas[26]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_27 != null?$persona[0]->Pregunta_27:'' }}</p>
                    <!--fin fila 9-->
                </div>
            </div>
            <!--fin de datos personales-->
            <!--informacion familiar y de vicienda-->
            <h4 >INFORMACIÓN FAMILIAR Y VIVIENDA</h4>
            <div class="divcont" >
                <div class="diviz" >
    
                    <p><strong>{{ $preguntas[27]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_28 == 1?'checked':'' }}> 
                        No <input type="radio" {{ $persona[0]->Pregunta_28 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[28]['Descripcion'] }}:</strong>
                        Sí <input type="radio" {{ $persona[0]->Pregunta_29 == 1?'checked':'' }}> 
                        No <input type="radio" {{ $persona[0]->Pregunta_29 === 0?'checked':'' }}>
                    </p>
                    <!-- fin de fila 1-->
                    <p><strong>{{ $preguntas[29]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_30 != null?$persona[0]->Pregunta_30:''}}</p>
                    <p><strong>{{ $preguntas[30]['Descripcion'] }}:</strong> <br>
                        Sí <input type="radio" {{ $persona[0]->Pregunta_31 == 1?'checked':'' }}>
                        No <input type="radio" {{ $persona[0]->Pregunta_31 === 0?'checked':'' }}>
                                
                    <!-- fin de fila2-->
                    <p><strong>{{ $preguntas[31]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_32 != null?$persona[0]->Pregunta_32:''}}</p>
                    <p><strong>{{ $preguntas[32]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_33 != null?$persona[0]->Pregunta_33:''}}</p>
                    
                    <!--fin de fila 3-->
                    <p><strong>{{ $preguntas[33]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_34 != null?$persona[0]->Pregunta_34:''}}</p>
                    <p><strong>{{ $preguntas[34]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_35 != null?$persona[0]->Pregunta_35:''}}</p>
                    <!--fin de fila 4-->
                    <p><strong>{{ $preguntas[35]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_36 != null?$persona[0]->Pregunta_36:''}}</p>
                        
                    <p><strong>{{ $preguntas[36]['Descripcion'] }}:</strong> 
                        si ¿cuantos?: {{ !empty($persona[0]->Pregunta_37)?(strpos($persona[0]->Pregunta_37,'#')!== false?explode("#",$persona[0]->Pregunta_37)[0]:0):0}}
                        no ¿cuantos?: {{!empty($persona[0]->Pregunta_37)?(strpos($persona[0]->Pregunta_37,'#')!== false?explode("#",$persona[0]->Pregunta_37)[1]:$persona[0]->Pregunta_37):0}}
                    </p>
                    <!--fin de fila 5-->
                    <p><strong>{{ $preguntas[37]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_38 != null?$persona[0]->Pregunta_38:''}}</p>
                    <p><strong>{{ $preguntas[38]['Descripcion'] }}:</strong>
                        Sí <input type="radio" {{ $persona[0]->Pregunta_39 == 1?'checked':'' }}>
                        No <input type="radio" {{ $persona[0]->Pregunta_39 === 0?'checked':'' }}>
                    <p><strong>{{ $preguntas[39]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_40 != null?$persona[0]->Pregunta_40:''}}</p>
                    <!--fila 6-->
                    <p><strong>{{ $preguntas[40]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_41 != null?$persona[0]->Pregunta_41:''}}</p>
                    <p><strong>{{ $preguntas[41]['Descripcion'] }}:</strong> 
                            Sí <input type="radio" {{ $persona[0]->Pregunta_42 == 1?'checked':'' }}>
                            No <input type="radio" {{ $persona[0]->Pregunta_42 === 0?'checked':'' }}>
                    </p>
                        <!--fila 7-->
                    <p><strong>{{ $preguntas[42]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_43 != null?$persona[0]->Pregunta_43:''}}</p>
                    <p><strong>{{ $preguntas[43]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_44 != null?$persona[0]->Pregunta_44:''}}</p>
                    <p><strong>{{ $preguntas[44]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_45 != null?$persona[0]->Pregunta_45:''}}</p>
                    <!--Fila 8-->
                    <p><strong>{{ $preguntas[45]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_46 != null?$persona[0]->Pregunta_46:''}}</p>
                    <p><strong>{{ $preguntas[46]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_47 == 1?'checked':'' }}> 
                        No <input type="radio" {{ $persona[0]->Pregunta_47 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[47]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_48 == 1?'checked':'' }}>
                        No <input type="radio" {{ $persona[0]->Pregunta_48 === 0?'checked':'' }}>
                    </p>
                </div>
                <div class="divder">
                    <!--fila 9-->
                    <p><strong>{{ $preguntas[48]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_49 == 1?'checked':'' }}>                               
                        No <input type="radio" {{ $persona[0]->Pregunta_49 === 0?'checked':'' }}>                                
                    </p>
                    <p><strong>{{ $preguntas[49]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_50 == 1?'checked':'' }}> 
                        No <input type="radio" {{ $persona[0]->Pregunta_50 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[50]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_51 == 1?'checked':'' }}> 
                        No <input type="radio" {{ $persona[0]->Pregunta_51 === 0?'checked':'' }}>
                        </p>
                    <p><strong>{{ $preguntas[51]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_52 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_52 === 0?'checked':'' }}>
                    </p>
                    <!--fila 10-->
                    <p><strong>{{ $preguntas[52]['Descripcion'] }}:</strong>
                        Sí <input type="radio" {{ $persona[0]->Pregunta_53 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_53 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[53]['Descripcion'] }}:</strong>
                        Sí <input type="radio"{{ $persona[0]->Pregunta_54 == 1?'checked':'' }}>
                        No <input type="radio"{{ $persona[0]->Pregunta_54 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[54]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_55 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_55 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[55]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_56 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_56 === 0?'checked':'' }}>
                    </p>
                    <!--fila11-->
                    <p><strong>{{ $preguntas[56]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_57 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_57 === 0?'checked':'' }}>                                    
                    </p>
                    <p><strong>{{ $preguntas[57]['Descripcion'] }}:</strong> 
                        Sí <input id="si18" class="form-check-input" type="radio" name="automovil" value="1" {{ $persona[0]->Pregunta_58 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input id="no18" class="form-check-input" type="radio" name="automovil" value="0" {{ $persona[0]->Pregunta_58 === 0?'checked':'' }}>
                    </p>
                    <p> <strong>{{ $preguntas[58]['Descripcion'] }}:</strong> <br/>
                        <input type="checkbox" {{ in_array($materiales[0]['id'],explode("#",$persona[0]->Pregunta_59))?'checked':'' }} /> {{ $materiales[0]['Descripcion'] }} <br/>
                        <input type="checkbox" {{ in_array($materiales[2]['id'],explode("#",$persona[0]->Pregunta_59))?'checked':'' }} /> {{ $materiales[2]['Descripcion'] }} <br/>
                        <input type="checkbox" {{ in_array($materiales[1]['id'],explode("#",$persona[0]->Pregunta_59))?'checked':'' }} /> {{ $materiales[1]['Descripcion'] }} <br/>
                        <input type="checkbox" {{ in_array($materiales[3]['id'],explode("#",$persona[0]->Pregunta_59))?'checked':'' }} /> {{ $materiales[3]['Descripcion'] }}
                    </p>
                <!--fin card body-->
                </div>
            </div>
            <!--FIN CARD BODY-->
            <!--fin de informacion familiar y de vicienda-->
            <!--informacion salud-->
            <h4 >INFORMACIÓN GENERAL DE SALUD</h4>
            <div class="divcont" >
                <div class="diviz" >
                    <p><strong>{{ $preguntas[59]['Descripcion'] }}:</strong> 
                                        Sí <input type="radio" {{ $persona[0]->Pregunta_60 == 1?'checked':'' }}> {{-- required=""> --}}
                                        No <input type="radio" {{ $persona[0]->Pregunta_60 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[60]['Descripcion'] }}:</strong> 
                                Sí <input type="radio" {{ $persona[0]->Pregunta_61 == 1?'checked':'' }}> {{-- required=""> --}}
                                No <input type="radio" {{ $persona[0]->Pregunta_61 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[61]['Descripcion'] }}:</strong> 
                            @if ($persona[0]->Pregunta_62 != null)
                            @foreach ($ss as $s)
                                @if ($s->id == $persona[0]->Pregunta_62)
                                    {{$s->Descripcion}}
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </p>
                    <!--fin Fila 1-->
                    <p><strong>{{ $preguntas[62]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_63 != null?$persona[0]->Pregunta_63:''}}</p>
                    <p><strong>{{ $preguntas[63]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_64 != null?$persona[0]->Pregunta_64:''}}</p>
                    <p><strong>{{ $preguntas[64]['Descripcion'] }}:</strong>
                        Sí<input id="si21" class="form-check-input" type="radio" name="permanente" value="1" {{ $persona[0]->Pregunta_65 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input id="no21" class="form-check-input" type="radio" name="permanente" value="0" {{ $persona[0]->Pregunta_65 === 0?'checked':'' }}>
                    </p>
                    <!--fin de fila 2-->
                    <p> <strong>{{ $preguntas[65]['Descripcion'] }}:</strong>
                                Sí <input type="radio" {{ $persona[0]->Pregunta_66 == 1?'checked':'' }}> {{-- required=""> --}}
                                No <input type="radio" {{ $persona[0]->Pregunta_66 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[66]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_67 != null?$persona[0]->Pregunta_67:''}}</p>
                    <p><strong>{{ $preguntas[67]['Descripcion'] }}:</strong>
                            Sí <input type="radio" {{ $persona[0]->Pregunta_68 == 1?'checked':'' }}> {{-- required=""> --}}
                            No<input type="radio" {{ $persona[0]->Pregunta_68 === 0?'checked':'' }}>
                        </p>
                        <p><strong>{{ $preguntas[68]['Descripcion'] }}:</strong>{{ $persona[0]->Pregunta_69 != null?$persona[0]->Pregunta_69:''}}</p>
                    <!--fin de fila 3-->
    
                    <p><strong>{{ $preguntas[69]['Descripcion'] }}:</strong>
                        Sí <input type="radio" {{ $persona[0]->Pregunta_70 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_70 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[70]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_71 != null?$persona[0]->Pregunta_71:''}}</p>
                </div>
                <div class="divder">
                    <p><strong>{{ $preguntas[71]['Descripcion'] }}:</strong>
                            Sí <input type="radio" {{ $persona[0]->Pregunta_72 == 1?'checked':'' }}>
                            No <input type="radio" {{ $persona[0]->Pregunta_72 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[72]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_73 != null?$persona[0]->Pregunta_73:''}}</p>
    
                    <!--fin de fila 4-->
                    <!--fila 5-->
                    <p><strong>{{ $preguntas[73]['Descripcion'] }}:</strong> <br>
                        <input type="radio" {{ $persona[0]->Pregunta_74 == 2?'checked':'' }}> Mucho
                        <input type="radio" {{ $persona[0]->Pregunta_74 == 1?'checked':'' }}> Poco
                        <input type="radio" {{ $persona[0]->Pregunta_74 === 0?'checked':'' }}> Nada
                    </p>
                    <p><strong>{{ $preguntas[74]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_75 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_75 === 0?'checked':'' }}>
                    </p>
                    <!--fila 6-->
                    <!--agregado-->
                    <p><strong>{{ $preguntas[75]['Descripcion'] }}:</strong> 
                                Sí <input type="radio" {{ $persona[0]->Pregunta_76 == 1?'checked':'' }}> {{-- required=""> --}}
                                No <input type="radio" {{ $persona[0]->Pregunta_76 === 0?'checked':'' }}>
                    </p>
                    <p><strong>{{ $preguntas[76]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_77 != null?$persona[0]->Pregunta_77:''}}</p>
                    <!--fin de agedo-->
                    <p><strong>{{ $preguntas[77]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_78 != null?$persona[0]->Pregunta_78:''}}</p>
                    <p><strong>{{ $preguntas[78]['Descripcion'] }}:</strong> 
                                Sí <input type="radio" {{ $persona[0]->Pregunta_79 == 1?'checked':'' }}> {{-- required=""> --}}
                                No <input type="radio" {{ $persona[0]->Pregunta_79 === 0?'checked':'' }}>
                    </p>
                    <!--fila 7-->
    
                <!--fin de body card-->
                </div>
            </div>
            <!--fin de infromacion de salu-->
            <!--INFROMACION DE ACCESO A LA ALIMENTACION-->
            <br>
            <br>
            <br>
            <br>
            <h4>ACCESO A LA ALIMENTACIÓN</h4>
            <div class="divcont" >
                <div class="diviz" >
                    <p class="espp"><strong>{{ $preguntas[79]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_80 == 1?'checked':'' }}>
                        No <input type="radio" {{ $persona[0]->Pregunta_80 === 0?'checked':'' }}>
                    </p>
                    <p class="espp"><strong>{{ $preguntas[80]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_81 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_81 === 0?'checked':'' }}>
                    </p>
    
                    <p class="espp"><strong>{{ $preguntas[81]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_82 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_82 === 0?'checked':'' }}>
                    </p>
                    <p class="espp"><strong>{{ $preguntas[82]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_83 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_83 === 0?'checked':'' }}>
                    </p>
    
                    <p class="espp"><strong>{{ $preguntas[83]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_84 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_84 === 0?'checked':'' }}>
                    </p>
                    <!--fin de fila-->
                    <p class="espp"><strong>{{ $preguntas[84]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_85 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_85 === 0?'checked':'' }}>
                    </p>
                    <!--inicio de fila-->
                    <p class="espp"><strong>{{ $preguntas[85]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_86 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_86 === 0?'checked':'' }}>
                    </p>
                    <!--inicio de fila-->
                    <p class="espp"><strong>{{ $preguntas[86]['Descripcion'] }}:</strong>                        
                        Sí <input type="radio" {{ $persona[0]->Pregunta_87 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_87 === 0?'checked':'' }}>
                    </p>
                    <!--fin de fila-->
                    <!--fin de fila-->
                </div>
                <div class="divder">
                    <p><strong>{{ $preguntas[87]['Descripcion'] }}:</strong><br>
                        <input  type="checkbox" value="{{ $alimentos[0]['id'] }}" {{ in_array($alimentos[0]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[0]['Descripcion'] }}<br>
                        <input  type="checkbox" value="{{ $alimentos[1]['id'] }}" {{ in_array($alimentos[1]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[1]['Descripcion'] }}<br>
                        <input  type="checkbox" value="{{ $alimentos[2]['id'] }}" {{ in_array($alimentos[2]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[2]['Descripcion'] }}<br>
                        <input  type="checkbox" value="{{ $alimentos[3]['id'] }}" {{ in_array($alimentos[3]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[3]['Descripcion'] }}<br>
                        <input  type="checkbox" value="{{ $alimentos[4]['id'] }}" {{ in_array($alimentos[4]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[4]['Descripcion'] }}<br>
                        <input  type="checkbox" value="{{ $alimentos[5]['id'] }}" {{ in_array($alimentos[5]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[5]['Descripcion'] }}<br>
                        <input  type="checkbox" value="{{ $alimentos[6]['id'] }}" {{ in_array($alimentos[6]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[6]['Descripcion'] }}<br>
                        <input  type="checkbox" value="{{ $alimentos[7]['id'] }}" {{ in_array($alimentos[7]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[7]['Descripcion'] }}<br>
                        <input  type="checkbox" value="{{ $alimentos[8]['id'] }}" {{ in_array($alimentos[8]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[8]['Descripcion'] }}<br>
                        <input  type="checkbox" value="{{ $alimentos[9]['id'] }}" {{ in_array($alimentos[9]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[9]['Descripcion'] }}<br>
                        <input  type="checkbox" value="{{ $alimentos[10]['id'] }}" {{ in_array($alimentos[10]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[10]['Descripcion'] }}<br>
                        <input  type="checkbox" value="{{ $alimentos[11]['id'] }}" {{ in_array($alimentos[11]['id'],explode("#",$persona[0]->Pregunta_88))?'checked':''  }}> {{ $alimentos[11]['Descripcion'] }}<br>
                    </p>
                    <!--fin fila-->
                <!--fin de cardbody-->
                </div>
            </div>
            <!-- FIN DE ACCESO A LA ALIMENTACION-->
            <!--INICIO-->
            <h4>INFORMACIÓN DE DESARROLLO HUMANO</h4>
            <div class="cardsd">
                
                    <p class="espp"><strong>{{ $preguntas[88]['Descripcion'] }}:</strong> 
                        Sí <input type="radio"  {{ $persona[0]->Pregunta_89 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio"  {{ $persona[0]->Pregunta_89 === 0?'checked':'' }}>
                    </p>
                    <p class="espp"><strong>{{ $preguntas[89]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_90 != null?$persona[0]->Pregunta_90:''}}</p>
                    <!--fin fila-->
                    <p class="espp"><strong>{{ $preguntas[90]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_91 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_91 === 0?'checked':'' }}>
                    </p>
                    <p class="espp"><strong>{{ $preguntas[91]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_92 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_92 === 0?'checked':'' }}>
                    </p>
    
                    <!--fin fila-->
                    <p class="espp"><strong>{{ $preguntas[92]['Descripcion'] }}:</strong>                        Sí <input type="radio"  {{ $persona[0]->Pregunta_93 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_93 === 0?'checked':'' }}>
                    </p>
                    <p class="espp"><strong>{{ $preguntas[93]['Descripcion'] }}:</strong> {{ $persona[0]->Pregunta_94 != null?$persona[0]->Pregunta_94:''}}</p>
                    <!--fin fila-->
                    <p class="espp"><strong>{{ $preguntas[94]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_95 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_95 === 0?'checked':'' }}>
                    </p>
                    <!--fin fila-->
                    <!--fin fila-->
               <!-- fin de card body-->
            </div>
            <!--FIN-->
            <!--INICIO INSTRUMENTOS FACTORES DE RIESGO-->
            <h4 >INSTRUMENTO DE IDENTIFICACIÓN DE FACTORES DE RIESGO</h4>
            <div class="divcont" >
                <div class="diviz" >

                    <p class="espp"><strong> {{ $preguntas[95]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_96 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_96 === 0?'checked':'' }}>
                    </p>
                    <!-- fin de fila-->
                    <p class="espp"><strong> {{ $preguntas[96]['Descripcion'] }}:</strong> <br>
                        <input type="checkbox" value="{{ $violencias[0]['id'] }}" {{ in_array($violencias[0]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}> {{ $violencias[0]['Descripcion'] }}<br>
                        <input type="checkbox" value="{{ $violencias[1]['id'] }}" {{ in_array($violencias[1]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}> {{ $violencias[1]['Descripcion'] }}<br>
                        <input type="checkbox" value="{{ $violencias[2]['id'] }}" {{ in_array($violencias[2]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}> {{ $violencias[2]['Descripcion'] }}<br>
                        <input type="checkbox" value="{{ $violencias[3]['id'] }}" {{ in_array($violencias[3]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}> {{ $violencias[3]['Descripcion'] }}<br>
                        <input type="checkbox" value="{{ $violencias[4]['id'] }}" {{ in_array($violencias[4]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}> {{ $violencias[4]['Descripcion'] }}<br>
                        <input type="checkbox" value="{{ $violencias[5]['id'] }}" {{ in_array($violencias[5]['id'],explode("#",$persona[0]->Pregunta_97))?'checked':''  }}> {{ $violencias[5]['Descripcion'] }}<br>
                    <!--fin de fila-->
                    <p  class="espp"><strong> {{ $preguntas[97]['Descripcion'] }}:</strong> 
                        Sí <input type="radio" {{ $persona[0]->Pregunta_98 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_98 === 0?'checked':'' }}>
                    </p>
                    <!--fin de fila-->
                    <p  class="espp"><strong> {{ $preguntas[98]['Descripcion'] }}:</strong><br>
                        Sí <input  type="radio" {{ $persona[0]->Pregunta_99 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input  type="radio" {{ $persona[0]->Pregunta_99 === 0?'checked':'' }}>
                    </p>
                    <!--fin de fila-->
                    <p class="espp"><strong> {{ $preguntas[99]['Descripcion'] }}:</strong>                        
                        Sí <input type="radio" {{ $persona[0]->Pregunta_100 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_100 === 0?'checked':'' }}>
                    </p>
                    <!--fin de fila-->
                    <p class="espp"><strong> {{ $preguntas[100]['Descripcion'] }}</strong>
                        Sí <input type="radio" {{ $persona[0]->Pregunta_101 == 1?'checked':'' }}> {{-- required=""> --}}
                        No <input type="radio" {{ $persona[0]->Pregunta_101 === 0?'checked':'' }}> 
                    </p>
                    <!--fin de fila-->
                </div>
                <div class="divder">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                    <p style='text-align: center;'>_______________________________</p>
                    <h3 style='text-align: center;'>FIRMA</h3>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                </div>
            </div>
            <!--fin de card body-->
            <!--fin de instrumentos de factores de riesgo-->
        <!--FIN  FACTORES DE RIESGO-->
        <br>
        <br>
        <br>
            <p class="espp2">Este programa utiliza recursos públicos y es ajeno a cualquier partido político. Queda prohibido el uso para fines distintos al desarrollo social. Quien haga uso indebido de los recursos de este programa deberá ser denunciado y sancionado conforme lo dispone la ley de la materia Los datos personales recabados, serán protegidos de acuerdo a lo establecido en la Ley General de Protección de Datos Personales en Posesión de los Sujetos Obligados y la Ley de Protección de Datos Personales Posesión de Sujetos Obligados para el Estado de Quintana Roo.</p>
    </body>
</html>