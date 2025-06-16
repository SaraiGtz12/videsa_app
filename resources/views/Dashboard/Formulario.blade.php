@extends('../Layout/Layout')
@section('DataTablecss')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('Formulario')
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Servicios Registrados</h4>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Orden de Servicio</th>
                                    <th>Norma</th>
                                    <th>Descripcion</th>
                                    <th>Fecha de Evaluación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($ordenes as $index => $orden)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $orden->numero_servicio }}</td>
                                    <td>{{ $orden->nombre_norma ?? '---' }}</td>
                                    <td>{{ $orden->descripcion ?? '---' }}</td>
                                    <td>{{ $orden->fecha_registro ?? '---'  }}</td>
                                    <td>
                                       <button 
                                            class="btn btn-success btn-sm btn-circle btnModalFormulario"
                                            data-id_datos_servicio="{{ $orden->id_datos_servicio }}"
                                            data-razon_social="{{ $orden->razon_social }}"
                                            data-calle="{{ $orden->calle }}"
                                            data-numero="{{ $orden->numero }}"
                                            data-colonia="{{ $orden->colonia }}"
                                            data-ciudad="{{ $orden->ciudad }}"
                                            data-estado="{{ $orden->estado }}"
                                            data-codigo_postal="{{ $orden->codigo_postal }}"
                  
                                            title="Abrir Formulario"085
                                        ><i class="fas fa-edit"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div class="modal fade" id="ModalFormulario" tabindex="-1" role="dialog" aria-labelledby="tituloModalCliente" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
               <form action="">
          
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloFormulario">Formulario de Muestreo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Fecha de Evaluación</span>
                                            <input type="date" name="fecha_evaluacion" id="fecha_evaluacion" class="form-control" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-success">Datos de Cliente</h6>
                                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#DatosCliente">
                                    Ver detalle
                                </button>
                            </div>

                            <div class="collapse" id="DatosCliente">
                                <div style="overflow-x:auto; max-height:400px;" class="p-3">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <label for="razon_social">Razón Social</label>
                                            <input type="text" name="razon_social" id="razon_social" class="form-control" required readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label for="calle">Calle</label>
                                            <input type="text" name="calle" id="calle" class="form-control" required readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="numero">Número</label>
                                            <input type="number" name="numero" id="numero" class="form-control" required readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="colonia">Colonia</label>
                                            <input type="text" name="colonia" id="colonia" class="form-control" required readonly>
                                        </div>
                                    </div>

                                     <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label for="calle">Alcaldía</label>
                                            <input type="text" name="ciudad" id="ciudad" class="form-control" required readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="numero">Estado</label>
                                            <input type="text" name="estado" id="estado" class="form-control" required readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="colonia">Código Postal</label>
                                            <input type="text" name="codigo_postal" id="codigo_postal" class="form-control" required readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label for="responsable">Responsable</label>
                                            <input type="text" name="responsable" id="responsable" class="form-control"required readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="cargo">Cargo</label>
                                            <input type="text" name="cargo" id="cargo" class="form-control"required readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="numero">Telefono</label>
                                            <input type="text" name="telefono" id="telefono" class="form-control"required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-success">Datos del equipo</h6>
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
                                            <input type="number" name="anio" id="anio" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Capacidad Térmica Nominal</span>
                                            <input type="number" name="capacidad_termica" id="capacidad_termica" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Altura al nivel de mar</span>
                                            <input type="number" name="altura" id="altura" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Presión Estática</span>
                                            <input type="number" step="0.01" name="presion_estatica" id="presion_estatica" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-success">Otros datos</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Geometría del Conducto</span>
                                            <select name="geometria_conductor" id="geometria_conductor" class="form-select" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="Circular">Circular</option>
                                                <option value="Rectangular">Rectangular</option>
                                                <option value="Cuadrada">Cuadrada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Diametrio interior del Conducto Derecho</span>
                                            <input type="number" step="0.01" name="diametro_i_d" id="diametro_i_d" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Largo transversal, L1</span>
                                            <input type="number" step="0.01" name="largo_trasversal" value="0" id="largo_trasversal" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Ancho Transversal, L2</span>
                                            <input type="number" step="0.01" name="ancho_transversal" value="0" id="ancho_transversal" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Diametro equivalente, Deq.</span>
                                            <input type="number" step="0.01" name="diametro_equivalente" value="0" id="diametro_equivalente" class="form-control" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Números de Puertos</span>
                                            <input type="number" name="num_puerto" id="num_puerto" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Distancia A</span>
                                            <input type="number" step="0.01" name="d_a" value="0" id="d_a" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Distancia B</span>
                                            <input type="number" step="0.01" name="d_b" value="0" id="d_b" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Distancia C</span>
                                            <input type="number" step="0.01" name="d_c" value="0" id="d_c" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Número de diametros en A</span>
                                            <input type="number" step="0.01" name="num_d_a" id="num_d_a" class="form-control" value="0" readonly required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Número de diametros en B</span>
                                            <input type="number" step="0.01" name="num_d_b" id="num_d_b" class="form-control" value="0" readonly required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Número de diametros en C</span>
                                            <input type="number" step="0.01" name="num_d_c" id="num_d_c" class="form-control" value="0" readonly required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2">
                                            <span>Extención del Puerto</span>
                                            <input type="number" step="0.01" name="extencion_puerto" id="extencion_puerto" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-2">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-success">Captura de Datos de Campo</h6>
                                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#tablaMuestreo">
                                            Mostrar / Ocultar
                                        </button>
                                    </div>
                                    <div class="collapse" id="tablaMuestreo">
                                        <div class="card-body">
                                            <div style="overflow-x:auto; max-height:400px;">
                                                <table class="table table-bordered table-sm text-center align-middle">
                                                    <thead class="table-primarsuccess sticky-top">
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
                                                            <td><input type="number" step="0.01" name="nox[]" class="form-control form-control-sm" value="1" required></td>
                                                            <td><input type="number" step="0.01" name="co[]" class="form-control form-control-sm" value="1" required></td>
                                                            <td><input type="number" step="0.01" name="o2[]" class="form-control form-control-sm" value="1" required></td>
                                                            <td><input type="number" step="0.01" name="co2[]" class="form-control form-control-sm" value="1" required></td>
                                                            <td><input type="number" step="0.1" name="temp[]" class="form-control form-control-sm" value="1" required></td>
                                                        </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('Scripts')
    <script src="{{asset('js/Formularios/script.js')}}"></script>
    <script src="{{asset('js/Formularios/formulas.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush