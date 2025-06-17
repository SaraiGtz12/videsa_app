<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe PDF</title>
    <style>
         @page {
            margin: 10px 40px 40px 40px;

             @bottom-center {
                content: "Página " counter(page) " de " counter(pages);
                font-size: 10px;
                color: #333;
            }
        }
        .page:before {
            content: counter(page);
        }

        .topage:before {
            content: counter(pages);
        }

        .page-number {
            text-align: right;
            font-size: 9px;
        }
        main {
            margin-top: 0;
            margin-bottom: 0;
        }
      

        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
        }
        .company-name {
            font-weight: bold;
            font-size: 12px;
            margin-top: 30px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .info-table td {
            vertical-align: top;
            padding: 5px;
        }

        .col-1 {
            width: 50%;
        }

        .col-2 {
            width: 20%;
            font-weight: bold;
        }

        .col-3 {
            width: 10%;
        }

        .col-4 {
            width: 20%;
            text-align: right;
        }

        .placeholder-image {
            width: 100px;
            height: 100px;
            background-color: #ccc;
            display: inline-block;
            text-align: center;
            line-height: 100px;
            color: #666;
            font-size: 8px;
            border: 1px solid #999;
        }
   

        .evaluated-equipment-table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 25px;
            font-size: 9px;
        }

        .evaluated-equipment-table th,
        .evaluated-equipment-table td {
            border: none;
            padding: 5px;
            text-align: left;
        }

        .evaluated-equipment-table tr:first-child th {
            border: 1px solid #000;
            background-color: #f2f2f2; 
            text-align: center;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9x;
            margin-top: 5px;
        }

        .result-table th,
        .result-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>

<body>

    <main>
         @php
            $tabla_resultados = null;
            $capacidad = $detalle->cpacidad_termica_nominal;
            if ($capacidad >= 15 && $capacidad < 150) {
                 $tipo_comb = null;
                 $tipo= $detalle->tipo;
                     if ($tipo == 'Liquido') {
                        $tabla_resultados = 1;
                     }elseif ($tipo == 'Gaseoso') {
                        $tabla_resultados = 2;
                     } 
            } elseif ($capacidad >= 150 && $capacidad < 1200) {
                $tipo_comb = null;
                 $tipo= $detalle->tipo;
                     if ($tipo == 'Liquido') {
                        $tabla_resultados = 3;
                     }elseif ($tipo == 'Gaseoso') {
                        $tabla_resultados = 4;
                     } 
            } elseif ($capacidad >= 1200 && $capacidad < 3000) {
                $tipo_comb = null;
                 $tipo= $detalle->tipo;
                     if ($tipo == 'Liquido') {
                        $tabla_resultados = 5;
                     }elseif ($tipo == 'Gaseoso') {
                        $tabla_resultados = 6;
                     } 
            }elseif ($capacidad >= 3000 && $capacidad < 15000) {
                $tipo_comb = null;
                 $tipo= $detalle->tipo;
                     if ($tipo == 'Liquido') {
                        $tabla_resultados = 7;
                     }elseif ($tipo == 'Gaseoso') {
                        $tabla_resultados = 8;
                     } 
            }  elseif ($capacidad >= 15000) {
               $tipo_comb = null;
                 $tipo= $detalle->tipo;
                     if ($tipo == 'Liquido') {
                        $tabla_resultados = 9;
                     }elseif ($tipo == 'Gaseoso') {
                        $tabla_resultados = 10;
                     } 
            }

         
        @endphp

