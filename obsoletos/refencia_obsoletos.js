
    //Función usada en la vista (resumen_pedido.php) para el formulario llamado frmResumenPedido, su función consiste
    //en validar si el valor del importe del pedido es mayor al importe de la venta mímina del pedido, en caso de que si
    //se procesa el formulario, en caso contrario impide que el formulario haga el sumnit y muestra el mensaje de aviso
    /*
    $("#frmAccionReumenPedido").submit(function( event ) {

        var importe_min_venta=$("#importe_min_venta").val();
        var importe_pedido=$("#importe").val();

        if (parseFloat(importe_pedido) > parseFloat(importe_min_venta)) {
            $( "span" ).text( "Validando..." ).show();
            //la validación es correcta, se puede enviar el formulario
            return;
        }
        else
        {//la validación no es correcta, no se puede enviar el formulario y se muestra mensaje de aviso
            $( "span" ).text( "El pedido NO cumple con el mínimo de venta antes de iva, agregar mas partidas." ).show();
                event.preventDefault();
        }
    });
    */