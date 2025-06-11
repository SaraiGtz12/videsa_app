



@extends('../Layout/Layout')
@section('DataTablecss')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('AgregarEmpresa')
   

    <div class="mb-3 text-right">
        <button id="btnMostrarFormulario" class="btn btn-success" data-toggle="modal" data-target="#modalFormularioCliente">
            <i class="fas fa-plus"></i> Agregar Cliente
        </button>
         <button id="btnMostrarFormularioS" class="btn btn-primary" data-toggle="modal" data-target="#modalFormularioSucursal">
            <i class="fas fa-plus"></i> Agregar Sucursal
        </button>
    </div>
   


     <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Clientes Registrados</h4>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nombre</th>
                                    <th>RFC</th>
                                    <th>Fecha de Creación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->id }}</td>
                                        <td>{{ $cliente->razon_social}}</td>
                                        <td>{{ $cliente->rfc }}</td>
                                        <td>{{ $cliente->creado_en }}</td>
                                        <td>
                                            <button 
                                                class="btn btn-primary btn-sm btn-circle btnEditarCliente"
                                                title="Editar"
                                                data-id="{{ $cliente->id }}"
                                                data-razon_social="{{ $cliente->razon_social }}"
                                                data-rfc="{{ $cliente->rfc }}"
                                                data-telefono="{{ $cliente->telefono }}"
                                                data-correo="{{ $cliente->correo }}"

                                                data-toggle="modal"
                                                data-target="#modalFormularioCliente"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-circle btnEliminarCliente" data-id="{{ $cliente->id }}" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button 
                                                class="btn btn-info btn-sm btn-circle btnVerSucursales"
                                                data-id="{{ $cliente->id }}"
                                                title="Ver Sucursales"
                                            >
                                                <i class="fas fa-building"></i>
                                            </button>


                                           
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

    <div class="modal fade" id="modalFormularioCliente" tabindex="-1" role="dialog" aria-labelledby="tituloModalCliente" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <form action="{{ route('empresa.store') }}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloModalCliente">Registrar Empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <span>Razón Social</span>
                                    <input type="text" name="razon_social" id="razon_social" class="form-control" required>
                                </div>
                            </div>
                    
                        </div>

                    
                        <div class="row">
                            <input type="hidden" name="id" id="id">

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
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaltablaSucursales" tabindex="-1" role="dialog" aria-labelledby="tituloTablaSucursal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloTablaSucursal">Listado de Sucursales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <table class="table table-bordered" id="tablaListadoSucursales">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Alcaldía</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFormularioSucursal" tabindex="-1" role="dialog" aria-labelledby="tituloModalSucursal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <form action="">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="tituloModalSucursal">Registrar Sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="id_sucursal" id="id_sucursal">
                        <div class="col">
                            <div class="mb-2">
                                <select class="form-select select2" name="id_cliente" required>
                                    <option value="" selected disabled>Seleccionar Empresa</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Nombre</span>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Codigo</span>
                                <input type="text" name="codigo" id="codigo" class="form-control" required>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                         <div class="col">
                            <div class="mb-2">
                                <span>Calle</span>
                                <input type="text" name="calle" id="calle" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Número</span>
                                <input type="text" name="numero" id="numero" class="form-control" required>
                            </div>
                        </div>
                        
                        
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Colonia</span>
                                <input type="text" name="colonia" id="colonia" class="form-control" required>
                            </div>
                        </div>
                       
                        <div class="col">
                            <div class="mb-2">
                                <span>Alcaldia o Municipio</span>
                                <input type="text" name="alcaldia" id="alcaldia" class="form-control" required>
                            </div>
                        </div>
                       
                        
                    </div>

                    <div class="row">
                         <div class="col">
                            <div class="mb-2">
                                <span>Estado</span>
                                <input type="text" name="estado" id="estado" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>C.P</span>
                                <input type="text" name="cp" id="cp" class="form-control" required>
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
                        
                </div>
                <div class="modal-footer">
                 <button type="submit" class="btn btn-primary" id="btnGuardarSucursal">Guardar</button>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    



@endsection

@section('Scripts')
    <script src="{{asset('js/Formularios/script.js')}}"></script>
    <script src="{{asset('js/DataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/DataTables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/DataTables/datatables-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script>
        const RUTA_GUARDAR_SUCURSAL = "{{ route('empresa.guardarSucursal') }}";
        const RUTA_UPDATE_CLIENTE = "{{ route('empresa.update') }}";
         const CSRF_TOKEN = "{{ csrf_token() }}";
         
    </script>


    <script src="{{ asset('js/clientes/clientes.js') }}"></script>
@endsection