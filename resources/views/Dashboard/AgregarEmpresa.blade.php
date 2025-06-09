@extends('../Layout/Layout')
@section('AgregarEmpresa')
    <div class="container rounded shadow p-4 mb-4 bg-white">
        <div class="text-center">
            <h3>Registrar Empresa</h3>
        </div>
       <form action="{{ route('empresa.store') }}" method="POST">
            @csrf
              <div class="card mb-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Datos del Cliente</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Razón Social</span>
                                <input type="text" name="razon_social" id="razon_social" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Calle</span>
                                <input type="text" name="calle" id="calle" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Número</span>
                                <input type="text" name="numero" id="numero" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Colonia</span>
                                <input type="text" name="colonia" id="colonia" class="form-control" required>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Alcaldia o Municipio</span>
                                <input type="text" name="alcaldia" id="alcaldia" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Estado</span>
                                <input type="text" name="estado" id="estado" class="form-control" required>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>C.P</span>
                                <input type="text" name="cp" id="cp" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>RFC</span>
                                <input type="text" name="rfc" id="rfc" class="form-control" required>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Teléfono</span>
                                <input type="text" name="telefono" id="telefono" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Correo</span>
                                <input type="email" name="correo" id="correo" class="form-control" required>
                            </div>
                        </div>
                    </div>

              
                   <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('Scripts')
    <script src="{{asset('js/Formularios/script.js')}}"></script>
@endsection