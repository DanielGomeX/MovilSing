$(function(){

    /**
     * Dónde se usa: En la vista (devoluciones.php)
     * Para que se usa:
     * Para mostrar el formulario modal al hacer click sobre el botón que permitirá realizar la búsqueda de la factura en función del
     * número de factura
     */
    $('#btnBuscarPorFactura').on('click', function() {
        $('#modalBuscar').modal('show');
    });


    /**
     * Dónde se usa: En la vista (devoluciones.php)
     * Para que se usa:
     * Para mostrar el formulario modal al hacer click sobre el botón que permitirá realizar la búsqueda de la factura en función del 
     * número de cliente
     */
    $('#btnBuscarPorCliente').on('click', function() {
        $('#modalBuscarFacturaPorCliente').modal('show');
    });


    /**
     * Dónde se usa: En la vista (devoluciones.php)
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
     * Dónde se usa: En la vista (devoluciones.php)
     * Para que se usa:
     * Ejecuta la función que busca en la base de datos las facturas asociadas al cliente
     */
    $('#btnBuscarFacturas').on('click',function (e){
        e.preventDefault();
        buscarFacturasCliente();
    });


    /**
     * Dónde se usa: En la vista (devoluciones.php)
     * Para que se usa:
     * Función ajax que permite buscar en la base de datos las facturas asociadas al cliente,
     * muestra los datos encontrados en una tabla
     */
    function buscarFacturasCliente(){

        var numero_cliente= $('#txtBuscarPorCliente').val();

        $.ajax({
             type: 'get',
             async: true,
             url: '/DevolucionesController/obtenerFacturasPorCliente',
             data:{codigo:numero_cliente},
             success: function(respuesta){

                var tableData ='<thead><tr><td>Factura</td><td>Fecha</td><td>Cliente</td><td>Monto</td></tr></thead><tbody>';
                obj = JSON.parse(respuesta);
                    for(var i in obj){
                      //tableData += '<tr><td><a href="<?php echo base_url(); ?>DevolucionesController/seleccionarFactura/'+obj[i].InvcNbr+'">'+obj[i].InvcNbr+'</a></td><td>'+obj[i].InvcDate+'</td><td>'+obj[i].Cliente+'</td><td> $'+obj[i].Monto+'</td></tr>';
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


    $('#btnSupervisor').on('click', function() {
        $('#frmModalStatus').modal('show');
    });


    /**************  Usando el plugin jQquery Validator  ***************/


    /**************  Métodos personalizados para validación   *************************/

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


    /**
     * Dónde se usa: En la vista (agregar_producto_devolucion.php)
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
     * Dónde se usa: En la vista (captura_devolucion.php)
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


    /**
     * Dónde se usa: En la vista (registrar_paquete.php)
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
              required: "Debe de registrar un número de guia al paquete",
              minlength: jQuery.validator.format("La guia requiere de por lo menos {0} caracteres!")
            },
            peso: {
              required: "Debe de registrar el peso del paquete"
            }
        }

    });



    /**
     * Dónde se usa: En la vista (registrar_envio.php)
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




}); //Fin archivo



