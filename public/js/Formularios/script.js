
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
                <div class="col-md-4">
                    <div class="mb-2">
                        <label class="form-label">Puntos o Equipos a Evaluar</label>
                        <input type="number" name="Puntos[]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label class="form-label">Tipo de Servicio (NOM)</label>
                        <select class="form-select" name="Servicio[]" required>
                        ${opcionesNormas}
                    </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <div class="mb-4">
                            <span>Descripción del Servicio</span>
                                <textarea name="Descripcion[]" id="Descripcion_${i}" class="form-control" rows="3"></textarea>
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