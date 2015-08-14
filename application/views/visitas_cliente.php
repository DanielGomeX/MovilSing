<article class="container">
    <div>
        <ul class="nav nav-pills nav-justified ">
            <li role="presentation"><a href="<?php echo base_url(); ?>PlanRutaController/mostrarDatosCliente/<?php echo $_SESSION['cliente']; ?>">Datos Generales</a></li>
            <li role="presentation" class="active"><a href="#">Visitas</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>cobranza">Cobranza</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>saldos">Saldos Vencidos</a></li>
            <li role="presentation"><a href="<?php echo base_url() ?>entregas">Entregas</a></li>
        </ul>
    </div>
    <br>
    <div class="tabla-responsive">
       <?php if (isset($visitas)) {  ?>
       <table id="tbVisitas" class="table table-hover table-condensed">
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
        <?php endforeach; ?>
        <tbody>
        </table>
        <?php } ?>

    </div>
<br>

<form id="frmVisitaNoExitosa" action='<?php echo base_url(); ?>PlanRutaController/registrarVisitaNoExitosa' method="post">
    <div class="form-group">
        <label for="comentario">Registrar una visita NO exitosa:</label>
        <input type="text" id="comentario" name="comentario" class="form-control" autocomplete="off" tabindex="1"  placeholder="breve motivo por lo que no fue exitosa la visita" />
        <?php echo form_error('comentario'); ?>
    </div>
    <div>
        <button type="submit" id="btnRegistrar" class="btn btn-warning" tabindex="2">
           <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
           Registrar Visita
       </button>
   </div>
</form>

</article>