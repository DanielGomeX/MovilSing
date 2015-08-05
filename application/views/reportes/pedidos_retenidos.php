<article class="contenido">
    <h3>Pedidos Retenidos del Periodo</h3>
    <!-- Guardamos en una vaiable de sesion la url que manda llamar a las partidas, para que
    el link regresar nos mande nuevamente a esta pantalla -->
    <?php $_SESSION['regresar']=$this->uri->uri_string(); ?>
    <div class="tabla-responsive">
        <?php if (isset($pedidos)) {  ?>
        <table id="tbPedidosRetenidos" class="table table-hover table-condensed">
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
                        Días Retenido
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
                    <th>
                        Causa Retención
                    </th>
                </tr>
            </thead>
            <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td>
                    <a href="<?php echo base_url(); ?>PedidosController/consultarPartidasPedido/<?php echo $pedido['Pedido']; ?>">Partidas</a>
                </td>
                <td>
                    <?php echo $pedido['TipoCliente']; ?>
                </td>
                <td>
                    <?php echo $pedido['custid']; ?>
                </td>
                <td>
                    <?php echo $pedido['Name']; ?>
                </td>
                <td>
                    <?php echo $pedido['Pedido']; ?>
                </td>
                <td>
                    <?php echo $pedido['FechaPedido']; ?>
                </td>
                <td>
                    <?php echo $pedido['DiasRetenido']; ?>
                </td>
                <td>
                    <?php echo $pedido['Partidas']; ?>
                </td>
                <td>
                    <?php echo '$'.number_format($pedido['Importe']); ?>
                </td>
                <td>
                    <?php echo $pedido['Comentario']; ?>
                </td>
                <td>
                    <?php echo $pedido['CausaRetencion']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php } ?>
</div>
</article>