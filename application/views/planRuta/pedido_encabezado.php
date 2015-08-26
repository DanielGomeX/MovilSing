<article class="row">

    <div class="col-md-6 col-md-offset-2">

        <h2>Registrar Partida</h2>

        <!-- INFORMACION DEL PEDIDO -->
        <div class="padding-arriba-abajo">
            <div>
                <label>
                    Pedido: <?php echo $_SESSION['pedido']; ?>
                </label>
                <br>
                <label>
                    Cliente: <?php echo $_SESSION['cliente'] ?>
                </label>
            </div>
            <div>
                <a class="btn btn-default" role="button" href="<?php echo base_url(); ?>partidas">
                    <i class="fa fa-bars"></i>
                    Ver Partidas
                </a>
            </div>
        </div>

        <!-- MENSAJES -->
        <div>
            <!-- Si esta seteada la variable error, entonces mostramos una alerta en color azul o amarillo según el tipo de codigo -->
            <?php if(isset($error)):
            ?>
            <div>
                <?php if($error===0):
                ?>
                <!-- mostramos alerta color azul que indica que el producto ha siso agregado -->
                <div class="alert alert-info" role="alert">
                    <i class="fa fa-check"></i>&nbsp; <?php echo $producto."  -  Existencia actual: ".$existencia; ?>
                </div>
                <?php else:
                ?>
                <!-- mostramos alerta color amarillo que indica que el producto ha tenido algún detalle al momento de regiostrarlo -->
                <div class="alert alert-warning" role="alert">
                    <i class="fa fa-exclamation-triangle"></i>&nbsp; <?php   echo $mensaje;
                    ?>
                </div>
                <?php endif;
                ?>
            </div>
            <?php else:
            ?>
            <div>
                <!-- al no estar seteada la variable error, entonces no mostramos ninguna alerta -->
            </div>
            <?php endif;
            ?>
        </div>

        <!-- FORMULARIO PARA AGREGAR PRODUCTOS -->
        <form id="frmAgregarPartida" action='<?php echo base_url(); ?>agregar' method="post">
            <div class="form-group">
                <label for="clave">Código </label>
                <input class="form-control" type="text" id="clave" name="clave" style="text-transform:uppercase" autocomplete="off" tabindex="1" autofocus/>
                <?php echo form_error('clave'); ?>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad </label>
                <input class="form-control" type="text" id="cantidad" name="cantidad" autocomplete="off" tabindex="2" />
                <?php echo form_error('cantidad'); ?>
            </div>
            <div class="padding-arriba-abajo">
                <button type="submit" id="btnBuscarCliente" class="btn btn-warning" tabindex="3">
                    <i class="fa fa-plus"></i>
                    Agregar Partida
                </button>
            </div>
        </form>

        <!-- FORMULARIO PARA BUSQUEDA DE PRODUCTOS -->
        <form id="frmBuscar" action='<?php echo base_url(); ?>buscar' method="post">
            <div class="form-group">
                <input class="form-control" type="text" id="descripcion" name="descripcion" autocomplete="off" placeholder="Breve descripción de lo que desea"/>
                <?php echo form_error('descripcion'); ?>
            </div>
            <button class="btn btn-warning" id="btnBuscar" type="submit">
                <i class="fa fa-search"></i>
                Buscar Producto
            </button>
        </form>

        <!-- TABLA DE PRODUCTOS ENCONTRADOS -->
        <div class="table-responsive">
            <?php if (isset($productos)):
            ?>
            <!-- El objeto id=tbProductos ejecuta un javaScript (ver archivo llamado funciones.js) -->
            <table class="table table-striped table-condensed" id="tbProductos">
                <thead>
                    <tr>
                        <th>
                            Clave
                        </th>
                        <th>
                            Descripcion
                        </th>
                        <th>
                            Existencia
                        </th>
                        <th>
                            UnidadVenta
                        </th>
                        <th>
                            MultiploVenta
                        </th>
                        <th>
                            PrecioLista
                        </th>
                        <th>
                            Familia
                        </th>
                        <th>
                            Linea
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto):
                    ?>
                    <tr>
                        <td>
                            <a href="#"><i class="fa fa-wrench"></i><?php echo $producto['Clave']; ?></a>
                        </td>
                        <td>
                            <?php echo utf8_encode($producto['Descripcion']); ?>
                        </td>
                        <td>
                            <?php echo $producto['Existencia']; ?>
                        </td>
                        <td>
                            <?php echo $producto['UnidadVenta']; ?>
                        </td>
                        <td>
                            <?php echo $producto['MultiploVenta']; ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($producto['PrecioLista']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($producto['Familia']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($producto['Linea']); ?>
                        </td>
                    </tr>
                    <?php endforeach;
                    ?>
                </tbody>
            </table>
            <?php endif;
            ?>
        </div>

    </div><!-- //columna -->

</article><!-- //renglon -->
