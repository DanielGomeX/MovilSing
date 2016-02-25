<article class="row">

    <div class="col-md-12">

        <h2 class="texto-centrado">Datos del Cliente Seleccionado</h2>

        <!-- MENU DE NAVEGACION -->
        <div class="form-group">
            <ul class="nav nav-pills nav-justified ">
                <li role="presentation"><a href="<?php echo base_url() ?>visitas"><i class="fa fa-calendar-check-o"></i> Visitas</a></li>
                <li role="presentation"><a href="<?php echo base_url() ?>cobranza"><i class="fa fa-money"></i> Cobranza</a></li>
                <li role="presentation"><a href="<?php echo base_url() ?>saldos"><i class="fa fa-bank"></i> Saldos</a></li>
                <li role="presentation"><a href="<?php echo base_url() ?>entregas"><i class="fa fa-truck"></i> Entregas</a></li>
                <li role="presentation"><a href="<?php echo base_url() ?>pedidos"><i class="fa fa-shopping-cart"></i> Pedidos</a></li>
                <li role="presentation"><a href="<?php echo base_url() ?>planruta"><i class="fa fa-map-o"></i> Plan Ruta</a></li>
            </ul>
        </div>

        <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DEL CLIENTE Y REGISTRAR UN NUEVO PEDIDO-->
        <form class="form-horizontal" method="post" action="<?php echo base_url() ?>pedido">

            <div class="form-group">
                <label for="zona" class="col-sm-2 control-label">Zona:</label>
                <div class="col-sm-8">
                    <input type="text" id="zona" name="zona" value="<?php echo $zona; ?>" class="form-control" tabindex="1" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="cliente" class="col-sm-2 control-label">Cliente</label>
                <div class="col-sm-8">
                    <input type="text" id="cliente" name="cliente"  value="<?php echo $cliente; ?>" class="form-control" tabindex="2" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" id="nombre" name="nombre" value="<?php echo utf8_encode($nombre); ?>" class="form-control" tabindex="3" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="tipoCliente" class="col-sm-2 control-label">Tipo de Cliente:</label>
                <div class="col-sm-8">
                    <input type="text" id="TipoCliente" name="TipoCliente" value="<?php echo $tipo_cliente; ?>" class="form-control" tabindex="4" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="direccion" class="col-sm-2 control-label">Direccion:</label>
                <div class="col-sm-8">
                    <input type="text" id="direccion" name="direccion" value="<?php echo utf8_encode($direccion); ?>" class="form-control" tabindex="5" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="colonia" class="col-sm-2 control-label">Colonia:</label>
                <div class="col-sm-8">
                    <input type="text" id="colonia" name="colonia" value="<?php echo utf8_encode($colonia); ?>" class="form-control" tabindex="6" readonly/>
                </div>
            </div>

            <div class="form-group" >
                <label for="ciudad" class="col-sm-2 control-label">Ciudad:</label>
                <div class="col-sm-8">
                    <input type="text" id="ciudad" name="ciudad" value="<?php echo utf8_encode($ciudad); ?>" class="form-control" tabindex="7" readonly/>
                </div>
            </div>

            <div class="form-group" >
                <label for="estado" class="col-sm-2 control-label">Estado:</label>
                <div class="col-sm-8">
                    <input type="text" id="estado" name="estado" value="<?php echo utf8_encode($estado); ?>" class="form-control" tabindex="8" readonly/>
                </div>
            </div>

            <div class="form-group" >
                <label for="telefono" class="col-sm-2 control-label">Telefono:</label>
                <div class="col-sm-8">
                    <input type="text" id="telefono" name="telefono" value="<?php echo utf8_encode($telefono); ?>" class="form-control" tabindex="8" readonly/>
                </div>
            </div>

            <div class="form-group" >
                <label for="email" class="col-sm-2 control-label">email:</label>
                <div class="col-sm-8">
                    <input type="text" id="email" name="email" value="<?php echo $email; ?>" class="form-control" tabindex="9" readonly/>
                </div>
            </div>

            <!-- MAPA CON LA UBICACION DEL CLIENTE -->
            <div>
                <input type="hidden" id="latitud" value="<?php echo $latitud; ?>">
                <input type="hidden" id="longitud" value="<?php echo $longitud; ?>">
                <?php if($latitud<>"0"):
                ?>
                <!-- El objeto verMapa ejecuta un javaScript que (ver archivo llamado funiones)-->
                <a class="col-sm-offset-2 btn btn-warning" role="button" id="verMapa" href="">
                    <i class="fa fa-map-marker"></i>
                    Ubicar en mapa
                </a>

                <div class="form-group">
                    <div style='padding-top:10px;'>
                        <div id="mapa" class="col-sm-offset-2 col-sm-8" style='height:300px;'>
                        </div>
                    </div>
                </div>

                <?php endif;
                ?>
            </div>

            <div class="form-group" >
                <label for="CondPago" class="col-sm-2 control-label">Cond. Pago:</label>
                <div class="col-sm-8">
                    <input type="text" id="CondPago" name="CondPago" value="<?php echo $cond_pago; ?>" class="form-control" tabindex="10" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="LimiteCredito" class="col-sm-2 control-label">Limite Credito:</label>
                <div class="col-sm-8">
                    <input type="text" id="LimiteCredito" name="LimiteCredito" value="<?php echo '$'.number_format($limite_credito); ?>" class="form-control" tabindex="11" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="CreditoDisponible" class="col-sm-2 control-label">Credito Disponible:</label>
                <div class="col-sm-8">
                    <input type="text" id="CreditoDisponible" name="CreditoDisponible" value="<?php echo '$'.number_format($credito_disponible); ?>" class="form-control" tabindex="12" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="DiasPromPago" class="col-sm-2 control-label">Dias Prom. Pago:</label>
                <div class="col-sm-8">
                    <input type="text" id="DiasPromPago" name="DiasPromPago" value="<?php echo $dias_prom_pago; ?>" class="form-control" tabindex="13" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="ChequesDevueltos" class="col-sm-2 control-label">Cheques Devueltos:</label>
                <div class="col-sm-8">
                    <input type="text" id="ChequesDevueltos" name="ChequesDevueltos" value="<?php echo $cheques_devueltos; ?>" class="form-control" tabindex="14" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="SaldoActual" class="col-sm-2 control-label">Saldo actual:</label>
                <div class="col-sm-8">
                    <input type="text" id="SaldoActual" name="SaldoActual" value="<?php echo '$'.number_format($saldo_actual); ?>" class="form-control" tabindex="15" readonly/>
                </div>
            </div>

            <div class="form-group">
                <button  type="submit" id="btnPedido" class="col-sm-offset-2 btn btn-warning " tabindex="16">
                    <i class="fa fa-folder-open-o"></i>
                    Registar Pedido
                </button>
            </div>

        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos la API de Google Maps y el script de localizacion  -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtXzg7ZtNXclFqe3sKbDXvgd2FLL-44f0" ></script>
<script src="<?php echo base_url();?>static/js/geolocalizacion.js"></script>



