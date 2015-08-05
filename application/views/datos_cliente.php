<article class="col-md-10">
    <h2 class="texto-centrado">
        Datos del Cliente Seleccionado
    </h2>

    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>pedido">
        <div class="form-group">
            <ul class="nav nav-pills nav-justified ">
                <li role="presentation"><a href="<?php echo base_url() ?>visitas">Visitas</a></li>
                <li role="presentation"><a href="<?php echo base_url() ?>cobranza">Cobranza</a></li>
                <li role="presentation"><a href="<?php echo base_url() ?>saldos">Saldos Vencidos</a></li>
                <li role="presentation"><a href="<?php echo base_url() ?>entregas">Entregas</a></li>
                <li role="presentation"><a href="<?php echo base_url() ?>planruta">Plan Ruta</a></li>
                <li role="presentation"><a href="<?php echo base_url() ?>pedidos">Pedidos</a></li>
            </ul>
        </div>

    <!-- Guardamos en una vaiable de sesion la url que manda llamar a las partidas, para que
    el link regresar nos mande nuevamente a esta pantalla -->
    <?php $_SESSION['regresar']=$this->uri->uri_string(); ?>

    <div class="form-group">
        <label for="zona" class="col-sm-2 control-label">Zona:</label>
        <div class="col-sm-10">
            <input type="text" id="zona" name="zona" value="<?php echo $zona; ?>" class="form-control" tabindex="1" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label for="cliente" class="col-sm-2 control-label">Cliente</label>
        <div class="col-sm-10">
            <input type="text" id="cliente" name="cliente"  value="<?php echo $cliente; ?>" class="form-control" tabindex="2" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label for="nombre" class="col-sm-2 control-label">Nombre:</label>
        <div class="col-sm-10">
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" class="form-control" tabindex="3" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label for="tipoCliente" class="col-sm-2 control-label">Tipo de Cliente:</label>
        <div class="col-sm-10">
            <input type="text" id="TipoCliente" name="TipoCliente" value="<?php echo $tipo_cliente; ?>" class="form-control" tabindex="4" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label for="direccion" class="col-sm-2 control-label">Direccion:</label>
        <div class="col-sm-10">
            <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" class="form-control" tabindex="5" readonly/>
        </div>

    </div>

    <div class="form-group">
        <label for="colonia" class="col-sm-2 control-label">Colonia:</label>
        <div class="col-sm-10">
            <input type="text" id="colonia" name="colonia" value="<?php echo $colonia; ?>" class="form-control" tabindex="6" readonly/>
        </div>

    </div>

    <div class="form-group" >
        <label for="ciudad" class="col-sm-2 control-label">Ciudad:</label>
        <div class="col-sm-10">
            <input type="text" id="ciudad" name="ciudad" value="<?php echo $ciudad; ?>" class="form-control" tabindex="7" readonly/>
        </div>
    </div>

    <div class="form-group" >
        <label for="estado" class="col-sm-2 control-label">Estado:</label>
        <div class="col-sm-10">
            <input type="text" id="estado" name="estado" value="<?php echo $estado; ?>" class="form-control" tabindex="8" readonly/>
        </div>
    </div>

    <div class="form-group" >
        <label for="email" class="col-sm-2 control-label">email:</label>
        <div class="col-sm-10">
            <input type="text" id="email" name="email" value="<?php echo $email; ?>" class="form-control" tabindex="9" readonly/>
        </div>
    </div>

    <hr>

    <div class="form-group" >
        <label for="CondPago" class="col-sm-2 control-label">Cond. Pago:</label>
        <div class="col-sm-10">
            <input type="text" id="CondPago" name="CondPago" value="<?php echo $cond_pago; ?>" class="form-control" tabindex="10" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label for="LimiteCredito" class="col-sm-2 control-label">Limite Credito:</label>
        <div class="col-sm-10">
            <input type="text" id="LimiteCredito" name="LimiteCredito" value="<?php echo '$'.number_format($limite_credito); ?>" class="form-control" tabindex="11" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label for="CreditoDisponible" class="col-sm-2 control-label">Credito Disponible:</label>
        <div class="col-sm-10">
            <input type="text" id="CreditoDisponible" name="CreditoDisponible" value="<?php echo '$'.number_format($credito_disponible); ?>" class="form-control" tabindex="12" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label for="DiasPromPago" class="col-sm-2 control-label">Dias Prom. Pago:</label>
        <div class="col-sm-10">
            <input type="text" id="DiasPromPago" name="DiasPromPago" value="<?php echo $dias_prom_pago; ?>" class="form-control" tabindex="13" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label for="ChequesDevueltos" class="col-sm-2 control-label">Cheques Devueltos:</label>
        <div class="col-sm-10">
            <input type="text" id="ChequesDevueltos" name="ChequesDevueltos" value="<?php echo $cheques_devueltos; ?>" class="form-control" tabindex="14" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label for="SaldoActual" class="col-sm-2 control-label">Saldo actual:</label>
        <div class="col-sm-10">
            <input type="text" id="SaldoActual" name="SaldoActual" value="<?php echo '$'.number_format($saldo_actual); ?>" class="form-control" tabindex="15" readonly/>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button  type="submit" id="btnPedido" class="btn btn-warning " tabindex="16">
                <span class="glyphicon glyphicon-file" aria-hidden="true"></span>Registar Pedido
            </button>
        </div>
    </div>

</form>
</article>
