
document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btnEliminarCliente').forEach(btn => {
            btn.addEventListener('click', function () {
                const idCliente = this.getAttribute('data-id_cliente');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará al cliente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, desactivar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/empresa/desactivar/${idCliente}`, {
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
                                Swal.fire('Error', 'No se pudo Eliminar.', 'error');
                            }
                        });
                    }
                });
            });
        });
    });

document.querySelectorAll('.btnEditarCliente').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id_cliente');
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
        console.log("este es mi:", idCliente); 
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
                            <td>${sucursal.ciudad || '---'}</td>
                            <td>
                                <button 
                                    class="btn btn-primary btn-sm btn-circle btnEditarSucursal"
                                    data-id_sucursal="${sucursal.id_sucursal}"
                                    data-id_cliente="${sucursal.id_cliente}"
                                    data-nombre="${sucursal.nombre}"
                                    data-codigo="${sucursal.codigo}"
                                    data-calle="${sucursal.calle}"
                                    data-numero="${sucursal.numero}"
                                    data-colonia="${sucursal.colonia}"
                                    data-ciudad="${sucursal.ciudad}"
                                    data-estado="${sucursal.estado}"
                                    data-telefono="${sucursal.telefono}"
                                    data-codigo_postal="${sucursal.codigo_postal}"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>
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


$(document).on('click', '.btnEditarSucursal', function () {
    const id = $(this).data('id_sucursal');
    const id_cliente = $(this).data('id_cliente');
    const nombre = $(this).data('nombre');
    const codigo = $(this).data('codigo');
    const telefono = $(this).data('telefono');
    const calle = $(this).data('calle');
    const numero = $(this).data('numero');
    const colonia = $(this).data('colonia');
    const alcaldia = $(this).data('ciudad');
    const estado = $(this).data('estado');
    const cp = $(this).data('codigo_postal');

    $('#id_sucursal').val(id);
    $('#id_cliente').val(id_cliente).trigger('change');
    $('#nombre').val(nombre);
    $('#codigo').val(codigo);
    $('#calle').val(calle);
    $('#numero').val(numero);
    $('#colonia').val(colonia);
    $('#alcaldia').val(alcaldia);
    $('#estado').val(estado);
    $('#cp').val(cp);
    $('#telefono').val(telefono);

    $('#tituloModalCliente').text('Editar Sucursal');
    $('#modalFormularioSucursal form').attr('action', RUTA_UPDATE_SUCURSAL);
    $('#modalFormularioSucursal').modal('show');
});