@include('pdf.recursos.headerCaratula')
      
        <div > 
            Comparación con la Norma Oficial Mexicana {{$detalle->nombre}}, {{$detalle->descripcion}}
            <br>
            Para equipos con capacidad térmica nominal mayor de 5.3 G/J o 150 C.C combustible gaseoso
        </div>

        <div class="company-name">
            {{$detalle->cliente}}  ({{$detalle->nombre_sucursal}})
        </div>

        <table class="info-table">
            <tr>
                <td class="col-1">
                    {{$detalle->calle}} {{$detalle->numero}}, {{$detalle->colonia}},<br>
                    {{$detalle->ciudad}}, {{$detalle->estado}}, C.P. {{$detalle->codigo_postal}}<br>
                    @switch($detalle->codigo)
                        @case('ZMG')
                            Zona Metropolitana de Guadalajara
                            @break

                        @case('ZMM')
                            Zona Metropolitana de Monterrey
                            @break

                        @case('RP')
                            Resto del país
                            @break

                        @default
                            {{$detalle->codigo}} {{-- Mostrar el código si no coincide con ningún caso --}}
                    @endswitch
                    (  {{$detalle->codigo}})
                </td>
                <td class="col-2">
                    Número de informe:<br>
                    Orden de servicio:<br>
                    Fecha de evaluación:<br>
                    Recepción:<br>
                    Fecha de informe:
                </td>
                  <td class="col-3">
                    {{$detalle->numero_informe }}<br>
                    {{$detalle->numero_servicio }}<br>
                    {{$fecha_muestreo}}<br>
                    {{$fecha_muestreo}}<br>
                    {{ $fecha_informe }}
                 </td>
                <td class="col-4">
                    <img src="{{ public_path('img/CODIGOQR.jpg') }}" width="60px" alt="footer">
                </td>
            </tr>
        </table>

    
        <table class="evaluated-equipment-table">
            <tr>
                <th colspan="5" style = "text-align: center">EQUIPO EVALUADO</th>
            </tr>
            <tr>
                <td colspan="5" style = "text-align: center">{{$equipo_evaluado}}</td>
            </tr>
            <tr>
                <td>Capacidad térmica<br>nominal</td>
                <td>C.C<br>{{ $detalle->cpacidad_termica_nominal}}</td>
                <td>GJ/h<br>22.06</td>
                <td></td>
                <td>Combustible utilizado:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $detalle->tipo }}</td>
            </tr>
            
        </table>
            @if ($tabla_resultados === 4)
                    <table class="result-table">
                        <tr>
                            <th colspan="5" style = "text-align: center">RESULTADOS</th>
                        </tr>
                        <tr>
                            <td>Parámetros Evaluados</td>
                            <td>Cconcentración (ppmv)</td>
                            <td>Limite Máximo Permisible (ppmv)</td>
                            <td>Comparación (L.M.P.)</td>
                            <td>&plusmn; uE (ppmv)</td>
                        </tr>
                        <tr>
                            <td>Monoxido de Carbono (CO)</td>
                            <td>20.08</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.37</td>
                        </tr>
                        <tr>
                            <td>Óxido de Nitrógeno (NOx)</td>
                            <td>21.73</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.12</td>
                        </tr>
                        
                    </table>
                @elseif ($tabla_resultados === 1)
                    <table class="result-table ">
                        <tr>
                            <th colspan="5" style = "text-align: center">RESULTADOS</th>
                        </tr>
                        <tr>
                            <td>Parámetros Evaluados</td>
                            <td>Cconcentración (ppmv)</td>
                            <td>Limite Máximo Permisible (ppmv)</td>
                            <td>Comparación (L.M.P.)</td>
                            <td>&plusmn; uE (ppmv)</td>
                        </tr>
                        <tr>
                            <td>Bioxido de azufre,ppmv</td>
                            <td>7.45</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.14</td>
                        </tr>
                        <tr>
                            <td>Monoxido de Carbono (CO)</td>
                            <td>7.45</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.14</td>
                        </tr>
                        
                        
                    </table>

                @elseif ($tabla_resultados === 2)
                    <table class="result-table ">
                        <tr>
                            <th colspan="5" style = "text-align: center">RESULTADOS</th>
                        </tr>
                        <tr>
                            <td>Parámetros Evaluados</td>
                            <td>Cconcentración (ppmv)</td>
                            <td>Limite Máximo Permisible (ppmv)</td>
                            <td>Comparación (L.M.P.)</td>
                            <td>&plusmn; uE (ppmv)</td>
                        </tr>
                        <tr>
                            <td>Monoxido de Carbono (CO)</td>
                            <td>7.80</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.15</td>
                        </tr>
                    </table>

                @elseif ($tabla_resultados === 3)
                    <table class="result-table ">
                        <tr>
                            <th colspan="5" style = "text-align: center">RESULTADOS</th>
                        </tr>
                        <tr>
                            <td>Parámetros Evaluados</td>
                            <td>Cconcentración (ppmv)</td>
                            <td>Limite Máximo Permisible (ppmv)</td>
                            <td>Comparación (L.M.P.)</td>
                            <td>&plusmn; uE (ppmv)</td>
                        </tr>
                        <tr>
                            <td>Particulas, mg/m3</td>
                            <td>7.80</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.15</td>
                        </tr>
                        <tr>
                            <td>Bióxido de azufre ppmv</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                        <tr>
                            <td>Óxido de Nitrógeno (NOx)</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                        <tr>
                            <td>Monoxido de Carbono (CO)</td>
                            <td>7.80</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.15</td>
                        </tr>
                    

                    </table>

                @elseif ($tabla_resultados === 5)
                    <table class="result-table ">
                        <tr>
                            <th colspan="5" style = "text-align: center">RESULTADOS</th>
                        </tr>
                        <tr>
                            <td>Parámetros Evaluados</td>
                            <td>Cconcentración (ppmv)</td>
                            <td>Limite Máximo Permisible (ppmv)</td>
                            <td>Comparación (L.M.P.)</td>
                            <td>&plusmn; uE (ppmv)</td>
                        </tr>
                        <tr>
                            <td>Particulas, mg/m3</td>
                            <td>7.80</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.15</td>
                        </tr>
                        <tr>
                            <td>Bióxido de azufre ppmv</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                        <tr>
                            <td>Óxido de Nitrógeno (NOx)</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                        <tr>
                            <td>Monoxido de Carbono (CO)</td>
                            <td>7.80</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.15</td>
                        </tr>

                    </table>

                @elseif ($tabla_resultados === 6)
                    <table class="result-table ">
                        <tr>
                            <th colspan="5" style = "text-align: center">RESULTADOS</th>
                        </tr>
                        <tr>
                            <td>Parámetros Evaluados</td>
                            <td>Cconcentración (ppmv)</td>
                            <td>Limite Máximo Permisible (ppmv)</td>
                            <td>Comparación (L.M.P.)</td>
                            <td>&plusmn; uE (ppmv)</td>
                        </tr>
                        <tr>
                            <td>Óxido de Nitrógeno (NOx)</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                        <tr>
                            <td>Monóxido de carbono, ppmv</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>

                    </table>

                @elseif ($tabla_resultados === 7)
                    <table class="result-table ">
                        <tr>
                            <th colspan="5" style = "text-align: center">RESULTADOS</th>
                        </tr>
                        <tr>
                            <td>Parámetros Evaluados</td>
                            <td>Cconcentración (ppmv)</td>
                            <td>Limite Máximo Permisible (ppmv)</td>
                            <td>Comparación (L.M.P.)</td>
                            <td>&plusmn; uE (ppmv)</td>
                        </tr>
                        <tr>
                            <td>Particulas, mg/m3</td>
                            <td>7.80</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.15</td>
                        </tr>
                        <tr>
                            <td>Bióxido de azufre ppmv</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                        <tr>
                            <td>Óxido de Nitrógeno (NOx)</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                        <tr>
                            <td>Monoxido de Carbono (CO)</td>
                            <td>7.80</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.15</td>
                        </tr>

                    </table>

                @elseif ($tabla_resultados === 8)
                    <table class="result-table ">
                        <tr>
                            <th colspan="5" style = "text-align: center">RESULTADOS</th>
                        </tr>
                        <tr>
                            <td>Parámetros Evaluados</td>
                            <td>Cconcentración (ppmv)</td>
                            <td>Limite Máximo Permisible (ppmv)</td>
                            <td>Comparación (L.M.P.)</td>
                            <td>&plusmn; uE (ppmv)</td>
                        </tr>
                        <tr>
                            <td>Óxido de Nitrógeno (NOx)</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                        <tr>
                            <td>Monóxido de carbono, ppmv</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                    </table>
                @elseif ($tabla_resultados === 9)
                    <table class="result-table ">
                        <tr>
                            <th colspan="5" style = "text-align: center">RESULTADOS</th>
                        </tr>
                        <tr>
                            <td>Parámetros Evaluados</td>
                            <td>Cconcentración (ppmv)</td>
                            <td>Limite Máximo Permisible (ppmv)</td>
                            <td>Comparación (L.M.P.)</td>
                            <td>&plusmn; uE (ppmv)</td>
                        </tr>
                        <tr>
                            <td>Particulas, mg/m3</td>
                            <td>7.80</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.15</td>
                        </tr>
                        <tr>
                            <td>Bióxido de azufre ppmv</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                        <tr>
                            <td>Óxido de Nitrógeno (NOx)</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                        <tr>
                            <td>Monoxido de Carbono (CO)</td>
                            <td>7.80</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.15</td>
                        </tr>

                    </table>

                @elseif ($tabla_resultados === 10)
                    <table class="result-table ">
                        <tr>
                            <th colspan="5" style = "text-align: center">RESULTADOS</th>
                        </tr>
                        <tr>
                            <td>Parámetros Evaluados</td>
                            <td>Cconcentración (ppmv)</td>
                            <td>Limite Máximo Permisible (ppmv)</td>
                            <td>Comparación (L.M.P.)</td>
                            <td>&plusmn; uE (ppmv)</td>
                        </tr>
                        <tr>
                            <td>Óxido de Nitrógeno (NOx)</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                        <tr>
                            <td>Monóxido de carbono, ppmv</td>
                            <td>8.59</td>
                            <td>No Aplica</td>
                            <td>No Aplica</td>
                            <td>0.16</td>
                        </tr>
                    </table>
            
            @endif

        <div style="margin-top: 20px; font-size: 9px;">
            NOTA 1: La incertidumbre estimada UE para CO es 1.86% y para NOx es 0.54%, se expresa con un factor de cobertura k=2 que corresponde aproximadamente 
            a un nivel de &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;confianza del 95%. Se calcula basandose en la guia para la expresion de incertidumbre en los resultados de las mediciones (NMX-CH-140-IMNC-202)
            <br>
            NOTA 2: Para este caso, la zona geografica para el Monoxido de Carbono (CO) se considera: Resto del Pais (RP).
            <br>
            NOTA 3:Para este caso, la zona geografica para los Oxidos de Nitrogeno (NOx) se considera: Resto del Pais (RP).
            <br>
            NOTA 4: ppmv Partes por millon volumen, igual a micromol por mol 
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GJ/has      Giga Joules por hora
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.C         Caballos Caldera 
            <br>
            *Para este caso de CO NOx los limites se establecen como concentraciones en volumen y 
            base seca, en condiciones de refrencia de 25&deg;C, 101 325 pascales (1 atm) y 5% de (O2)
             <br>
             Se emplea una *Regla de decisión de aceptación simple* como lo establece el documento  *Guidelineson DEcision Rules and Statements of Conformity*<br>
             Este informe representa las caracteristicas de la muestra sometida a prueba, este no podrá ser alterado o reproducido en su totalidad con la aprobación por escrito de 
             Verificaciones Industriales y Desarrollo de Proyectos Ecologicos S.A de C.V. (VIDESA).
        </div>


        <table class="evaluated-equipment-table">
            <tr>
                <th colspan="6" style = "text-align: center">CONCLUSION</th>
            </tr>
            <tr>
                <td colspan="6" style = "text-align: center; font-size: 8px;">
                    Debido a que el equipo evaluado no es un equipo de calentamiendo indirecto,
                    la NOM-085-SEMARNAT-2011 no le aplica, se inclutye el resultado de la contratacion
                    de los parametros evaluados, unicamente con el objetivo de proporcionar infomracion
                    relativa a los resultados obtenidos. La evaluacion se realiza a solictud del cliente.
                </td>
            </tr>
        
        </table>

        <div style="padding-bottom: 120px;"> 
            {{-- Firma --}}
            <div style="text-align: center; margin-top: 100px;">
                <div style="border-top: 1px solid #000; width: 300px; margin: 0 auto;"></div>
                <p style="margin: 5px 0 0 0; font-weight: bold;">Nombre de la Persona</p>
                <p style="margin: 0;">Cargo o Puesto</p>
            </div>
        </div>

