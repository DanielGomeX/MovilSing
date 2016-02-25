<article class="row">

    <div class="col-md-12">

        <h2>Pedidos Retenidos del Periodo</h2>

        <!-- Guardamos en una vaiable de sesion la url que manda llamar a las partidas, para que
        el link regresar nos mande nuevamente a esta pantalla -->
        <?php $_SESSION['regresar']=$this->uri->uri_string(); ?>

        <!--el objeto tbPedidosRetenidos ejecuta un plugin de js llamado DataTables (ver archivo formato_tablas.js)
            que sirve para aplicar diversos formatos a las tablas html
        -->
        <div class="table-responsive">
            <?php if (isset($pedidos)):
            ?>
            <table id="tbPedidosRetenidos" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>

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
                            Estación
                        </th>
                        <th>
                            Fecha Pedido
                        </th>
                        <th>
                            Días Retenido
                        </th>
                        <th>
                            Importe
                        </th>
                        <th>
                            Causa Retención
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td>
                            <a class="btn btn-primary" role="button" href="<?php echo base_url(); ?>PlanRutaController/consultarPartidasPedido/<?php echo $pedido['Pedido']; ?>">
                                <i class="fa fa-wrench"></i>
                                Partidas
                            </a>
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
                            <?php echo $pedido['Status']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['FechaPedido']; ?>
                        </td>
                        <td>
                            <?php echo $pedido['DiasRetenido']; ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($pedido['Importe']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($pedido['CausaRetencion']); ?>
                        </td>
                        <td>
                            <a class="btn btn-primary" role="button" href="<?php echo base_url(); ?>PlanRutaController/mostrarComentariosPedido/<?php echo $pedido['Pedido']; ?>">
                                <i class="fa fa-commenting-o"></i>
                                Comentarios
                            </a>
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