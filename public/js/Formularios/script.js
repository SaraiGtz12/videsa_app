$(document).ready(function () {
    console.log("JQuery Listo");
    $("#NumServicios").click(function () {
        let cantidad = $("#Cantidad").val();
        $("#ContenidoServicio").empty(); // Limpiar contenido previo

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
                            <option value="">Selecciona un Servicio</option>
                            <option value="1">NOM025</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <div class="mb-4">
                            <span>Descripción del Servicio</span>
                            <textarea name="Descripcion" id="Descripcion_${i}" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            `;
            $("#ContenidoServicio").append(nuevoElemento);
        }
    });

    $("#BuscarMuestreador").click(function() {
        let cantidad = $('#NumMuetreador').val();
        $("#Muestreadores").empty();

        // Realiza la solicitud AJAX para obtener los muestreadores
        $.ajax({
            url: '/getMuestreadores',
            method: 'GET',
            success: function(response) {
                let muestreadores = response.data || response; // Ajusta según la estructura de la respuesta

                for (let i = 0; i < cantidad; i++) {
                    let options = '<option value="">Seleccionar un Muestreador</option>';
                    if (Array.isArray(muestreadores)) {
                        muestreadores.forEach(function(muestreador) {
                            options += `<option value="${muestreador.idUser}">${muestreador.name} ${muestreador.lastName} ${muestreador.secondLastName}</option>`;
                        });
                    } else {
                        console.error('La respuesta no es un array:', muestreadores);
                    }

                    let nuevoElemento = `
                    <div class="mb-2">
                        <label class="form-label">Muestreador</label>
                        <select class="form-select" name="muestreador[]" id="muestreado_${i}">
                            ${options}
                        </select>
                    </div>
                    `;
                    $("#Muestreadores").append(nuevoElemento);
                }
            },
            error: function(error) {
                console.error('Error al cargar los muestreadores:', error);
            }
        });
    });
});
