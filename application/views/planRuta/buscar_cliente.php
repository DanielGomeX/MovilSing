<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2>Clientes en Plan de Ruta</h2>

        <!-- TABLA DE CLIENTES EN PLAN DE RUTA DEL DIA -->
        <div class="table-responsive">
            <!-- Si la variable clientes_planruta no esta vacia, mostramos la tabla con los datos -->
            <?php if (isset($clientes_planruta)):
            ?>
            <table id="tbClientesPlanRuta" class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>
                            Cliente
                        </th>
                        <th>
                            Nombre
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($clientes_planruta as $cliente):
                        ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url(); ?>PlanRutaController/mostrarDatosCliente/<?php echo ($cliente['Cliente']); ?>"><?php echo ($cliente['Cliente']); ?></a>
                        </td>
                        <td>
                            <?php echo utf8_encode($cliente['Nombre']); ?>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <?php
            endif;
            ?>
        </div>

        <!-- FORMULARIO PARA BUSCAR CLIENTES NO LISTADOS EN PLAN DE RUTA -->
        <form id="frmBuscarCliente" action='<?php echo base_url(); ?>PlanRutaController/buscarCliente' method="post">
            <div class="form-group">
                <label for="txtBuscar">Buscar cliente NO listado:</label>
                <input type="text" id="txtBuscar" name="buscar" class="form-control" autocomplete="off" tabindex="1"  placeholder="nombre, razón social o apellido" />
                <?php echo form_error('buscar'); ?>
            </div>
            <div>
                <button type="submit" id="btnBuscarCliente" class="btn btn-warning" tabindex="2">
                    <i class="fa fa-search"></i>
                    Buscar cliente
                </button>
            </div>
        </form>

        <!-- TABLA DE CLIENTES NO LISTADOS EN PLAN DE RUTA -->
        <div class="table-responsive">
            <!-- Si la variable clientes no esta vacia, mostramos la tabla  -->
            <?php if (isset($clientes)):
            ?>
            <h3>Clientes NO listados en Plan de Ruta</h3>

            <table id="tbClientes" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            Cliente
                        </th>
                        <th>
                            Nombre
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($clientes as $cliente):
                        ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url(); ?>PlanRutaController/mostrarDatosCliente/<?php echo ($cliente['Cliente']); ?>"><?php echo ($cliente['Cliente']); ?></a>
                        </td>
                        <td>
                            <?php echo utf8_encode($cliente['Nombre']); ?>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>

            <a class="btn btn-warning" role="button" href="<?php echo base_url(); ?>PlanRutaController/index">
                <i class="fa fa-users"></i>
                Clientes en Plan de Ruta
            </a>
            <?php endif;
            ?>
        </div>

    </div><!-- //columna -->

</article><!-- //renglon -->
