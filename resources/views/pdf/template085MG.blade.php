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
    <meta charset="UTF-8">
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
                                <td style="width: 40%; padding: 2px;">
                                    <label style="font-weight: bold;">{{ $etiqueta }}:</label>
                                </td>
                                <td style="width: 60%; padding: 2px;">
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
                                            <td style="width: 60%; padding: 1px;">
                                                <label style="font-weight: bold;">{{ $etiqueta }}:</label>
                                            </td>
                                            <td style="width: 40%; padding: 1px;">
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
                                            <td style="width: 60%; padding: 1px;">
                                                <label style="font-weight: bold;">{{ $etiqueta }}:</label>
                                            </td>
                                            <td style="width: 40%; padding: 1px;">
                                                <div style="border: 1px solid #000; padding: 3px;">{{ $valor }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 4px;">
                                <label style="font-weight: bold;">Zona geográfica:</label>
                                <label style="border: 1px solid #000; padding: 2px; ">
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
                                <td style="width: 60%; padding: 2px;">
                                    <label style="font-weight: bold;">{{ $etiqueta }}:</label>
                                </td>
                                <td style="width: 40%; padding: 2px;">
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
           <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table style="width: 100%; border: none;">
                        <tr>
                            <td style=" vertical-align: top;">
                                <table style=" border-collapse: collapse; text-align: center;" border="1">
                                    <tr>
                                        <th style="width: 20%;">Analito</th>
                                        <th rowspan="2" style="width: 20%;">Marcado de la sonda (m)</th>
                                        <th rowspan="2" style="width: 20%;">Concentración (ppm o %vol.)</th>
                                        <th rowspan="2" style="width: 20%;">% Estratificación</th>
                                        <th rowspan="2" style="width: 20%;">ppm</th>
                                    </tr>
                                    <tr>
                                        <td colspan="1">NO<sub>x</sub></td>
                                    </tr>
                                    <tr>
                                        <td>16.7% de longitud del diámetro</td>
                                        <td>{{ $detalle->marcado_sonda_1 }}</td>
                                        <td>{{ $detalle->concentracion_1 }}</td>
                                        <td>{{ $detalle->estratificacion_1 }}</td>
                                        <td>{{ $detalle->ppm_1 }}</td>
                                    </tr>
                                    <tr>
                                        <td>50% de longitud del diámetro</td>
                                        <td>{{ $detalle->marcado_sonda_2 }}</td>
                                        <td>{{ $detalle->concentracion_2 }}</td>
                                        <td>{{ $detalle->estratificacion_2 }}</td>
                                        <td>{{ $detalle->ppm_2 }}</td>
                                    </tr>
                                    <tr>
                                        <td>83.3% de longitud del diámetro</td>
                                        <td>{{ $detalle->marcado_sonda_3 }}</td>
                                        <td>{{ $detalle->concentracion_3 }}</td>
                                        <td>{{ $detalle->estratificacion_3 }}</td>
                                        <td>{{ $detalle->ppm_3 }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" rowspan="2">Promedio</td>
                                        <td rowspan="2">{{ $detalle->promedio_concentracion}}</td>
                                        <td colspan="2" >Máximo</td>
                                
                                    </tr>
                                    <tr>
                                        <td>{{ $detalle->max_estratificacion }}</td>
                                        <td>{{ $detalle->max_ppm }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr >
                            <td style="vertical-align: top;">
                                <table>
                                    <tr>
                                        <td>Cp</td>
                                        <td>Concentración promedio, (ppmv o %vol.)</td>
                                    </tr>
                                    <tr>
                                        <td>Cm</td>
                                        <td>Concentración medida, (ppmv o %vol.) </td>
                                    </tr>
                                    <tr>
                                        <td>16.7%</td>
                                        <td>Distancia en porcentaje donde se tomará la primer medición para la determinación de la estratificación.</td>
                                    </tr>
                                    <tr>
                                        <td>50%</td>
                                        <td>Distancia en porcentaje donde se tomará la segunda medición para la determincación de la estratifición</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                </td>
                <td style="width: 50%; ">
                    <table style="width: 100%;">
                        <tr>
                            <td rowspan="2"">No Estratificada</td>
                            <td >a) &le; 5%</td>
                            <td rowspan="2" style="text-align: center;">Se considera un solo punto de muestreo.</td>
                        </tr>
                        <tr>
                            <td >b) &le; 0.5 ppmv</td>
                        </tr>

                         <tr>
                            <td rowspan="2"">Mínimamente Estratificada</td>
                            <td >a) > 5% y hasta el 10%</td>
                            <td rowspan="2" style="text-align: center;">Se considera 3 puntos de muestreo.</td>
                        </tr>
                        <tr>
                            <td >b) > 0.5 ppmv</td>
                        </tr>

                         <tr>
                            <td rowspan="2"">Estratificada</td>
                            <td >a) > 10%</td>
                            <td rowspan="2" style="text-align: center;">Se considera 12 puntos de muestreo.</td>
                        </tr>
                        <tr>
                            <td >b) > 1 ppmv</td>
                        </tr>
                    </table>
                    <br>
                    Distribución de puntos para estratificación, Distancia (m)
                    <table style="width: 100%; border-collapse: collapse; text-align: center;" border="1">
                        <tr>
                            <th>Punto</th>
                            <th>Estatificada</th>
                            <th>Mínimamente</th>
                            <th>No Estratificada</th>
                        </tr>

                        @for ($i = 1; $i <= 12; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>N/A</td>
                            <td>
                                @if ($i <= 3)
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if ($i === 1)
                                    N/A
                                @endif
                            </td>
                        </tr>
                        @endfor
                    </table>
                    <div style="margin-top:20px;">
                        <label style="font-weight: bold;">Estratificación = </label>
                            <table style="display: inline-table; vertical-align: top;">
                                <tr>
                                    <td style="border-bottom: 1px solid #000; padding: 0 5px;">
                                        C  L<sub>p</sub> - C<sub>m</sub>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">
                                      C<sub>p</sub>
                                    </td>
                                </tr>
                            </table>

                    </div>
                    
                </td>
            </tr>
           </table>
           <div style="margin-top:15px; margin-bottom:10px">
                <strong>Método 7E EPA-2008.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Determinación de óxidos de nitrógeno, en los gases que fluyen por un conducto. Método de quimiluminiscencia.</strong>
           </div>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <table style="width: 100%; border-collapse: collapse;">
                            @php
                                $campos = [
                                    'SIGNATARIO:' => $detalle->muestreador,
                                    'INGENIERO DE SERVICIO:' => $detalle->muestreador,
                                    'REVISIÓN:' => $detalle->muestreador,
                                ];
                            @endphp

                            @foreach ($campos as $etiqueta => $valor)
                                <tr>
                                    <td style="width: 40%; padding: 2px;">
                                        <label style="font-weight: bold;">{{ $etiqueta }}</label>
                                    </td>
                                    <td style="width: 60%; padding: 2px;">
                                        <div style="border: 1px solid #000; padding: 3px;">{{ $valor }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </td>

                    <td style="width: 50%; vertical-align: top;">
                        <table style="width: 100%;border-collapse: collapse;" border="1">
                            <tr>
                                <td">Observaciones</td>
                            </tr>
                            <tr>
                                <td style="width: 40%; padding: 8px; height: 50px">Ninguna</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>


            
        </div>
@include('pdf.recursos.footerGeneral')  

    <div style="page-break-before: always;"></div>
    <!-- paginas 5 -->
@include('pdf.recursos.headerGeneral')

    <table style="width: 100%; border: none">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                Captura de Datos de Campo
                <table style=" width: 100%; border-collapse: collapse; text-align:center; font-size:7px;" border="1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NOx (ppmv)</th>
                            <th>CO (ppmv)</th>
                            <th>O<sub>2</sub> (%)</th>
                            <th>CO<sub>2</sub> (%)</th>
                            <th>TEMPT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos_campo as $index => $dato)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dato->nox ?? 'N/A' }}</td>
                            <td>{{ $dato->co_ppmv ?? 'N/A' }}</td>
                            <td>{{ $dato->o2 ?? 'N/A' }}</td>
                            <td>{{ $dato->co2 ?? 'N/A' }}</td>
                            <td>{{ $dato->temp ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    @php
                        $total = $datos_campo->count();
                        $avg_nox = $datos_campo->avg('nox');
                        $avg_co = $datos_campo->avg('co_ppmv');
                        $avg_o2 = $datos_campo->avg('o2');
                        $avg_co2 = $datos_campo->avg('co2');
                        $avg_temp = $datos_campo->avg('temp');
                    @endphp

                    <tfoot>
                        <tr>
                            <th>Promedio</th>
                            <th>{{ number_format($avg_nox, 2) }}</th>
                            <th>{{ number_format($avg_co, 2) }}</th>
                            <th>{{ number_format($avg_o2, 2) }}</th>
                            <th>{{ number_format($avg_co2, 2) }}</th>
                            <th>{{ number_format($avg_temp, 2) }}</th>
                        </tr>
                    </tfoot>

                </table>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <table>
                    <tr>
                        <table style="border-collapse: collapse; border: 1px solid #000;  margin-left: auto; margin.bottom:30px" border="1">
                            <tr>
                                <td>Número Informe</td>
                                <td>{{ $detalle->numero_informe }}</td>
                            </tr>
                            <tr>
                                <td>Orden de Servicio</td>
                                <td>{{ $detalle->numero_servicio }}</td>
                            </tr>
                            <tr>
                                <td>Fecha de Evaluación</td>
                                <td>{{ $fecha_muestreo }}</td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table style=" width: 70%; border-collapse: collapse;  margin: 20px auto; " border="1">
                            <tr>
                                <td></td>
                                <th>2Tr(s)</th>
                                <th>Flujo (L/min)</th>
                                <th>T. sonda (F)</th>
                            <tr>
                                <td>Shimadzu</td>
                                <td>70</td>
                                <td>1.00</td>
                                <td>240</td>
                            <tr>
                                <td>Testo</td>
                                <td>70</td>
                                <td>0.89</td>
                                <td>N/A</td>
                            <tr>
                        </table>
                    </tr>
                    <tr>
                        <table>
                            <td style="width: 50%; vertical-align: top;">
                                <img src="{{ $grafica_nox }}" alt="Gráfica NOx" width="100%">
                                <img src="{{ $grafica_co }}" alt="Gráfica CO" width="100%">
                                <img src="{{ $grafica_o2 }}" alt="Gráfica O2" width="100%">
                                <img src="{{ $grafica_co2 }}" alt="Gráfica CO2" width="100%">
                            </td>
                        </table>
                    </tr>
                    
                </table>
            </td>
        </tr>

    </table>

    <div>
    <table>
        <tr >
            <td rowspan="6" style="vertical-align: top;" >NOTA:</td>
        </tr>
        <tr>
            <td> Cuando la corriente se determine no estratificada, se tomarán las 60 lecturas en el mismo punto.</td>
        </tr>
        <tr>
            <td>Cuando la corriente se determine mínimamente estratificada, se tomarán las 20 lecturas en el primer punto, 20 en el segundo y 20 en el tercero.</td>

        </tr>
        <tr>
            <td> Las lecturas se realizarán cada minuto, al inicio de cada punto se debe esperar 2 veces el tiempo de respuesta para continuar con las mediciones.</td>

        </tr>
        <tr>
            <td>Cuando la corriente se determine estratificada, se tomarán las 5 lecturas en cada uno de los 12 puntos.</td>

        </tr>
        <tr>
            <td>Las concentraciones de CO2 que se registran son por medio de calculo, el cual lo realiza el analizador.</td>
        </tr>
        
    </table>

    <table>
        <tr>
            <td>Referencia:<br>{{$detalle->nombre}}</td>
            <td style="item-align:center;">{{$detalle->descripcion}}</td>
        <tr>
    </table>
    <table style="width: 50%; border-collapse: collapse;">
        @php
            $campos = [
                'SIGNATARIO:' => $detalle->muestreador,
                'INGENIERO DE SERVICIO:' => $detalle->muestreador,
                'REVISIÓN:' => $detalle->muestreador,
            ];
        @endphp

        @foreach ($campos as $etiqueta => $valor)
            <tr>
                <td style="width: 40%; padding: 2px;">
                    <label style="font-weight: bold;">{{ $etiqueta }}</label>
                </td>
                <td style="width: 60%; padding: 2px;">
                    <div style="border: 1px solid #000; padding: 3px;">{{ $valor }}</div>
                </td>
            </tr>
        @endforeach
    </table>

        
      
       
    </div>
    



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