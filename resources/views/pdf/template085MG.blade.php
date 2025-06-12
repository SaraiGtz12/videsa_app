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
            width: 35%;
        }

        .col-2 {
            width: 20%;
            font-weight: bold;
        }

        .col-3 {
            width: 25%;
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
            margin-bottom: 50px;
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
            margin-top: 10px;
        }

        .result-table th,
        .result-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        h2 {
            text-align: center;
            margin-bottom: 4px;
        }
        .section {
            margin-bottom: 10px;
        }
        .client-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        .client-table td {
            border: 1px solid black;
            padding: 3px;
            vertical-align: top;
        }

        .client-table th {
            border: 1px solid black;
            padding: 3px;
            vertical-align: top;
        }
        .label td{
            border: none;
            font-weight: bold;

        }
    </style>
</head>

<body>

    <main>
        @include('pdf.recursos.headerCaratula')
        <div class="company-name">
            Flexico, S. de R.L. de C.V.
        </div>

        <table class="info-table">
            <tr>
                <td class="col-1">
                    Carretera Jilotepec–Soyaniquilpan Km 3.5 MZ 2 Lt 1B, Parque industrial Jilotepec,<br>
                    Jilotepec, Estado de México, C.P. 54240<br>
                    Resto de país (Rp)
                </td>
                <td class="col-2">
                    Número de informe:<br>
                    Orden de servicio:<br>
                    Fecha de evaluación:<br>
                    Recepción:<br>
                    Fecha de informe:
                </td>
                  <td class="col-3">
                    {{ $numero_informe }}<br>
                    {{ $orden_servicio }}<br>
                    {{ $fecha_evaluacion }}<br>
                    {{ $recepcion }}<br>
                    {{ $fecha_informe }}
                 </td>
                <td class="col-4">
                    <div class="placeholder-image">QR</div>
                </td>
            </tr>
        </table>


        <table class="evaluated-equipment-table">
            <tr>
                <th colspan="6" style = "text-align: center">Equipo evaluado</th>
            </tr>
            <tr>
                <td colspan="6" style = "text-align: center">{{$equipo_evaluado}}</td>
            </tr>
            <tr>
                <td>Capacidad térmica</td>
                <td>C.C</td>
                <td>GJ/h</td>
                <td></td>
                <td>Combustible utilizado</td>
                <td>Gas natural</td>
            </tr>
            <tr>
                <td>Nominal</td>
                <td>No.Disponible</td>
                <td>No.Disponible</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>



        <table class="result-table ">
            <tr>
                <th colspan="5" style = "text-align: center">Resultados</th>
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

        <div style="margin-top: 20px; font-size: 7px;">
            NOTA 1: La incertidumbre estimada UE para CO es 1.86% y para NOx es 0.54%, se expresa con un factor de cobertura k=2 que corresponde aproximadamente
            a un nivel de confianza del 95%. Se calcula basandose en la guia para la expresion de incertidumbre en los resultados de las mediciones (NMX-CH-140-IMNC-202)
            <br>
            NOTA 2: Para este caso, la zona geografica para el Monoxido de Carbono (CO) se considera: Resto del Pais (RP).
            <br>
            NOTA 3:Para este caso, la zona geografica para los Oxidos de Nitrogeno (NOx) se considera: Resto del Pais (RP).
            <br>
            NOTA 4: ppmv Partes por millon volumen, igual a micromol por mol
            <br>
            GJ/has      Giga Joules por hora
            <br>
            C.C         Caballos Caldera
            <br>
            *Para este caso de CO NOx los limites se establecen como concentraciones en volumen y
            base seca, en condiciones de refrencia de 25&deg;C, 101 325 pascales (1 atm) y 5% de (O2)
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

        <div style="text-align: center; margin-top: 30px;">
            <p>Firma Electrónica</p>

            <p>Escanea para verificar</p>
        </div>

    @include('pdf.recursos.footerCaratula')

        <!-- esto iria en mi segunda pagina  -->
    <div style="page-break-before: always;"></div>
    @include('pdf.recursos.headerCaratula')

        <table style="margin-top: 40px;margin-left: auto;">
            <tr>

                <td class="col-1">
                    Número de informe:<br>
                    Orden de servicio:<br>
                    Fecha de evaluación:<br>
                    Recepción:<br>
                    Fecha de informe:
                </td>
                <td class="col-2">
                    FE085MG/250405-01<br>
                    25-1347<br>
                    5-ABRIL-25<br>
                    6-ABRIL-25<br>
                    11-ABRIL-25
                </td>

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
        <table style="margin: 20px auto; text-align: center;">
            <tr>
                <td class="col-1">
                    C_R=20.9-0-R/<br>
                    20.9-0_M*C_M<br>
                </td>
                <td class="col-2">
                    CR=&nbsp; 20.9-5.0<br>
                    &nbsp;--------------<br>
                    &nbsp; 20.9-15.00<br>
                </td>
                <td class="col-2">
                    *
                </td>
                <td class="col-2">
                    8.06 = 21.73 ppmv
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


     <table width="100%" cellpadding="10">
        <tr>
            <td width="60%" valign="top">
                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <thead>
                        <tr >
                            <th>No.</th>
                            <th>Nox (ppmv)</th>
                            <th>CO (ppmv)</th>
                            <th>O2 (%)</th>
                            <th>CO (%)</th>
                            <th>TEMP (°C)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filas as $fila)
                        <tr>
                            <td>{{ $fila['no'] }}</td>
                            <td>{{ $fila['nox'] ?? '-' }}</td>
                            <td>{{ $fila['co'] ?? '-' }}</td>
                            <td>{{ $fila['o2'] ?? '-' }}</td>
                            <td>{{ $fila['co2'] ?? '-' }}</td>
                            <td>{{ $fila['temp'] ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
            <td width="40%" valign="top" style="vertical-align: top;">
                <div style="margin-bottom: 10px;">
                    <img src="{{ $imgNox }}" alt="Gráfico NOX" style="width: 100%; height: auto;">
                </div>
                <div style="margin-bottom: 10px;">
                    <img src="{{ $imgCo }}" alt="Gráfico CO" style="width: 100%; height: auto;">
                </div>
                <div style="margin-bottom: 10px;">
                    <img src="{{ $imgO2 }}" alt="Gráfico O2" style="width: 100%; height: auto;">
                </div>
                <div>
                    <img src="{{ $imgCo2 }}" alt="Gráfico CO2" style="width: 100%; height: auto;">
                </div>
            </td>
        </tr>
    </table>






    @include('pdf.recursos.footerGeneral')
    <div style="page-break-before: always;"></div>
     <!-- paginas 4 -->
    @include('pdf.recursos.headerGeneral')

    <h2>Hoja de Campo para la determinación de Gases de combustión</h2>
<p style="text-align:center">
    Para equipos de calentamiento indirecto de capacidad térmica mayor de 5.3 GJ/h o 150 C.C. combustible gaseoso
</p>
<div class="section">
    <table class="client-table ">
        <tr>
            <td class="label">Razón Social:</td>
            <td colspan="3">Empresa XYZ S.A. de C.V.</td>
        </tr>
        <tr>
            <td class="label">Calle y Número:</td>
            <td>Calle Falsa 123</td>
            <td class="label">Colonia:</td>
            <td>Centro</td>
        </tr>
        <tr>
            <td class="label">Municipio / Alcaldía:</td>
            <td>Benito Juárez</td>
            <td class="label">Estado:</td>
            <td>CDMX</td>
        </tr>
        <tr>
            <td class="label">Código Postal:</td>
            <td>03100</td>
            <td class="label">Teléfono:</td>
            <td>5555-1234</td>
        </tr>
        <tr>
            <td class="label">Responsable:</td>
            <td>Ing. Juan Pérez</td>
            <td class="label">Cargo:</td>
            <td>Jefe de Mantenimiento</td>
        </tr>
    </table>
</div>
<div class="section">
    <table class="client-table">
        <tr>
            <td class="label">Equipo Evaluado:</td>
            <td>Caldera Industrial</td>
            <td class="label">Marca y Modelo:</td>
            <td>ABC123</td>
        </tr>
        <tr>
            <td class="label">Combustible Utilizado:</td>
            <td>Gas Natural</td>
            <td class="label">Año:</td>
            <td>2023</td>
        </tr>
        <tr>
            <td class="label">Capacidad Térmica Nominal:</td>
            <td colspan="3">6.0 GJ/h</td>
        </tr>
    </table>
</div>
<div class="section">
    <table class="client-table">
        <tr>
            <td class="label">Geometría del conducto:</td>
            <td>Redonda</td>
            <td class="label">Diámetro interior:</td>
            <td>0.45 m</td>
        </tr>
        <tr>
            <td class="label">Núm. de puertos:</td>
            <td>2</td>
            <td class="label">Distancia A (m):</td>
            <td>1.5</td>
        </tr>
        <tr>
            <td class="label">Distancia B (m):</td>
            <td>2.0</td>
            <td class="label">Distancia C (m):</td>
            <td>3.0</td>
        </tr>
        <tr>
            <td class="label">Número de puntos seleccionados:</td>
            <td colspan="3">12</td>
        </tr>
    </table>
</div>
<div class="section">
    <table class="client-table">
        <tr>
            <td class="label">Zona geográfica:</td>
            <td>Valle de México</td>
            <td class="label">Presión Estática:</td>
            <td>0.12 inH2O</td>
        </tr>
        <tr>
            <td class="label">Altitud (msnm):</td>
            <td>2240</td>
            <td class="label">Presión Barométrica:</td>
            <td>610 mmHg</td>
        </tr>
    </table>
</div>
<div class="title">Determinación de la estratificación</div>

<table class="client-table">
    <thead>
        <tr>
            <th rowspan="2">Analito</th>
            <th rowspan="2">Marcado de la sonda (m)</th>
            <th rowspan="2">Concentración<br>(ppm o %vol.)</th>
            <th colspan="2">% Estratificación</th>
        </tr>
        <tr>
            <th>%</th>
            <th>ppm</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="3"><strong style="color:#007bff">NOx</strong></td>
            <td>0.03</td>
            <td>8.1</td>
            <td>4.33</td>
            <td>0.37</td>
        </tr>
        <tr>
            <td>0.075</td>
            <td>8.4</td>
            <td>0.79</td>
            <td>0.07</td>
        </tr>
        <tr>
            <td>0.13</td>
            <td>8.9</td>
            <td>5.12</td>
            <td>0.43</td>
        </tr>
        <tr>
            <td><strong>Promedio</strong></td>
            <td></td>
            <td>8.47</td>
            <td><strong>Máximo</strong></td>
            <td>0.43</td>
        </tr>
    </tbody>
</table>

<table class="no-border">
    <tr><td><strong>Cp.</strong> Concentración promedio (ppmv o %vol.)</td></tr>
    <tr><td><strong>Cm.</strong> Concentración medida (ppmv o %vol.)</td></tr>
    <tr><td><strong>16.7%</strong> Distancia donde se tomará la primer medición</td></tr>
    <tr><td><strong>50%</strong> Distancia donde se tomará la segunda medición</td></tr>
    <tr><td><strong>83.3%</strong> Distancia donde se tomará la tercera medición</td></tr>
</table>

<table>
    <thead>
        <tr><th colspan="3">Clasificación de Estratificación</th></tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>No Estratificada</strong></td>
            <td>a) ≤ 5%<br>b) ≤ 0.5 ppmv</td>
            <td>1 punto de muestreo</td>
        </tr>
        <tr>
            <td><strong>Mínimamente Estratificada</strong></td>
            <td>a) >5% y hasta 10%<br>b) >0.5 ppmv a 1 ppm</td>
            <td>3 puntos de muestreo</td>
        </tr>
        <tr>
            <td><strong>Estratificada</strong></td>
            <td>a) >10%<br>b) >1 ppmv</td>
            <td>12 puntos de muestreo</td>
        </tr>
    </tbody>
