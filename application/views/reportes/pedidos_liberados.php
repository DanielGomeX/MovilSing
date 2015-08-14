<article class="contenido">
    <h3>Pedidos Liberados del Periodo</h3>
    <!-- Guardamos en una vaiable de sesion la url que manda llamar a las partidas, para que
    el link regresar nos mande nuevamente a esta pantalla -->
    <?php $_SESSION['regresar']=$this->uri->uri_string(); ?>
    <div class="tabla-responsive">
        <?php if (isset($pedidos)) {  ?>
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
                        Fecha Pedido
                    </th>
                    <th>
                        Num. Orden
                    </th>
                    <th>
                        Fech. Liberacion
                    </th>
                    <th>
                        Dias en Retención
                    </th>
                    <th>
                        Partidas
                    </th>
                    <th>
                        Importe
                    </th>
                    <th>
                        Comentario
                    </th>
                </tr>
            </thead>
            <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td>
                    <a class="btn btn-primary" role="button" href="<?php echo base_url(); ?>PedidosController/consultarPartidasPedido/<?php echo $pedido['Pedido']; ?>">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                        Partidas
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
                    <?php echo $pedido['FechaPedido']; ?>
                </td>
                <td>
                    <?php echo $pedido['NumOrden']; ?>
                </td>
                <td>
                    <?php echo $pedido['FechaLiberacion']; ?>
                </td>
                <td>
                    <?php echo $pedido['DiasRetencion']; ?>
                </td>
                <td>
                    <?php echo $pedido['Partidas']; ?>
                </td>
                <td>
                    <?php echo '$'.number_format($pedido['Importe']); ?>
                </td>
                <td>
                    <?php echo utf8_encode($pedido['Comentario']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php } ?>
</div>
</article>