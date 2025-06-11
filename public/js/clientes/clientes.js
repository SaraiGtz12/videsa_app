
document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btnEliminarNorma').forEach(btn => {
            btn.addEventListener('click', function () {
                const idNorma = this.getAttribute('data-id');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción desactivará la norma.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, desactivar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/norma/desactivar/${idNorma}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': CSRF_TOKEN,
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('¡Desactivado!', data.message, 'success').then(() => {
                                    location.reload(); 
                                });
                            } else {
                                Swal.fire('Error', 'No se pudo desactivar la norma.', 'error');
                            }
                        });
                    }
                });
            });
        });
    });

    document.querySelectorAll('.btnEditarCliente').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const razon_social = this.getAttribute('data-razon_social');
                const rfc = this.getAttribute('data-rfc');
                const telefono = this.getAttribute('data-telefono');
                const correo = this.getAttribute('data-correo');

                document.getElementById('id').value = id;
                document.getElementById('razon_social').value = razon_social;
                document.getElementById('rfc').value = rfc;
                document.getElementById('telefono').value = telefono;
                document.getElementById('correo').value = correo;

                document.getElementById('tituloModalCliente').innerText = 'Editar Cliente';
                document.querySelector('#modalFormularioCliente form').setAttribute('action', RUTA_UPDATE_CLIENTE);
                
            });
        });
$(document).on('click', '.btnVerSucursales', function () {
    const idCliente = $(this).data('id');
    $('#modaltablaSucursales').modal('show');
        console.log("ID Cliente:", idCliente); 
    $.ajax({
        url: `/empresa/sucursales/${idCliente}`,
        method: 'GET',
        success: function (sucursales) {
            const tbody = $('#tablaListadoSucursales tbody');
            tbody.empty();

            if (sucursales.length === 0) {
                tbody.append('<tr><td colspan="5" class="text-center">No hay sucursales registradas.</td></tr>');
            } else {
                sucursales.forEach((sucursal, index) => {
                    tbody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${sucursal.nombre}</td>
                            <td>${sucursal.codigo}</td>
                            <td>${sucursal.alcaldia || '---'}</td>
                            <td>
                                <button class="btn btn-primary btn-sm btn-circle"> <i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm btn-circle"><i class="fas fa-trash-alt"></i></button>


                            </td>
                        </tr>
                    `);
                });
            }

        },
        error: function () {
            Swal.fire('Error', 'No se pudieron obtener las sucursales.', 'error');
        }
    });
});

      