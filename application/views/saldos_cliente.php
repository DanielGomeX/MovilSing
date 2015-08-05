<article class="contenido">
    <div>
        <ul class="nav nav-pills nav-justified ">
            <li role="presentation"><a href="<?php echo base_url(); ?>PlanRutaController/mostrarDatosCliente/<?php echo $cliente; ?>">Datos Generales</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>visitas">Visitas</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>cobranza">Cobranza</a></li>
            <li role="presentation" class="active"><a href="#">Saldos Vencidos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>entregas">Entregas</a></li>
        </ul>
    </div>
    <br>
    <div class="tabla-responsive">
        <?php if (isset($saldos)) {  ?>
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
            <?php foreach ($saldos as $saldos): ?>
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
        <?php endforeach; ?>
    </table>
    <?php } ?>
</div>
</article>