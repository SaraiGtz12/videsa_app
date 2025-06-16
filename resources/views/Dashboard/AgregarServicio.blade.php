@extends('../Layout/Layout')
@section('DataTablecss')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="/path/to/select2.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('AgregarServicio')
    @if (session('success'))
        <input id="ConfirmacionOrden" value="true" type="hidden">
    @endif

    @if ($errors->has('error'))
        <input id="errorOrden" value="true" type="hidden">
    @endif

    <div class="container rounded shadow p-4 mb-4 bg-white">
        <div class="text-center">
            <h3>Registrar Orden de Servicio</h3>
        </div>
        <form action="{{ route('servicio.guardar') }}" method="POST">
                @csrf
            <div class="card mb-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Datos del Cliente</h6>
                </div>
                <div class="card-body">
                    {{-- <livewire:sucursales-empresas /> --}}
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <span>Seleccionar Cliente</span>
                                <select name="empresa" id="empresa" class="form-select select2" required>
                                    <option value="">Selecciona un cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{$cliente->id_cliente}}">{{$cliente->razon_social}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <span>Seleccionar una Sucursal</span>
                                <select name="sucursal" id="sucursal" class="form-select select2" required>
                                    <option value="">Selecciona una sucursal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Nombre del Responsable</label>
                                <input type="text" name="nombre_responsable" id="nombre_responsable" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Cargo del Responsable</label>
                                <input type="text" name="cargo_responsable" id="cargo_responsable" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Numero de telefono</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <!--Datos Servicio-->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Datos del Servicio</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Número de Servicios</span>
                                <input type="number" name="Cantidad" id="Cantidad" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-grid mb-2 mt-4">
                                <span></span>
                                <button class="btn btn-info" type="button" id="NumServicios">Agregar Servicios</button>
                            </div>
                        </div>
                    </div>
                    <div id="ContenidoServicio"></div>
                    
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Información Adicional</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Fecha de Muestreo</span>
                                <input type="date" name="FechaMuestreo" id="FechaMuestreo" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <span>Muestrador</span>
                            <select name="Muestreador" class="form-select select2" required>
                                <option value="">Seleccione un muestreador</option>
                                @foreach ($muestreadores as $usuario)
                                    <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="d-grid mt-4">
                        <input type="submit" value="Registrar" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('Scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const normas = @json($normas);
    </script>
    <script src="{{asset('js/Formularios/script.js')}}"></script>
    <script src="{{asset('js/Alertas/confirmaciones.js')}}"></script>
    <script src="{{asset('js/Alertas/Errores.js')}}"></script>

    <script src="{{asset('js/Formularios/selectEmpresas.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        });
    </script>

@endpush