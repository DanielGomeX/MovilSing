$(function(){


/////////////////////////////////////////  (tablero_anomalias.php)   //////////////////////////////////////////////


    /**
     * Para que se usa:
     * Para mostrar el formulario modal al hacer click sobre el botón que permitirá realizar la búsqueda de la factura en función del
     * número de factura
     */
    $('#btnBuscarPorFactura').on('click', function() {
        $('#modalBuscar').modal('show');
    });


    /**
     * Para que se usa:
     * Para mostrar el formulario modal al hacer click sobre el botón que permitirá realizar la búsqueda de la factura en función del
     * número de cliente
     */
    $('#btnBuscarPorCliente').on('click', function() {
        $('#modalBuscarFacturaPorCliente').modal('show');
    });


    /**
     * Para que se usa:
     * Para mostrar el formulario modal al hacer click sobre el botón que permitirá realizar la búsqueda de las facturas del cliente
     * que contienen un producto en específico
     *
     */
    $('#btnBuscarPorProducto').on('click', function() {
        $('#modalBuscarPorProducto').modal('show');
    });


    /**
     * Para que se usa:
     * Para validar que se registre un número de factura como obligatorio antes de enviar el formulario al servidor
     */
    $('#frmBuscaFactura').on('submit', function(e) {
        var factura = $('#txtBuscar').val();
        if (factura == "") {
            e.preventDefault();
            $("#msj").addClass('error');
            $("#msj").text("Favor de capturar un número de factura.").show();
            $('#txtBuscar').focus();
        }
    });


    /**
     * Para que se usa:
     * Ejecuta la función que busca en la base de datos las facturas asociadas al cliente
     */
    $('#btnBuscarFacturas').on('click',function (e){
        e.preventDefault();
        buscarFacturasCliente();
    });


    /**
     * Para que se usa:
     * Función ajax que permite buscar en la base de datos las facturas asociadas al cliente,
     * muestra los datos encontrados en una tabla
     */
    function buscarFacturasCliente(){

        var numero_cliente= $('#txtBuscarPorCliente').val();

        $.ajax({
             type: 'get',
             async: true,
             url: '/AnomaliasController/obtenerFacturasPorCliente',
             data:{codigo:numero_cliente},
             success: function(respuesta){

                var tableData ='<thead><tr><td>Factura</td><td>Fecha</td><td>Cliente</td><td>Monto</td></tr></thead><tbody>';
                obj = JSON.parse(respuesta);
                    for(var i in obj){
                      tableData += '<tr><td><a href="DevolucionesController/seleccionarFactura/'+obj[i].InvcNbr+'">'+obj[i].InvcNbr+'</a></td><td>'+obj[i].InvcDate+'</td><td>'+obj[i].Cliente+'</td><td> $'+obj[i].Monto+'</td></tr>';
                    }
                tableData += '</tbody>';
                $('#tbFacturasCliente').html(tableData);
             },
             error : function(xhr, status) {
                alert('Ha ocurrido un ERROR al tratar de obtener la información.');
            }
        });
    }


    /**
     * Para que se usa:
     * Ejecuta la función que busca en la base de datos las facturas asociadas al cliente
     */
    $('#btnBuscarPorProductoCliente').on('click',function (e){
        e.preventDefault();
        buscarFacturasPorProductoCliente();
    });


    /**
     * Para que se usa:
     * Función ajax que permite buscar en la base de datos las facturas asociadas al cliente,
     * muestra los datos encontrados en una tabla
     */
    function buscarFacturasPorProductoCliente(){

        var cliente= $('#txtCliente').val();
        var producto= $('#txtProducto').val();

        $.ajax({
             type: 'get',
             async: true,
             url: '/DevolucionesController/obtenerFacturasPorProductoCliente',
             data:{pCliente:cliente, pProducto:producto},
             success: function(respuesta){
                $('#tbPorProductoCliente').html(respuesta);
             },
             error : function(xhr, status) {
                alert('Ha ocurrido un ERROR al tratar de obtener la información.');
            }
        });
    }


////////////////////////////////////////// (captura_devolucion.php)  /////////////////////////////////////////////


    /**
     * Para que se usa:
     * Para mostrar el formulario modal al hacer click sobre el botón que permitirá registrar el motivo por el cual
     * se debería de autorizar la devolución / reclamación
     */
    $('#btnSupervisor').on('click', function() {
        $('#frmModalStatus').modal('show');
    });


    /**
     * Para que se usa:
     * Para validar que el usuario forzosamente registre un movivo de devolución.
     */
    $('#frmCambiarStatus').validate({
        rules: {
            observaciones: {
                required: true
            }
        },
        messages: {
            observaciones: {
              required: "No puede se puede enviar al Supervisor si no registra el motivo"
            }
        }

    });


////////////////////////////////////////// (agregar_producto_devolucion.php)  /////////////////////////////////////////////

    /**
     * Para que se usa:
     * Para mostrar el formulario modal al hacer click sobre el botón que permitirá registrar el motivo por el cual
     * se devoleran los productos
     */
    $('#btnAgregarTodosProductos').on('click', function() {
        $('#frmModalProductos').modal('show');
    });


    /**
     * Para que se usa:
     * Para validar que no se pueda registrar una cantidad mayor a la cantidad surtida, asi como también
     * que la cantidad sea un campo obligatorio y que no puedan registrar caracteres alfanumericos.
     */
    $('#frmAgregarProductoDevolver').validate({
        rules: {
            cantidad: {
                required: true,
                entero: true,
                mayor_surtido: parseInt($("#cantSurtida").val())
            },
            motivo: {
                required: true
            }
        },
        messages: {
            cantidad: {
              required: "Debe registrar una cantidad a devolver"
            },
            motivo: {
              required: "Registre el motivo por el cual se desea devolver el producto"
            }
        }

    });


    /**
     * Para que se usa:
     * Para validar que el usuario forzosamente registre un movivo de devolución.
     */
    $('#frmAgregarProductos').validate({
        rules: {
            motivo: {
                required: true
            }
        },
        messages: {
            motivo: {
              required: "Debe de especificar el motivo general por el cual serán devueltos los productos"
            }
        }

    });


////////////////////////////////////////// (datos_factura.php)  /////////////////////////////////////////////


    /**
     * Para que se usa:
     * Para que cuando se haga click sobre la opción devolución se ejecute la función ajax que obtendrá los elementos que seran
     * cargados al objeto select.
     
    $('#devolucionVenta').on('click',causasDevoluciones) ;


    /**
     * Para que se usa:
     * Para que cuando se haga click sobre la opción devolución se ejecute la función ajax que obtendrá los elementos que seran
     * cargados al objeto select.
     
    $('#reclamacionCalidad').on('click', causasReclamaciones);


    /**
     * Esta función permite cargar de manera dinámica los valores a un elemento select, mandando como parámetro el valor
     * D que corresponde a las devoluciones para que se ejecute el método correspondiente. La respuesta será procesada
     * como un elemnto html.
     
    function causasDevoluciones(){
            $.ajax({
             type: 'get',
             async: true,
             url: '/AnomaliasController/obtenerCausasPorArea',
             data:{tipo:"D"},
             success: function(respuesta){
                $("#causaAnomalia").html(respuesta);
             },
             error : function(xhr, status) {
                alert('Ha ocurrido un ERROR al tratar de obtener la información.');
            }
        });
    }


    /**
     * Esta función permite cargar de manera dinámica los valores a un elemento select, mandando como parámetro el valor
     * R que corresponde a las reclamaciones para que se ejecute el método correspondiente. La respuesta será procesada
     * como un elemnto html.
     
    function causasReclamaciones(){
            $.ajax({
             type: 'get',
             async: true,
             url: '/AnomaliasController/obtenerCausasPorArea',
             data:{tipo:"R"},
             success: function(respuesta){
                $("#causaAnomalia").html(respuesta);
             },
             error : function(xhr, status) {
                alert('Ha ocurrido un ERROR al tratar de obtener la información.');
            }
        });
    }
    */


    //antes de que se termine de cargar la página, carcamos las causas en el objeto select
    $("#causaAnomalia").before(causasAnomalia);

    /**
     * Esta función permite cargar de manera dinámica los valores a un elemento select, mandando como parámetro el valor
     * R que corresponde a las reclamaciones para que se ejecute el método correspondiente. La respuesta será procesada
     * como un elemnto html.
     */
    function causasAnomalia(){
            $.ajax({
             type: 'get',
             async: true,
             url: '/AnomaliasController/obtenerCausasAnomalia',
             success: function(respuesta){
                $("#causaAnomalia").html(respuesta);
             },
             error : function(xhr, status) {
                alert('Ha ocurrido un ERROR al tratar de CARGAR la información del combo');
            }
        });
    }




    /**
     * Para que se usa:
     * Para validar que el usuario forzosamente registre el tipo de anomalia.
     */
    $('#frmRegistrarAnomalia').validate({
        rules: {
            tipoAnomalia: {
                required: true
            },
            causaAnomalia: {
                required: true
            }
        },
        messages: {
            tipoAnomalia: {
              required: "Debe seleccionar el tipo de anomalia."
            },
            causaAnomalia: {
              required: "Debe seleccionar alguna causa de anomalia."
            }
        }

    });


////////////////////////////////////////// (registrar_paquete.php)  ////////////////////////////////////////7

    /**
     * Para que se usa:
     * Para validar que el usuario forzosamente registre una guia y un peso del paquete para devolución.
     */
    $('#registrarPaquete').validate({
        rules: {
            guia: {
                required: true,
                minlength: 3
            },
            peso: {
                required: true,
                solo_digitos: true
            }
        },
        messages: {
            guia: {
              required: "Debe de registrar un número de guia / codigo rastreo al paquete",
              minlength: jQuery.validator.format("La guia requiere de por lo menos {0} caracteres!")
            },
            peso: {
              required: "Debe de registrar el peso del paquete"
            }
        }

    });


    /**
     * Para que se usa:
     * Para validar que el usuario forzosamente registre un tipo de autorizacion y un movivo de devolución.
     */
    $('#frmRegistrarEnvio').validate({
        rules: {
            autorizacion: {
                required: true
            },
            motivo:{
              required: true
            }
        },
        messages: {
            autorizacion: {
              required: "Debe seleccionar el tipo de autorización."
            },
            motivo: {
              required: "Debe capturar el motivo general de la devolucion."
            }
        }

    });


////////////////////////////////////////// (Métodos personalizados jQueryValidator)  /////////////////////////


    // Este método permite validar que la cantidad solo contenga números enteros positivos, se excluye el cero.
    $.validator.addMethod('entero', function (value, element, param) {
        return (value != 0) && (value == parseInt(value, 10));
        }, 'Registre un valor entero diferente a cero!'
    );

    // Este método permite validar que la cantidad a devolver no sea mayor a la cantidad surtida
    $.validator.addMethod("mayor_surtido", function(value, element, params) {
        return parseInt(value) <= parseInt(params);
        }, $.validator.format("No se permite registrar un valor mayor a la cantidad surtida {0}"));

    //Este método permite validar solo dígitos positivos con 2 decimales máximo
    $.validator.addMethod('solo_digitos', function (value, element, param) {
        var regxp = /^\d+(\.\d{1,2})?$/; //positivos
        //var regxp = /^-?(0|([1-9]\d*))(\.\d+)?$/;  //negativos
        return value.match(regxp);
        }, 'El Peso solo puede contener dígitos con dos decimales máximo'
    );


}); //Fin archivo



