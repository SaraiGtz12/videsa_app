@extends('../Layout/Layout')
@section('AgregarNorma')
    <div class="container rounded shadow p-4 mb-4 bg-white">
        <div class="text-center">
            <h3>Registrar Empresa</h3>
        </div>
       <form action="{{ route('empresa.store') }}" method="POST">
            @csrf
              <div class="card mb-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Datos de la Norma</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Código</span>
                                <input type="text" name="codigo" id="codigo" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <span>Nombre</span>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <span>Descripción</span>
                                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
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



    <div>
    </div>

@endsection

@section('Scripts')
    <script src="{{asset('js/Formularios/script.js')}}"></script>
@endsection