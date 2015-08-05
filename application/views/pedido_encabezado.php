<article class="col-md-6">
    <h2>
        Registrar Partida
    </h2>

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
                <span class="glyphicon glyphicon glyphicon-list" aria-hidden="true"></span>
                Ver Partidas
            </a>
        </div>
    </div>

    <div>
        <!-- Si esta seteada la variable error, entonces mostramos una alerta en color verde o rojo -->
        <?php if(isset($error)): ?>
        <div>
            <?php if($error===0): ?>
            <!-- mostramos alerta verde -->
            <div class="alert alert-info" role="alert">
                <?php echo $producto."  -  Existencia actual: ".$existencia; ?>
            </div>
        <?php  else: ?>
        <!-- mostramos alerta roja -->
        <div class="alert alert-warning" role="alert">
            <?php if (isset($mensaje)) {
             echo $mensaje;  }
             ?>
         </div>
     <?php endif; ?>
 </div>
<?php  else: ?>
    <div>
        <!-- al no estar seteada la variable error, entonces no mostramos ninguna alerta -->
    </div>
<?php endif; ?>
</div>

<form  id="frmAgregarPartida" action='<?php echo base_url(); ?>agregar' method="post">
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
    <div>

        <!-- <input class="btn btn-warning" type="submit" value="Agregar Partida" name="agregarPartida" tabindex="3"/> -->

        <button type="submit" id="btnBuscarCliente" class="btn btn-warning" tabindex="3">
         <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
         Agregar Partida
     </button>

 </div>
</form>

<br>

<form id="frmBuscar" action='<?php echo base_url(); ?>buscar' method="post">
    <div class="form-group">
        <input class="form-control" type="text" id="descripcion" name="descripcion" autocomplete="off" placeholder="Breve descripción de lo que desea"/>
        <?php echo form_error('descripcion'); ?>
    </div>
    <button class="btn btn-default" id="btnBuscar" type="submit">
        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
        Buscar
    </button>
</form>

<br>

<div class="table-responsive">
    <?php
    if (isset($productos)) {
        ?>
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
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td>
                        <a href="#"><?php echo ($producto['Clave']); ?></a>
                    </td>
                    <td>
                        <?php echo ($producto['Descripcion']); ?>
                    </td>
                    <td>
                        <?php echo ($producto['Existencia']); ?>
                    </td>
                    <td>
                        <?php echo ($producto['UnidadVenta']); ?>
                    </td>
                    <td>
                        <?php echo ($producto['MultiploVenta']); ?>
                    </td>
                    <td>
                        <?php echo '$'.number_format($producto['PrecioLista']); ?>
                    </td>
                    <td>
                        <?php echo ($producto['Familia']); ?>
                    </td>
                    <td>
                        <?php echo ($producto['Linea']); ?>
                    </td>
                </tr>
                <?php
                endforeach;
            }
            ?>
        </tbody>

    </table>
    <!--</form>-->

</div>
</article>
