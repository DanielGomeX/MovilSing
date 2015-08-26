<article class="row">

    <div class="col-md-12">

        <!-- Guardamos en una vaiable de sesion la url que manda llamar a las partidas, para que
        el link regresar nos mande nuevamente a esta pantalla -->
        <?php $_SESSION['regresar']=$this->uri->uri_string(); ?>

        <!-- MENU DE NAVEGACION -->
        <ul class="nav nav-pills nav-justified ">
            <li role="presentation"><a href="<?php echo base_url() ?>PlanRutaController/mostrarDatosCliente/<?php echo $_SESSION['cliente']; ?>"><i class="fa fa-user"></i> Datos Generales</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>visitas"><i class="fa fa-calendar-check-o"></i> Visitas</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>cobranza"><i class="fa fa-money"></i> Cobranza</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>saldos"><i class="fa fa-bank"></i> Saldos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>entregas"><i class="fa fa-truck"></i> Entregas</a></li>
            <li role="presentation" class="active"><a href=""><i class="fa fa-shopping-cart"></i> Pedidos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>planruta"><i class="fa fa-map-o"></i> Plan Ruta</a></li>
        </ul>

        <br>
        <?php

        #arreglo con los status permitidos para que el pedido pueda ser retomado nuevamente
        $status_retomar = array("C", "AP", "RP", "V", "X");

        ?>

        <div class="tabla-responsive">
            <?php if (isset($pedidos)):
            ?>
            <table id="tbPedidosPendientes" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            Pedido
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Fecha Pedido
                        </th>
                        <th>
                            Partidas
                        </th>
                        <th>
                            Tipo Cliente
                        </th>
                        <th>
                            Cliente
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url(); ?>PedidosController/consultarPartidasPedido/<?php echo $pedido['Pedido']; ?>">
                                <i class="fa fa-bars"></i>
                                Partidas
                            </a>
                        </td>
                        <td>
                            <?php echo $pedido['Pedido']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['StatusPedido']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['FechaPedido']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['Partidas']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['TipoCliente']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['custid']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($pedido['Name']); ?>
                        </td>
                        <td>
                            <!-- Si el status del pedidos es igual cualquiera de los satus permitidos contenidos en el arreglo "status_remotar"
                            entonces, mostramos el link para poder retomar dicho pedido -->
                            <?php if (in_array($pedido['StatusPedido'], $status_retomar)):  ?>
                            <a href="<?php echo base_url(); ?>retomar/<?php echo $pedido['Pedido']; ?>">
                                <i class="fa fa-edit"></i>
                                Retomar
                            </a>
                            <?php endif;
                            ?>
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