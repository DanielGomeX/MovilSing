$(function(){

    /**
     * Dónde se usa: En la vista (captura_prospecto.php y editar_prospecto.php)
     * Para que se usa:
     * Para mostrar el formulario modal al hacer click sobre el botón (btnCP) que permitirá realizar la búsqueda de colonia por código postal
     */
    $('#btnCP').on('click',function (){
        $('#myModal').modal('show');
    });


    $('#btnSupervisor').on('click',function (){
        $('#frmModalStatus').modal('show');
    });

    /**
     * Dónde se usa: En la vista (captura_prospecto.php y editar_prospecto.php)
     * Para que se usa:
     * Ejecuta la función que busca en la base de datos el código postal introducido por el usuario
     */
    $('#btnBuscarCodigo').on('click',function (e){
        e.preventDefault();
        buscarAsentamientos();
    });


    /**
     * Dónde se usa: En la vista (editar_prospecto.php)
     * Para que se usa:
     * Para ocultar los botones que permiten interactuar con el prospecto, ya que al cargar el formulario con los datos
     * del prospecto seleccionado obtenemos el valor del campo status, si el valor es diferente a C (captura), significa
     * que el usuario ya no puede realizar ninguna acción sobre él.
     */
    var status=$('#status').val();
    if (status!="C") {
        $('#btnSupervisor').hide();
        $('#btnCP').hide();
        $('#btnProspecto').hide();
    }


    /**
     * Dónde se usa: En la vista (editar_prospecto.php)
     * Para que se usa:
     * Para validar que se registre un texto de comentario como obligatorio antes de enviar el formulario
     * al servidor para cambiar de status al prospecto
     */
    $('#frmCambiarStatus').on('submit', function(e){
        var textarea_length = $('#comentario').val().length;
        //si la longitud del comentario es cero, significa que está vacia, por lo cual debemos impedir el submit del fromulario
        if (textarea_length==0){
            e.preventDefault();
            $("#msj").addClass('error');
            $("#msj").text( "El comentario es obligatorio." ).show();
            $('#comentario').focus();
        }
    });


    /**
     * Dónde se usa: En la vista (captura_prospecto.php y editar_prospecto.php)
     * Para que se usa:
     * Permite buscar en la base de datos los asentamientos (colonias) asociadas al código postal introducido por el usuario,
     * muestra los datos encontrados en una tabla
     */
    function buscarAsentamientos(){

        var codigo_postal= $('#cpBuscar').val();

        $.ajax({
             type: 'get',
             async: true,
             url: '/ProspectosController/obtenerAsentamientos',
             data:{codigo:codigo_postal},
             success: function(respuesta){

                var tableData = '<thead><tr><td>Colonia / Frac.</td><td>Ciudad</td><td>Municipio</td><td>Estado</td></tr></thead><tbody>';
                obj = JSON.parse(respuesta);
                    for(var i in obj){
                      tableData += '<tr><td><a href="#">'+obj[i].NombreAsentamiento+'</a></td><td>'+obj[i].Ciudad+'</td><td>'+obj[i].Municipio+'</td><td>'+obj[i].Estado+'</td></tr>';
                    }
                tableData += '</tbody>';
                $('#tbAsentamientos').html(tableData);

             },
             error : function(xhr, status) {
                alert('Ha ocurrido un ERROR al tratar de obtener la información.');
            }
        });
    }


    /**
     * Dónde se usa: En la vista (captura_prospecto.php y editar_prospecto.php)
     * Para que se usa:
     * Permite copiar los datos del asentamiento (colonia) seleccionado a sus correspondientes campos input dentro del formulario
     */
    $('#tbAsentamientos').on('click','a',function (e){
        e.preventDefault();

        var cp= $('#cpBuscar').val();
        var colonia=$(this).parent().parent().children('td:eq(0)').text().trim();
        var ciudad =$(this).parent().parent().children('td:eq(1)').text().trim();
        var municipio=$(this).parent().parent().children('td:eq(2)').text().trim();
        var estado =$(this).parent().parent().children('td:eq(3)').text().trim();

        $("#cp").val(cp);
        $("#colonia").val(colonia);
        $("#ciudad").val(ciudad);
        $("#municipio").val(municipio);
        $("#estado").val(estado);

        $('#myModal').modal('hide');
        $("#cp").focus();
    });

    /**
     * Dónde se usa: En la vista (editar_prospecto.php)
     * Para que se usa:
     * Permite establecer como seleccionado el elemento que tienen guardado el prospecto en la base de datos a los campos input del tipo select
     * una vez que se carga el formulario
     */
    $('#tipoCliente option[value="'+ $('#hdTipoCliente').val() +'"]').attr('selected', 'selected');
    $('#localidad option[value="'+ $('#hdLocalidad').val() +'"]').attr('selected', 'selected');
    $('#giro option[value="'+ $('#hdGiro').val() +'"]').attr('selected', 'selected');

});



