<article class="row">

    <div class="col-md-12">

        <!-- MENU DE NAVEGACION -->
        <ul class="nav nav-pills nav-justified ">
            <li role="presentation"><a href="<?php echo base_url() ?>PlanRutaController/mostrarDatosCliente/<?php echo $_SESSION['cliente']; ?>"><i class="fa fa-user"></i> Datos Generales</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>visitas"><i class="fa fa-calendar-check-o"></i> Visitas</a></li>
            <li role="presentation" class="active"><a href=""><i class="fa fa-money"></i> Cobranza</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>saldos"><i class="fa fa-bank"></i> Saldos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>entregas"><i class="fa fa-truck"></i> Entregas</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>pedidos"><i class="fa fa-shopping-cart"></i> Pedidos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>planruta"><i class="fa fa-map-o"></i> Plan Ruta</a></li>
        </ul>

        <br>

        <!-- TABLA PARA MOSTRAR LOS REGISTROS DE LAS COBRANZAS REALIZADAS -->
        <div class="tabla-responsive">
            <?php if (isset($cobranza)):
            ?>
            <!--el objeto tbCobranza ejecuta un plugin de js llamado DataTables (ver archivo formato_tablas.js)
                que sirve para aplicar diversos formatos a las tablas html
            -->
            <table id="tbCobranza" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>
                            Cliente
                        </th>
                        <th>
                            Recibo
                        </th>
                        <th>
                            Fecha
                        </th>
                        <th>
                            Tipo
                        </th>
                        <th>
                            Banco
                        </th>
                        <th>
                            Referencia
                        </th>
                        <th>
                            Importe Pago
                        </th>
                        <th>
                            Comentarios
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cobranza as $cob): ?>
                    <tr>
                        <td>
                            <?php echo utf8_encode($cob['name']); ?>
                        </td>
                        <td>
                            <?php echo $cob['NumRecibo']; ?>
                        </td>
                        <td>
                            <?php echo $cob['Fecha']; ?>
                        </td>
                        <td>
                            <?php echo $cob['Tipo']; ?>
                        </td>
                        <td>
                            <?php echo $cob['Banco']; ?>
                        </td>
                        <td>
                            <?php echo $cob['Docno']; ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($cob['TotalPago']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($cob['Comentarios']); ?>
                        </td>
                    </tr>
                    <?php endforeach;
                    ?>
                </tbody>
            </table>
            <?php endif;
            ?>

        </div>

        <br>

        <div>

            <a class="btn btn-warning" role="button" href="<?php echo base_url() ?>registrar_cobranza">
                <i class="fa fa-usd"></i>
                Registrar Cobranza
            </a>

            <a class="btn btn-warning" role="button" href="<?php echo base_url() ?>pedido">
                <i class="fa fa-folder-open-o"></i>
                Registrar Pedido
            </a>


        </div>


    </div><!-- //columna -->

</article><!-- //renglon -->