</table>

<table class="client-table">
    <thead>
        <tr>
            <th>Punto</th>
            <th>Estratificada</th>
            <th>Mínimamente Estratificada</th>
            <th>No Estratificada</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 1; $i <= 12; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td>N.A.</td>
                <td>N.A.</td>
                <td>{{ $i == 1 ? '0.08' : '' }}</td>
            </tr>
        @endfor
    </tbody>
</table>

<table class="no-border">
    <tr><td><strong>Conclusión:</strong> No Estratificada</td></tr>
    <tr><td>-------</td></tr>
    <tr><td>-------</td></tr>
</table>

<p style="text-align:center;"><i>Estratificación = ((Cp - Cm) / Cp) * 100</i></p>

<p><strong>Método:</strong> 7E EPA-2008 – Determinación de óxidos de nitrógeno. Método de quimiluminiscencia.</p>

<table class="no-border">
    <tr>
        <td><strong>SIGNATARIO:</strong> Edgar Daniel Flores García</td>
        <td><strong>INGENIERO DE SERVICIO:</strong> Juan Ángel García Flores</td>
        <td><strong>REVISIÓN:</strong> Cristian Giovani Jiménez Gómez</td>
    </tr>
</table>

<p><strong>OBSERVACIONES:</strong> Ninguna.</p>


<div class="section">
    <p class="label">Conclusión:</p>
    <p>El equipo cumple con los parámetros establecidos por la NOM-085.</p>
</div>
<div class="section">
    <p class="label">Firmas:</p>
    <ul>
        <li>Juan Pérez</li>
        <li>Ana Gómez</li>
        <li>Carlos Ramírez</li>
    </ul>
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
