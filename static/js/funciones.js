//Funciones jQuery
$(function(){


    //Dónde se usa:
    //En la vista (resumen_pedido.php)
    //Para que se usa:
    //Para saber cual botón del formulario (frmAccionReumenPedido) se presionó y así establecer el valor de la acción a realizar al campo oculto llamado acción,
    //el cual es usado para una validación antes de enviar el formulario al ervidor
    $('#btnFinalizar').click(function() {
        $('#accion').val("finalizar");
    });


    //Dónde se usa:
    //En la vista (resumen_pedido.php)
    //Para que se usa:
    //Para saber cual botón del formulario (frmAccionReumenPedido) se presionó y así establecer el valor de la acción a realizar al campo oculto llamado acción,
    //el cual es usado para una validación antes de enviar el formulario al ervidor
    $('#btnCancelar').click(function() {
        $('#accion').val("cancelar");
    });


    //Dónde se usa:
    //En la vista (resumen_pedido.php) para el formulario llamado frmAccionReumenPedido,
    //Para que se usa:
    //Su función consiste en validar si el importe del pedido es mayor al importe de venta minima, en caso afirmativo se permite
    //el submit del formulario, caso contrario, se impide que el formulario haga el sumnit y muestra el mensaje de aviso correspondiente.
    //También valida que se registre un comentario como obligatorio
    $("#frmAccionReumenPedido").submit(function( event ) {

        var comentario=$("#comentario").val();
        var accion=$("#accion").val();
        //alert(accion);
        if (accion=="finalizar")
        {

            var importe_min_venta=$("#importe_min_venta").val();
            var importe_pedido=$("#importe").val();

            //Si el importe del pedido es menor a la venta mímima requerida, impedimos que se mande el formulario al servidor
            if (parseFloat(importe_pedido) < parseFloat(importe_min_venta)) {
                    $("#msj_vta_min").addClass('alert alert-danger');
                    $("#msj_vta_min").text( "El pedido NO cumple con el mínimo de venta antes de iva, favor de agregar más partidas." ).show();
                    event.preventDefault();
            }

            //Si el campo del comentario está vacio, impedimos que se mande el formulario al servidor
            if (comentario == "") {
                    $("#msj_vta_min").addClass('alert alert-danger');
                    $("#msj_vta_min").text( "Favor de registrar un comentario." ).show();
                    $("#comentario").focus();
                    event.preventDefault();
            }

        }

    });


    //Dónde se usa:
    //En la vista (pedido_encabezado.php) en la tabla con el identificador tbProductos
    //Para que se usa:
    //Su función consiste en leer los valores de clave y cantidad del registros seleccionado
    //de la tabla y mostrarlos sobre los input correspondientes al hacer click en el elemeto a.
    $('#tbProductos').on('click','a',function (e){
        e.preventDefault();

        var clave=$(this).parent().parent().children('td:eq(0)').text().trim();
        var multiploVenta =$(this).parent().parent().children('td:eq(4)').text().trim();

        $("#clave").val(clave);//asignamos el valor de la primer columna (articulo) al campo clave
        $("#cantidad").attr("placeholder",multiploVenta);//asignamos el valor de la cantidad como marca de agua al campo cantidad
        $("#cantidad").focus();
    });


});