@include('pdf.recursos.footerCaratula')
    
<!-- Pgina 2 -->
    <div style="page-break-before: always;"></div>
@include('pdf.recursos.headerCaratula')
        <div > 
            Comparación con la Norma Oficial Mexicana {{$detalle->nombre}}, {{$detalle->descripcion}}
            <br>
            Para equipos con capacidad térmica nominal mayor de 5.3 G/J o 150 C.C combustible gaseoso
        </div>
        <table style="margin-top: 20px;margin-left: auto;">
            <tr>
                <td class="col-1"> Número de informe:<br></td>
                <td class="col-2"> {{$detalle->numero_informe}}<br></td>
            <tr>
                <td class="col-1">Orden de servicio:<br></td>
                <td class="col-2"> {{$detalle->numero_servicio}}<br></td>
            </tr>
            <tr>
                <td class="col-1">Fecha de evaluación:<br></td>
               <td class="col-2">{{$detalle->fecha_muestreo}}<br> </td>
            </tr> 
            <tr>
               <td class="col-1"> Recepción:<br></td>
               <td class="col-2">{{$detalle->fecha_muestreo}}<br></td>
            </tr>
            <tr>
               <td class="col-1"> Fecha de informe:<br></td>
               <td class="col-2">{{$fecha_informe}}<br></td>
            </tr>
        </table>
        <table class="result-table " >
            <tr>
                <th colspan="6" style = "text-align: center">TABLA DE RESULTADOS</th>
            </tr>
            <tr>
                <td></td>
                <td>NOx ppmv</td>
                <td>CO ppmv</td>
                <td>O2% vol</td>
                <td>CO2%vol</td>
                <td>TEMP. En el coducto C</td>
            </tr>
            <tr>
                <td>Promedio de los valores obtenidos</td>
                <td>8.59</td>
                <td>7.80</td>
                <td>16.42</td>
                <td>1.88</td>
                <td>95.1</td>
            </tr>
            <tr>
            <td>Valores corregidos por gas efluente</td>
                <td>8.06</td>
                <td>7.45</td>
                <td>16.33</td>
                <td>N/A</td>
                <td>N/A</td>
            </tr>
            <tr>
            <td>Valores corregidos al 5% de O2</td>
                <td>21.73</td>
                <td>20.08</td>
                <td>N/A</td>
                <td>5.08</td>
                <td>N/A</td>
            </tr>
        </table>
        <table style="margin: 20px auto; text-align: center; font-family: 'Courier New', monospace; font-size: 14px;">
            <tr>
                <td style="padding: 0 15px;">C<sub>R</sub> =</td>
                <td>
                    <div>
                        <div style="border-bottom: 1px solid #000; display: inline-block; padding: 0 5px;">
                            20.9 - O<sub>R</sub>
                        </div>
                        <div style="margin-top: 2px;">
                            20.9 - O<sub>M</sub>
                        </div>
                    </div>
                    <td style="padding: 0 15px;">×</td>
                    <td><div style="padding: 0 15px;"> C<sub>M</sub></div></td>
                </td>
                <td style="padding: 0 15px;">C<sub>R</sub> =</td>
                <td>
                    <div>
                        <div style="border-bottom: 1px solid #000; display: inline-block; padding: 0 5px;">
                            20.9 - 5.0
                        </div>
                        <div style="margin-top: 2px;">
                            20.9 - 15.00
                        </div>
                    </div>
                </td>
                <td style="padding: 0 15px;">×</td>
                <td>
                    <strong>8.06 = 21.73 ppmv</strong>
                </td>
            </tr>
        </table>



        <table class="evaluated-equipment-table">
        
            <tr>
                <td>Concentración de referencia del O2</td>
                <td></td>
                <td>Valores de referencia</td>
                <td></td>
            </tr>
            <tr>
                <td>Nivel de referencia para el O2 (5%) </td>
                <td>5.0</td>
                <td></td>
                <td>O2%</td>
            </tr>
            <tr>
                <td>Valor medido para O2 (%)</td>
                <td>15.0</td>
                <td></td>
                <td>OR%</td>
            </tr>
            <tr>
                <td>Concentración medida</td>
                <td>8.1</td>
                <td></td>
                <td>OM%</td>
            </tr>
        </table>

        <div style="margin-top: 20px; font-size: 8px;">
            *Para valores de OM medidos entre 15.1% y 20.9%, se utilizará un valor de OM de 15%
            <br><br><br>
            Método 3A EPA-2008 &nbsp; Determinación de oxígeno (O2) y bióxido de carbono (CO2) en los gases que 
            fluyen por un conducto. Método instrumenta
            <br>
            Método 10 EPA-2008&nbsp;Para el caso de CO y NOx los límites se establecen como concentraciones en volumen y en base seca, 
            en condiciones de referencia de 25°C, 101 325 Pa (1 atm) y 5 % de
            Método 7 EPA-2008&nbsp;Determinación de óxidos de nitrógeno, en los gases que fluyen por un conducto.
            Método de quimiluminiscencia
        </div>
