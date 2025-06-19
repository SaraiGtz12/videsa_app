
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



//ordenes de servicio
 $(document).ready(function() {
        $('#Muestreador').select2({
            placeholder: 'Seleccione un muestreador',
            allowClear: true
        });
    });





//Formulario de muestreo 
 $(document).ready(function () {
        const today = new Date().toISOString().split('T')[0];
        $('#fecha_evaluacion').val(today);
        
    });
$(document).on('click', '.btnModalFormulario', function () {
    const id_datos_servicio = $(this).data('id_datos_servicio');
    const razon_social = $(this).data('razon_social');
    const calle = $(this).data('calle');
    const numero = $(this).data('numero');
    const colonia = $(this).data('colonia');
    const ciudad = $(this).data('ciudad');
    const estado = $(this).data('estado');
    const codigo_postal = $(this).data('codigo_postal');
    const responsable = $(this).data('responsable');
    const cargo = $(this).data('cargo');
    const tel = $(this).data('tel');

    $('#razon_social').val(razon_social);
    $('#calle').val(calle);
    $('#numero').val(numero);
    $('#colonia').val(colonia);
    $('#ciudad').val(ciudad);
    $('#estado').val(estado);  
    $('#codigo_postal').val(codigo_postal);    
    $('#responsable').val(responsable);
    $('#cargo').val(cargo);
    $('#tel').val(tel);
        
    $('#ModalFormulario').modal('show');

    });