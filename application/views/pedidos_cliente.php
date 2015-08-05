<article class="contenido">
    <h3>Ultimos pedidos del cliente</h3>
    <a href="<?php echo base_url(); ?>PlanRutaController/mostrarDatosCliente/<?php echo $_SESSION['cliente']; ?>">Regresar</a>

    <?php

    #arreglo con los status permitidos para que el pedido pueda ser retomado nuevamente
    $status_retomar = array("C", "AP", "RP", "V");

    ?>

    <div class="tabla-responsive">
        <?php if (isset($pedidos)) {  ?>
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
            <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td>
                    <a href="<?php echo base_url(); ?>PedidosController/consultarPartidasPedido/<?php echo $pedido['Pedido']; ?>">Partidas</a>
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
                    <?php echo $pedido['Name']; ?>
                </td>
                <td>
                    <!-- Si el status del pedidos es igual cualquiera de los satus permitidos contenidos en el arreglo "status_remotar"
                    entonces, mostramos el link para poder retomar dicho pedido -->
                    <?php if (in_array($pedido['StatusPedido'], $status_retomar)):  ?>
                    <a href="<?php echo base_url(); ?>retomar/<?php echo $pedido['Pedido']; ?>">Retomar</a>
                <?php endif ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php } ?>
</div>
</article>