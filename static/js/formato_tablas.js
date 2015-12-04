
//Funciones jQuery
$(function(){


    //Dónde se usa:
    //En la vista (pedido_encabezado.php) en la tabla con el identificador tbProductos
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbProductos').DataTable({
        "paging":   true,
        "ordering": false,
        "lengthMenu": [5],
        "bLengthChange" : false, //esta linea oculta el LengthMenu
        "bInfo":false,
        "language": {
            "search":" Buscar"
        }

    });


    //Dónde se usa:
    //En la vista (pedido_detalle.php) en la tabla con el identificador tbPartidas
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbPartidas').DataTable({
        "searching": true,
        "paging": true,
        "lengthMenu": [10],
        "bLengthChange" : false, //esta linea oculta el LengthMenu
        "language": {
            "processing":"Procesando...",
            "lengthMenu":"Mostrar _MENU_ registros",
            "zeroRecords":"No se encontraron resultados",
            "emptyTable":"Ningún dato disponible en esta tabla",
            "info":"Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "search":" Buscar producto:",
            "paginate": {
                "first":"Primero",
                "last":"Ultimo",
                "next":"Siguiente",
                "previous":"Anterior"
            },
        }

    });

    //Dónde se usa:
    //En la vista (pedido_detalle.php) en la tabla con el identificador tbPartidas
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbCobranza').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "language": {
            "search":" Buscar",
            "emptyTable":"Ningún dato disponible en esta tabla"
        }
    });


    //Dónde se usa:
    //En la vista (pedidos_liberados.php) en la tabla con el identificador tbPedidosLiberados
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbPedidosLiberados').DataTable({
        "searching": true,
        "paging": true,
        "ordering": false,
        "lengthMenu": [10],
        "bLengthChange" : false, //esta linea oculta el LengthMenu
        "language": {
            "processing":"Procesando...",
            "lengthMenu":"Mostrar _MENU_ registros",
            "zeroRecords":"No se encontraron resultados",
            "emptyTable":"Ningún dato disponible en esta tabla",
            "info":"Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "search":" Buscar producto:",
            "paginate": {
                "first":"Primero",
                "last":"Ultimo",
                "next":"Siguiente",
                "previous":"Anterior"
            },
        }

    });

    //Dónde se usa:
    //En la vista (pedidos_retenidos.php) en la tabla con el identificador tbPedidosRetenidos
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbPedidosRetenidos').DataTable({
        "searching": true,
        "paging": true,
        "ordering": false,
        "lengthMenu": [10],
        "bLengthChange" : false, //esta linea oculta el LengthMenu
        "language": {
            "processing":"Procesando...",
            "lengthMenu":"Mostrar _MENU_ registros",
            "zeroRecords":"No se encontraron resultados",
            "emptyTable":"Ningún dato disponible en esta tabla",
            "info":"Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "search":" Buscar producto:",
            "paginate": {
                "first":"Primero",
                "last":"Ultimo",
                "next":"Siguiente",
                "previous":"Anterior"
            },
        }

    });


    //Dónde se usa:
    //En la vista (pedidos_pendientes.php) en la tabla con el identificador tbPedidosPendientes
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbPedidosPendientes').DataTable({
        "searching": true,
        "paging": true,
        "ordering": false,
        "lengthMenu": [10],
        "bLengthChange" : false, //esta linea oculta el LengthMenu
        "language": {
            "processing":"Procesando...",
            "lengthMenu":"Mostrar _MENU_ registros",
            "zeroRecords":"No se encontraron resultados",
            "emptyTable":"Ningún dato disponible en esta tabla",
            "info":"Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "search":" Buscar producto:",
            "paginate": {
                "first":"Primero",
                "last":"Ultimo",
                "next":"Siguiente",
                "previous":"Anterior"
            },
        }

    });


    //Dónde se usa:
    //En la vista (cobranza_periodo.php) en la tabla con el identificador tbCobranzaPeriodo
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbCobranzaPeriodo').DataTable({
        "paging":   true,
        "ordering": false,
        "lengthMenu": [10],
        "bLengthChange" : false, //esta linea oculta el LengthMenu
        "bInfo":false,
        "language": {
            "search":" Buscar"
        }
    });

    //Dónde se usa:
    //En la vista (visitas_periodo.php) en la tabla con el identificador tbVisitasPeriodo
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbVisitasPeriodo').DataTable({
        "paging":   true,
        "ordering": false,
        "lengthMenu": [10],
        "bLengthChange" : false, //esta linea oculta el LengthMenu
        "bInfo":false,
        "language": {
            "search":" Buscar"
        }
    });




    //Dónde se usa:
    //En la vista (prospectos.php) en la tabla con el identificador tbProspectos
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbProspectos').DataTable({
        "searching": true,
        "paging": true,
        "ordering": false,
        "lengthMenu": [10],
        "bLengthChange" : false, //esta linea oculta el LengthMenu
        "language": {
            "processing":"Procesando...",
            "lengthMenu":"Mostrar _MENU_ registros",
            "zeroRecords":"No se encontraron resultados",
            "emptyTable":"Ningún dato disponible en esta tabla",
            "info":"Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "search":" Buscar producto:",
            "paginate": {
                "first":"Primero",
                "last":"Ultimo",
                "next":"Siguiente",
                "previous":"Anterior"
            },
        }

    });



    //Dónde se usa:
    //En la vista (agregar_producto_devolucion.php) en la tabla con el identificador tbProductosFacturaDevolucion
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbProductosFacturaDevolucion').DataTable({
        "searching": true,
        "paging": true,
        "ordering": true,
        "lengthMenu": [10],
        "bLengthChange" : false, //esta linea oculta el LengthMenu
        "language": {
            "processing":"Procesando...",
            "lengthMenu":"Mostrar _MENU_ registros",
            "zeroRecords":"No se encontraron resultados",
            "emptyTable":"Ningún dato disponible en esta tabla",
            "info":"Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "search":" Buscar producto:",
            "paginate": {
                "first":"Primero",
                "last":"Ultimo",
                "next":"Siguiente",
                "previous":"Anterior"
            },
        }

    });



    //Dónde se usa:
    //En la vista (captura_devolucion.php) en la tabla con el identificador tbProductosDevolucion
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbProductosDevolucion').DataTable({
        "searching": false,
        "paging": true,
        "ordering": true,
        "lengthMenu": [5],
        "bLengthChange" : false, //esta linea oculta el LengthMenu
        "language": {
            "processing":"Procesando...",
            "lengthMenu":"Mostrar _MENU_ registros",
            "zeroRecords":"No se encontraron resultados",
            "emptyTable":"Ningún dato disponible en esta tabla",
            "info":"Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "search":" Buscar producto:",
            "paginate": {
                "first":"Primero",
                "last":"Ultimo",
                "next":"Siguiente",
                "previous":"Anterior"
            },
        }

    });


    //Dónde se usa:
    //En la vista (back_order.php) en la tabla con el identificador tbBackOrder
    //Para que se usa:
    //Para dar formato y dotar de nuevas funciones a la información mostrada, ya que se agregan funciones como la paginación,
    //y busqueda de elementos dentro de los valores de la tabla
    $('#tbBackOrder').DataTable({
        "paging":   true,
        "ordering": false,
        "lengthMenu": [10],
        "bLengthChange" : false, //esta linea oculta el LengthMenu
        "bInfo":false,
        "language": {
            "search":" Buscar"
        }
    });


});