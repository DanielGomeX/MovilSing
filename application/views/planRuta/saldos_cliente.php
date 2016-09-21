<article class="row">

    <div class="col-md-12">

        <!-- MENU DE NAVEGACION -->
        <ul class="nav nav-pills nav-justified ">
            <li role="presentation"><a href="<?php echo base_url() ?>PlanRutaController/mostrarDatosCliente/<?php echo $_SESSION['cliente']; ?>"><i class="fa fa-user"></i> Datos Generales</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>visitas"><i class="fa fa-calendar-check-o"></i> Visitas</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>cobranza"><i class="fa fa-money"></i> Cobranza</a></li>
            <li role="presentation" class="active"><a href=""><i class="fa fa-bank"></i> Saldos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>entregas"><i class="fa fa-truck"></i> Entregas</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>pedidos"><i class="fa fa-shopping-cart"></i> Pedidos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>planruta"><i class="fa fa-map-o"></i> Plan Ruta</a></li>
        </ul>

        <h2>Saldos Vencidos a más de 45 días (fecha factura) </h2>

        <br>

        <!-- TABLA PARA MOSTRAR LOS REGISTROS DE LAS FACTURAS CON SALDOS -->
        <div class="tabla-responsive">
            <?php if (isset($saldos)):
            ?>
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>
                            Factura
                        </th>
                        <th>
                            Saldo
                        </th>
                        <th>
                            Vence
                        </th>
                    </tr>
                </thead>
                <?php foreach ($saldos as $saldos):
                ?>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $saldos['Factura']; ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($saldos['Saldo']); ?>
                        </td>
                        <td>
                            <?php echo $saldos['Vence']; ?>
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