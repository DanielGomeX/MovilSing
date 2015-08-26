<article class="row">

    <div class="col-md-12">

        <!-- MENU DE NAVEGACION -->
        <ul class="nav nav-pills nav-justified ">
            <li role="presentation"><a href="<?php echo base_url(); ?>PlanRutaController/mostrarDatosCliente/<?php echo $_SESSION['cliente']; ?>"><i class="fa fa-user"></i> Datos Generales</a></li>
            <li role="presentation" class="active"><a href=""><i class="fa fa-calendar-check-o"></i> Visitas</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>cobranza"><i class="fa fa-money"></i> Cobranza</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>saldos"><i class="fa fa-bank"></i> Saldos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>entregas"><i class="fa fa-truck"></i> Entregas</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>pedidos"><i class="fa fa-shopping-cart"></i> Pedidos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>planruta"><i class="fa fa-map-o"></i> Plan Ruta</a></li>
        </ul>

        <br>

        <!-- TABLA PARA MOSTRAR LOS REGISTROS DE LAS VISITAS REALIZADAS -->
        <div class="tabla-responsive">
            <?php if (isset($visitas)):
            ?>
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>
                            Fecha
                        </th>
                        <th>
                            Comentario
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($visitas as $visita): ?>
                    <tr>
                        <td>
                            <?php echo $visita['Fecha']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($visita['Comentario']); ?>
                        </td>
                    </tr>
                    <?php endforeach;
                    ?>
                </tbody>
            </table>
            <?php endif;
            ?>
        </div>

        <!-- FORMULARIO PARA LA CAPTURA DE UNA VISITA NO EXITOSA -->
        <form action='<?php echo base_url(); ?>PlanRutaController/registrarVisitaNoExitosa' method="post">
            <div class="form-group">
                <label for="comentario">Registrar una visita NO exitosa:</label>
                <input type="text" id="comentario" name="comentario" class="form-control" autocomplete="off" tabindex="1"  placeholder="breve motivo por lo que no fue exitosa la visita" />
                <?php echo form_error('comentario'); ?>
            </div>
            <button type="submit" id="btnRegistrar" class="btn btn-warning" tabindex="2">
                <i class="fa fa-check"></i>
                Registrar Visita
            </button>

        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->