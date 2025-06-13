
$(document).ready(function () {
    $("#NumServicios").click(function () {
        let cantidad = $("#Cantidad").val();
        $("#ContenidoServicio").empty(); // Limpiar contenido previo
        let opcionesNormas = '<option value="">Selecciona un Servicio</option>';
            normas.forEach(norma => {
                opcionesNormas += `<option value="${norma.id_norma}">${norma.codigo}</option>`;
            });

        for (let i = 0; i < cantidad; i++) {
            
            
            let nuevoElemento = `
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Tipo de Servicio (NOM)</label>
                        <select class="form-select" name="Servicio[]" required>
                        ${opcionesNormas}
                    </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <div class="mb-4">
                            <label class="form-label">Descripción del Servicio</label>
                                <textarea name="Descripcion[]" id="Descripcion_${i}" class="form-control" rows="1"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            `;
            $("#ContenidoServicio").append(nuevoElemento);
        }
    });

});




 $(document).ready(function() {
        $('#Muestreador').select2({
            placeholder: 'Seleccione un muestreador',
            allowClear: true
        });
    });

$(document).on('click', '.btnModalFormulario', function () {
    const id_datos_servicio = $(this).data('id_datos_servicio');
    

    });