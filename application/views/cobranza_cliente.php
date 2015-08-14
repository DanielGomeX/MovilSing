<article class="container">
    <div>
        <ul class="nav nav-pills nav-justified ">
            <li role="presentation"><a href="<?php echo base_url(); ?>PlanRutaController/mostrarDatosCliente/<?php echo $cliente; ?>">Datos Generales</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>visitas">Visitas</a></li>
            <li role="presentation" class="active"><a href="#">Cobranza</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>saldos">Saldos Vencidos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>entregas">Entregas</a></li>
        </ul>
    </div>
    <br>
    <div class="tabla-responsive">
     <?php if (isset($cobranza)) {  ?>
     <table id="tbCobranza" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th>
                    Cliente
                </th>
                <th>
                    Nombre
                </th>
                <th>
                    Fecha
                </th>
                <th>
                    Tipo
                </th>
                <th>
                    Recibo
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
                    <?php echo $cob['CustId']; ?>
                </td>
                <td>
                    <?php echo utf8_encode($cob['name']); ?>
                </td>
                <td>
                    <?php echo $cob['Fecha']; ?>
                </td>
                <td>
                    <?php echo $cob['Tipo']; ?>
                </td>
                <td>
                    <?php echo $cob['NumRecibo']; ?>
                </td>
                <td>
                    <?php echo '$'.number_format($cob['TotalPago']); ?>
                </td>
                <td>
                    <?php echo utf8_encode($cob['Comentarios']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tbody>
        </table>
        <?php } ?>

    </div>

<a href="<?php echo base_url() ?>PlanRutaController/registrarCobranza">Registrar</a>
</article>