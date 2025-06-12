@extends('../Layout.Layout')
@section('Home')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="{{ route('pdf.generar') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>

</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Servicios Realizados (Mes)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Servicios Activos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Servicios Pendientes
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col">
                                {{-- <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Servicios Inactivos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <div class="col">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Reportes Generados</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="max-height: 400px; max-width: 200px overflow-y: auto;">
                    <table class="table table-bordered table-hover" id="tablaReportes" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Norma</th>
                                <th>Orden de Servicio</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                            <tr>
                                {{-- <th><input type="text" placeholder="Buscar" /></th>
                                <th><input type="text" placeholder="Buscar" /></th>
                                <th><input type="text" placeholder="Buscar" /></th>
                                <th><input type="text" placeholder="Buscar" /></th>
                                <th><input type="text" placeholder="Buscar" /></th>
                                <th><input type="text" placeholder="Buscar" /></th>
                                <th></th>  --}}
                            </tr>
                        </thead>

                        <tbody>
                            {{-- @foreach ($detalles as $detalle)
                                <tr>
                                    <td>{{$detalle->id}}</td>
                                    <td>{{$detalle->nom}}</td>
                                    <td>{{$detalle->codigo}}</td>
                                    <td>
                                        @if ($detalle->estado == 1)
                                            <span class="badge badge-success">
                                                Completado
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                Incompleto
                                            </span>
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-circle" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-circle" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

<script>
$(document).ready(function() {
    $('#tablaReportes thead tr:eq(1) th').each(function(i) {
        $('input', this).on('keyup change', function() {
            if ($('#tablaReportes').DataTable().column(i).search() !== this.value) {
                $('#tablaReportes').DataTable().column(i).search(this.value).draw();
            }
        });
    });

    $('#tablaReportes').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        language: {
            search: "Buscar general:",
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        }
    });
});
</script>
