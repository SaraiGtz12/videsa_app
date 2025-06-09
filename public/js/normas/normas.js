
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

    document.querySelectorAll('.btnEditarNorma').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const codigo = this.getAttribute('data-codigo');
                const nombre = this.getAttribute('data-nombre');
                const descripcion = this.getAttribute('data-descripcion');

                document.getElementById('id_norma').value = id;
                document.getElementById('codigo').value = codigo;
                document.getElementById('nombre').value = nombre;
                document.getElementById('descripcion').value = descripcion;

                document.getElementById('tituloModalNorma').innerText = 'Editar Norma';
                document.querySelector('#modalFormularioNorma form').setAttribute('action', RUTA_UPDATE_NORMA);
                
            });
        });

        