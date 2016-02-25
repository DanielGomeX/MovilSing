<article class="row">

    <div class="col-md-12">

        <!-- MENU DE NAVEGACION -->
        <ul class="nav nav-pills nav-justified ">
            <li role="presentation"><a href="<?php echo base_url() ?>PlanRutaController/mostrarDatosCliente/<?php echo $_SESSION['cliente']; ?>"><i class="fa fa-user"></i> Datos Generales</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>visitas"><i class="fa fa-calendar-check-o"></i> Visitas</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>cobranza"><i class="fa fa-money"></i> Cobranza</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>saldos"><i class="fa fa-bank"></i> Saldos</a></li>
            <li role="presentation" class="active"><a href=""><i class="fa fa-truck"></i> Entregas</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>pedidos"><i class="fa fa-shopping-cart"></i> Pedidos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>planruta"><i class="fa fa-map-o"></i> Plan Ruta</a></li>
        </ul>

        <br>

        <div class="table-responsive">
            <?php if (isset($entregas)):
            ?>
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
                    <?php foreach ($entregas as $entrega):
                    ?>
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
                            <a href="<?php echo $entrega['LinkRastreo']; ?>" target="_blank">
                                <i class="fa fa-external-link"></i>
                                Consultar
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