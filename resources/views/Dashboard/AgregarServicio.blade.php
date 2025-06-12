@extends('../Layout/Layout')
@section('AgregarServicio')
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
                    <livewire:sucursales-empresas />
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
                            <select name="Muestreador" id="Muestreador" class="form-control" required>
                                <option value="">Seleccione un muestreador</option>
                                @foreach ($muestreadores as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                  
                    </div>
                    <div id="Muestreadores"></div>
                    
                    <div class="d-grid mt-4">
                        <input type="submit" value="Registrar" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('Scripts')
    <script>
        const normas = @json($normas);
    </script>
    <script src="{{asset('js/Formularios/script.js')}}"></script>
    

@endsection