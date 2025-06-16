$(document).ready(function(){
    $(document).on('change', '#empresa', function(){
        let empresa = $(this).val();
        console.log('Los valores de la empresa son: ' + empresa)
        $('#sucursal').show();
        $.ajax({
            method: 'get',
            url: '/getSucursales/'+empresa,
            success: function(res){
                if(res.status == 'success'){
                    let opciones = "<option value=''>Selecciona una sucursal</option>";
                    let todas_sucursales = res.sucursales_obtenidas;
                    $.each(todas_sucursales, function(index, value){
                        opciones += "<option value='" + value.id_sucursal +"'>" + value.nombre + "</option>";
                    });
                    $("#sucursal").html(opciones);
                }
            }
        })
    });
});