$(document).ready(function(){
    $('#ancho_transversal').prop('readonly', true);
    $('#largo_trasversal').prop('readonly', true);

    $("#ancho_transversal").change(function(){
        let geometria = $("#geometria_conductor").val();
        let ancho_transversal = parseFloat($("#ancho_transversal").val());
        let largo_transversal = parseFloat($("#largo_trasversal").val());

        if(geometria == "Rectangular" || geometria == "Cuadrada"){
            let $resultado = ((2*largo_transversal * ancho_transversal) / (largo_transversal + ancho_transversal));
            $("#diametro_equivalente").val($resultado);
        }
    });

    $("#geometria_conductor").change(function(){
        let geometria = $("#geometria_conductor").val();
        if(geometria == "Circular"){
            $('#ancho_transversal').prop('readonly', true);
            $('#largo_trasversal').prop('readonly', true);
        }else{
            $('#ancho_transversal').prop('readonly', false);
            $('#largo_trasversal').prop('readonly', false);
        }
    });

    $("#d_a").change(function(){
        let geometria = $("#geometria_conductor").val();
        let distancia_a = parseFloat($("#d_a").val());
        
        if(geometria == "Circular"){

            let diametro_int = parseFloat($("#diametro_i_d").val());
            let resultado = distancia_a/diametro_int;
            $("#num_d_a").val(resultado);

        }
        // else{
        //     let diametro_eq = parseFloat($("#diametro_equivalente").val());
        //     let resultado = distancia_a/diametro_eq;
        //     $("#num_d_a").val(resultado);
        // }
    });

    $("#d_b").change(function(){
        let geometria = $("#geometria_conductor").val();
        let distancia_a = parseFloat($("#d_b").val());
        
        if(geometria == "Circular"){

            let diametro_int = parseFloat($("#diametro_i_d").val());
            let resultado = distancia_a/diametro_int;
            $("#num_d_b").val(resultado);

        }
        // else{
        //     let diametro_eq = parseFloat($("#diametro_equivalente").val());
        //     let resultado = distancia_a/diametro_eq;
        //     $("#num_d_b").val(resultado);
        // }
    });

    $("#d_c").change(function(){
        let geometria = $("#geometria_conductor").val();
        let distancia_a = parseFloat($("#d_c").val());
        
        if(geometria == "Circular"){

            let diametro_int = parseFloat($("#diametro_i_d").val());
            let resultado = distancia_a/diametro_int;
            $("#num_d_c").val(resultado);

        }
        //else{
        //     let diametro_eq = parseFloat($("#diametro_equivalente").val());
        //     let resultado = distancia_a/diametro_eq;
        //     $("#num_d_c").val(resultado);
        // }
    });

});