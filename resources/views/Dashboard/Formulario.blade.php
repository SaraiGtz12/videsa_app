@extends('../Layout/Layout')
@section('Formulario')
    <div class="container rounded shadow p-4 mb-4 bg-white">
        <div class="text-center">
            <h3>Formulario de Muestreo</h3>
        </div>
        <form action="">
            <div class="card mb-2">
                <!--Datos Cliente-->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Datos del Cliente</h6>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col">
                            <div class="mb-12">
                                <select class="form-select select2" style="width: 100%;">
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
                    <h6 class="m-0 font-weight-bold text-primary">Datos ...</h6>
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
                                <span>Diametrivs</span>
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
              
                    <div class="d-grid mt-4">
                        <input type="submit" value="Guardar" class="btn btn-primary">
                    </div>
                </div>
            </div>

              <div class="d-grid mt-4">
                        <input type="submit" value="Guardar" class="btn btn-primary">
                    </div>
        </form>
    </div>

@endsection

@section('Scripts')
    <script src="{{asset('js/Formularios/script.js')}}"></script>
@endsection