@include('pdf.recursos.footerCaratula')              
     <div style="page-break-before: always;"></div>
     <!-- paginas 3 -->
@include('pdf.recursos.headerGeneral')
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table style="width: 100%;">
                        @php
                            $campos = [
                                'Razón Social' => $detalle->cliente,
                                'Calle y Número' => $detalle->calle,
                                'Colonia' => $detalle->colonia,
                                'Alcaldía' => $detalle->ciudad,
                                'Estado' => $detalle->estado,
                                'Código Postal' => $detalle->codigo_postal,
                                'Responsable' => $detalle->responsable,
                                'Cargo' => $detalle->cargo,
                                'Teléfono' => $detalle->telefono,
                                'Equipo Evaluado' => $equipo_evaluado,
                                'Marca y Modelo' => $detalle->marca_modelo
                            ];
                        @endphp

                        @foreach ($campos as $etiqueta => $valor)
                            <tr>
                                <td style="width: 40%; padding: 4px;">
                                    <label style="font-weight: bold;">{{ $etiqueta }}:</label>
                                </td>
                                <td style="width: 60%; padding: 4px;">
                                    <div style="border: 1px solid #000; padding: 3px;">{{ $valor }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <table style="width: 100%; margin-top: 10px;">
                        <tr>
                            <!-- Primera columna -->
                            <td style="width: 60%; vertical-align: top;">
                                <table style="width: 100%;">
                                    @php
                                        $columna1 = [
                                            'Combustible Utilizado' => $detalle->tipo,
                                            'Capacidad Térmica' => $detalle->cpacidad_termica_nominal,
                                            'Altura respecto al nivel del mar' => $detalle->altura_nivel_mar,
                                            'Presión estatica:' => $detalle->precion_estatica
                                        ];
                                    @endphp

                                    @foreach ($columna1 as $etiqueta => $valor)
                                        <tr>
                                            <td style="width: 60%; padding: 4px;">
                                                <label style="font-weight: bold;">{{ $etiqueta }}:</label>
                                            </td>
                                            <td style="width: 40%; padding: 4px;">
                                                <div style="border: 1px solid #000; padding: 3px;">{{ $valor }}</div>
                                            </td>
                                        </tr>
                                    @endforeach

                                   

                                        
                                        
                                </table>
                            </td>

                            <!-- Segunda columna -->
                            <td style="width: 40%; vertical-align: top;">
                                <table style="width: 100%;">
                                    @php
                                        $columna2 = [
                                            'Año' => $detalle->anio,
                                            'Presión' => $detalle->presion_barometrica_1,
                                        ];
                                    @endphp

                                    @foreach ($columna2 as $etiqueta => $valor)
                                        <tr>
                                            <td style="width: 60%; padding: 4px;">
                                                <label style="font-weight: bold;">{{ $etiqueta }}:</label>
                                            </td>
                                            <td style="width: 40%; padding: 4px;">
                                                <div style="border: 1px solid #000; padding: 3px;">{{ $valor }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 2px;">
                                <label style="font-weight: bold;">Zona geográfica:</label>
                                <label style="border: 1px solid #000; padding: 3px; ">
                                    @switch($detalle->codigo)
                                        @case('ZMG')
                                            Zona Metropolitana de Guadalajara
                                        @break
                                        @case('ZMM')
                                            Zona Metropolitana de Monterrey
                                        @break
                                        @case('RP')
                                            Resto del país
                                        @break
                                        @default
                                        {{ $detalle->codigo }}
                                    @endswitch
                                </label>
                            </td>
                        </tr>
                    </table>

                </td>
             
                
            

                <!-- Segunda columna con tabla anidada con bordes -->
                <td style="width: 50%; vertical-align: top;">
                    <table style="width: 100%;">
                        <td style="width: 50%; vertical-align: top;">
                      
                        </td>
                        <td style="width: 50%; vertical-align: top;">
                            <table style="width: 100%; border-collapse: collapse;" border="1">
                                <tr>
                                    <td>Número de Informe:</td>
                                    <th>{{$detalle->numero_informe }}</th>
                                </tr>
                                <tr>
                                    <td>Orden de Servicio: </td>
                                    <th>{{$detalle->numero_servicio}}</th>
                                </tr>
                                <tr>
                                    <td>Fecha de Evaluación:</td>
                                    <th>{{$detalle->fecha_muestreo }}</th>
                                </tr>
                                <tr>
                                    <td>Recepción: </td>
                                    <th>{{$detalle->fecha_muestreo }}</th>
                                </tr>
                                 <tr>
                                    <td>Fecha de Informe:</td>
                                    <th>{{$fecha_informe}}</th>
                                </tr>
                            </table>
                        </td>
                    </table>

                    <table style="width: 100%;">
                        @php
                            $campos = [
                                'Geometría del conducto' => $detalle->geometria_conducto ?? 'N/A',
                                'Diámetro interior del conducto, Dch' => $detalle->diametro_int ?? 'N/A',
                                'Diámetro equivalente, Deq' => $detalle->diametro_eq ?? 'N/A',
                                'Largo transversal, L1' => $detalle->largo_transversal ?? 'N/A',
                                'Ancho transversal, L2' => $detalle->ancho_transversal ?? 'N/A',
                                'Número de puertos' => $detalle->numero_puertos ?? 'N/A',
                                'Distancia en A' => $detalle->distancia_a ?? 'N/A',
                                'Distancia en B' => $detalle->distancia_b ?? 'N/A',
                                'Distancia en C' => $detalle->distancia_c ?? 'N/A',
                                'Extensión del puerto, epm' => $detalle->extencion_puerto ?? 'N/A',
                                'Número de diámetros en A' => $detalle->num_diametros_a ?? 'N/A',
                                'Número de diámetros en B' => $detalle->num_diametros_b ?? 'N/A',
                                'Número de diámetros en C' => $detalle->num_diametros_c ?? 'N/A',
                                'Número de puntos seleccionados para medición de gases' =>'1',
                            ];
                        @endphp

                        @foreach ($campos as $etiqueta => $valor)
                            <tr>
                                <td style="width: 60%; padding: 4px;">
                                    <label style="font-weight: bold;">{{ $etiqueta }}:</label>
                                </td>
                                <td style="width: 40%; padding: 4px;">
                                    <div style="border: 1px solid #000; padding: 1px;">{{ $valor }}</div>
                                </td>
                            </tr>
                        @endforeach

                        <tr style="text-align: center;">
                            <td>
                                <label style="font-weight: bold;">D<sub>eq</sub> = </label>
                                <table style="display: inline-table; vertical-align: middle;">
                                    <tr>
                                        <td style="border-bottom: 1px solid #000; padding: 0 5px;">
                                            2 x  L<sub>1</sub> x L<sub>2</sub>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            L<sub>1</sub> + L<sub>2</sub>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>
               
                   
                </td>
               
            </tr>
        </table>
        <div style="margin-top: 20px">
           <strong>Determinación de la estratificación</strong>
           <table style="width: 50%; border-collapse: collapse;" border="1">
                <tr>
                    <td>Analito</td>
                    <td>Marcado de la sonda (m)</td>
                    <td>Concentración (ppm o %vol.)</td>
                    <td>% Estratificación </td>
                    <td>ppm</td>
                </tr>
            </table>
        </div>



    
    @include('pdf.recursos.footerGeneral')  
    <div style="page-break-before: always;"></div>
    <!-- paginas 5 -->
    @include('pdf.recursos.headerGeneral')

    @include('pdf.recursos.footerGeneral')  
    <div style="page-break-before: always;"></div>

     <!-- paginas 6 -->
    @include('pdf.recursos.headerGeneral')
    @include('pdf.recursos.footerGeneral')              
    <div style="page-break-before: always;"></div>
     <!-- paginas 7 -->
    @include('pdf.recursos.headerGeneral')
    @include('pdf.recursos.footerGeneral')  
    </main>

<script src="{{ asset('js/pdf/grafica-resultados.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>