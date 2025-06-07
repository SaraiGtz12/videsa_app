@extends('../Layout/Layout')
@section('DataTablecss')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('AgregarUsuarios')

    @if (session('success'))
        <input id="ConfirmacionUser" value="true" type="hidden">
    @endif

    @if ($errors->has('error'))
        <input id="errorUser" value="true" type="hidden">
    @endif

    <div class="container rounded shadow bg-white p-4 mb-4">
        <div class="text-center">
            <h3>Registrar Usuarios</h3>
        </div>
        <form action="{{route('RegistrarUsuario')}}" method="post">
            @csrf
            <div class="card mb-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Datos del Usuario</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Nombre(s)</span>
                                <input type="text" name="nombreP" id="nombreP" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <span>Apellido Paterno</span>
                                <input type="text" name="apellidoPP" id="apellidoPP" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <span>Apellido Materno</span>
                                <input type="text" name="apellidoMP" id="apellidoMP" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Selecciona un rol</span>
                                <select name="rolP" id="rolP" class="form-select" required>
                                    <option value="">Selecciona un rol</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{$rol->idRol}}">{{$rol->rol}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <span>Correo de la Empresa</span>
                                <input type="text" name="UsuarioP" id="UsuarioP" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <span>Contraseña</span>
                                <input type="password" name="ContrasenaP" id="ContrasenaP" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid mt-3">
                        <input type="submit" value="Registrar" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('Scripts')
    <script src="{{asset('js/Alertas/confirmaciones.js')}}"></script>
    <script src="{{asset('js/Alertas/Errores.js')}}"></script>
@endsection