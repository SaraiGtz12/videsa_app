@extends('../Layout/Layout')
@section('DataTablecss')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('AgregarNorma')
   

    <div class="mb-3 text-right">
        <button id="btnMostrarFormulario" class="btn btn-success" data-toggle="modal" data-target="#modalFormularioNorma">
            <i class="fas fa-plus"></i> Agregar Norma
        </button>
    </div>


     <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Normas Registradas</h4>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($normas as $norma)
                                    <tr>
                                        <td>{{ $norma->id_norma }}</td>
                                        <td>{{ $norma->codigo }}</td>
                                        <td>{{ $norma->nombre }}</td>
                                        <td>{{ $norma->descripcion }}</td>
                                        <td>
                                            <button 
                                                class="btn btn-primary btn-sm btn-circle btnEditarNorma"
                                                title="Editar"
                                                data-id="{{ $norma->id_norma }}"
                                                data-codigo="{{ $norma->codigo }}"
                                                data-nombre="{{ $norma->nombre }}"
                                                data-descripcion="{{ $norma->descripcion }}"

                                                data-toggle="modal"
                                                data-target="#modalFormularioNorma"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-circle btnEliminarNorma" data-id="{{ $norma->id_norma }}" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
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

    <div class="modal fade" id="modalFormularioNorma" tabindex="-1" role="dialog" aria-labelledby="tituloModalNorma" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <form action="{{ route('norma.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="tituloModalNorma">Registrar Norma</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="id" id="id_norma">
                    <div class="col">
                        <div class="mb-2">
                            <span>Código</span>
                            <input type="text" name="codigo" id="codigo" class="form-control" onkeyup="this.value=numeros(this.value)" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-2">
                            <span>Nombre</span>
                            <input type="text" name="nombre" id="nombre" class="form-control" onkeyup="this.value=normas(this.value)" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                            <span>Descripción</span>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" onkeyup="this.value=textos(this.value)" required>
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



    

@endsection

@push('Scripts')
    <script src="{{asset('js/Formularios/script.js')}}"></script>
    <script src="{{asset('js/DataTables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/DataTables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/DataTables/datatables-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/Formularios/Validaciones.js')}}"></script>

    <script>
        const RUTA_UPDATE_NORMA = "{{ route('norma.update') }}";
         const CSRF_TOKEN = "{{ csrf_token() }}";
    </script>

    <script src="{{ asset('js/normas/normas.js') }}"></script>
   
@endpush