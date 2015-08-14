<article class="contenido">
    <div>
        <ul class="nav nav-pills nav-justified ">
            <li role="presentation"><a href="<?php echo base_url() ?>PlanRutaController/mostrarDatosCliente/<?php echo $cliente; ?>">Datos Generales</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>visitas">Visitas</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>cobranza">Cobranza</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>saldos">Saldos Vencidos</a></li>
            <li role="presentation" class="active"><a href="#">Entregas</a></li>
        </ul>
    </div>
    <br>
    <div class="table-responsive">
        <?php if (isset($entregas)) {  ?>
        <table id="tbEntregas" class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th>
                        Pedido
                    </th>
                    <th>
                        Fecha Pedido
                    </th>
                    <th>
                        Factura
                    </th>
                    <th>
                        Fecha Factura
                    </th>
                    <th>
                        Importe
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Transportista
                    </th>
                    <th>
                        Fecha Surtimiento
                    </th>
                    <th>
                        Fecha Embarque
                    </th>
                    <th>
                        Fecha Acuse
                    </th>
                    <th>
                        Dias Hasta Entrega
                    </th>
                    <th>
                        No Guia
                    </th>
                    <th>
                        Link Rastreo
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entregas as $entrega): ?>
                <tr>
                    <td>
                        <?php echo $entrega['Pedido']; ?>
                    </td>
                    <td>
                        <?php echo $entrega['FechaPedido']; ?>
                    </td>
                    <td>
                        <?php echo $entrega['Factura']; ?>
                    </td>
                    <td>
                        <?php echo $entrega['FechaFactura']; ?>
                    </td>
                    <td>
                        <?php echo '$'.number_format($entrega['Importe']); ?>
                    </td>
                    <td>
                        <?php echo $entrega['Status']; ?>
                    </td>
                    <td>
                        <?php echo utf8_encode($entrega['Transportista']); ?>
                    </td>
                    <td>
                        <?php echo $entrega['FechaSurtimiento']; ?>
                    </td>
                    <td>
                        <?php echo $entrega['FechaEmbarque']; ?>
                    </td>
                    <td>
                        <?php echo $entrega['FechaAcuseRecibo']; ?>
                    </td>
                    <td>
                        <?php echo $entrega['DiasHastaEntrega']; ?>
                    </td>
                    <td>
                        <?php echo $entrega['NoGuia']; ?>
                    </td>
                    <td>
                        <a href="<?php echo $entrega['LinkRastreo']; ?>" target="_blank">Consultar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php } ?>

</div>

</article>