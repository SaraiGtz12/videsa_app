@extends('../Layout/Layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@section('Formulario')
    <div class="container rounded shadow p-4 mb-4 bg-white">
        <div class="text-center">
            <h3>Formulario de Muestreo</h3>
        </div>
        <form action="{{ route('registrar_nom085_mg') }}" method="POST">
            @csrf
            <div class="card mb-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Datos del Cliente</h6>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Fecha de Evaluación</span>
                                <input type="date" name="fecha_evaluacion" id="fecha_evaluacion" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-12">
                                <span>Seleccionar Empresa a evaluar</span>
                                <select class="form-select select2" name="empresa" style="width: 100%;">
                                    <option value="" selected disabled>Seleccionar Empresa</option>
                                    <option value="Cliente1">Cliente 1</option>
                                    <option value="Cliente2">Cliente 2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Datos del equipo</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Equipo Evaluado</span>
                                <input type="text" name="equipo_evaluado" id="equipo_evaluado" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Marca y Modelo</span>
                                <input type="text" name="marca" id="marca" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Combustible Utilizado</span>
                                <input type="text" name="combustible_utilizado" id="combustible_utilizado" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Año</span>
                                <input type="text" name="anio" id="anio" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Capacidad Térmica Nominal</span>
                                <input type="text" name="capacidad_termica" id="capacidad_termica" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Altura al nivel de mar</span>
                                <input type="text" name="altura" id="altura" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Presión Estática</span>
                                <input type="text" name="presion_estatica" id="presion_estatica" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Presión Barométrica</span>
                                <input type="text" name="presion_barometrica" id="presion_barometrica" class="form-control" required>
                            </div>
                        </div>
                    </div>
              
                  
                </div>
            </div>
             <div class="card mb-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Otros datos</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Geometría del Conducto</span>
                                <input type="text" name="geometria_coductor" id="geometria_coductor" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Diametrio interior del Conducto Derecho</span>
                                <input type="text" name="diametro_i_d" id="diametro_i_d" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                           <div class="mb-2">
                                <span>Número de puntos para medición de gases</span>
                                <input type="text" name="num_medicion_gases" id="num_medicion_gases" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Diametro equivalente, Deq.</span>
                                <input type="text" name="diametro_equivalente" id="diametro_equivalente" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Largo transversal, L1</span>
                                <input type="text" name="largo_trasversal" id="largo_trasversal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Ancho Transversal, L2</span>
                                <input type="text" name="ancho_transversal" id="ancho_transversal" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Números de Puertos</span>
                                <input type="text" name="num_puerto" id="num_puerto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Distancia A</span>
                                <input type="text" name="d_a" id="d_a" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Distancia B</span>
                                <input type="text" name="d_b" id="d_b" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Distancia C</span>
                                <input type="text" name="d_c" id="d_c" class="form-control" required>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Número de diametros en A</span>
                                <input type="text" name="num_d_a" id="num_d_a" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Número de diametros en B</span>
                                <input type="text" name="num_d_b" id="num_d_b" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Número de diametros en C</span>
                                <input type="text" name="num_d_c" id="num_d_c" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Captura de Datos de Campo</h6>
                            <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#tablaMuestreo">
                                Mostrar / Ocultar
                            </button>
                        </div>
                        <div class="collapse" id="tablaMuestreo">
                            <div class="card-body">
                                <div style="overflow-x:auto; max-height:400px;">
                                    <table class="table table-bordered table-sm text-center align-middle">
                                        <thead class="table-primary sticky-top">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nox (ppmv)</th>
                                                <th>CO (ppmv)</th>
                                                <th>O2 (%)</th>
                                                <th>CO (%)</th>
                                                <th>TEMP (°C)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 1; $i <= 10; $i++)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td><input type="number" step="0.01" name="nox[]" class="form-control form-control-sm"></td>
                                                <td><input type="number" step="0.01" name="co[]" class="form-control form-control-sm"></td>
                                                <td><input type="number" step="0.01" name="o2[]" class="form-control form-control-sm"></td>
                                                <td><input type="number" step="0.01" name="co2[]" class="form-control form-control-sm"></td>
                                                <td><input type="number" step="0.1" name="temp[]" class="form-control form-control-sm"></td>
                                            </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
        </form>
    </div>
@endsection
@section('Scripts')
    <script src="{{asset('js/Formularios/script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection