<article class="row">

    <div class="col-md-12">

        <h2>Pedidos Liberados del Periodo</h2>

        <!-- Guardamos en una vaiable de sesion la url que manda llamar a las partidas, para que
        el link regresar nos mande nuevamente a esta pantalla -->
        <?php $_SESSION['regresar']=$this->uri->uri_string(); ?>

        <!--el objeto tbPedidosLiberados ejecuta un plugin de js llamado DataTables (ver archivo formato_tablas.js)
            que sirve para aplicar diversos formatos a las tablas html
        -->
        <div class="tabla-responsive">
            <?php if (isset($pedidos)):
            ?>
            <table id="tbPedidosLiberados" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>

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
                            Pedido
                        </th>
                        <th>
                            Es Especial
                        </th>
                        <th>
                            Fecha Pedido
                        </th>
                        <th>
                            Num. Orden
                        </th>
                        <th>
                            Fecha Liberacion
                        </th>
                        <th>
                            Partidas
                        </th>
                        <th>
                            Importe
                        </th>
                    </tr>
                </thead>
                <?php foreach ($pedidos as $pedido):
                ?>
                <tbody>
                    <tr>
                        <td>
                            <a class="btn btn-primary" role="button" href="<?php echo base_url(); ?>PlanRutaController/consultarPartidasPedido/<?php echo $pedido['Pedido']; ?>">
                                <i class="fa fa-wrench"></i> Partidas
                            </a>
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
                            <?php echo $pedido['Pedido']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['pedidoespecial']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['FechaPedido']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['NumOrden']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['FechaLiberacion']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['Partidas']; ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($pedido['Importe']); ?>
                        </td>
                    </tr>
                </tbody>
                <?php endforeach;
                ?>
            </table>
            <?php endif;
            ?>
        </div>

    </div><!-- //columna -->

</article><!-- //renglon -->