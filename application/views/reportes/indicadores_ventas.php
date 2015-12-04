<article class="row">

    <div class="col-md-12">

        <h2 class="texto-centrado">Indicadores</h2>


        <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DEL CLIENTE Y REGISTRAR UN NUEVO PEDIDO-->
        <form class="form-horizontal" method="post" action="<?php echo base_url() ?>pedido">

            <div class="form-group">
                <label for="ObjMensual" class="col-sm-2 control-label">Objetivo Venta (Mes Actual):</label>
                <div class="col-sm-8">
                    <input type="text" id="ObjMensual" name="ObjMensual" value="<?php echo '$'.number_format($ObjMensual,2) ?>" class="form-control" tabindex="1" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="FactMensual" class="col-sm-2 control-label">Facturado (Mes Actual):</label>
                <div class="col-sm-8">
                    <input type="text" id="FactMensual" name="FactMensual"  value="<?php echo '$'.number_format($FactMensual,2); ?>" class="form-control" tabindex="2" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="CobMensual" class="col-sm-2 control-label">Cobrando (Mes Actual):</label>
                <div class="col-sm-8">
                    <input type="text" id="CobMensual" name="CobMensual" value="<?php echo '$'.number_format($CobMensual,2); ?>" class="form-control" tabindex="3" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="Faltan" class="col-sm-2 control-label">Faltante para Objetivo Mensual:</label>
                <div class="col-sm-8">
                    <input type="text" id="Faltan" name="Faltan" value="<?php echo '$'.number_format($Faltan,2); ?>" class="form-control" tabindex="4" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="ObjDia" class="col-sm-2 control-label">Objetivo Venta (Día):</label>
                <div class="col-sm-8">
                    <input type="text" id="ObjDia" name="ObjDia" value="<?php echo '$'.number_format($ObjDia,2); ?>" class="form-control" tabindex="5" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="MontoPedidosLib" class="col-sm-2 control-label">Pedidos Liberados (Día):</label>
                <div class="col-sm-8">
                    <input type="text" id="MontoPedidosLib" name="MontoPedidosLib" value="<?php echo '$'.number_format($MontoPedidosLib,2); ?>" class="form-control" tabindex="6" readonly/>
                </div>
            </div>

            <div class="form-group" >
                <label for="MontoPedidosret" class="col-sm-2 control-label">Pedidos Retenidos (Día):</label>
                <div class="col-sm-8">
                    <input type="text" id="MontoPedidosret" name="MontoPedidosret" value="<?php echo '$'.number_format($MontoPedidosret,2); ?>" class="form-control" tabindex="7" readonly/>
                </div>
            </div>

<!--             <div class="form-group">
                <button  type="submit" id="btnPedido" class="col-sm-offset-2 btn btn-warning " tabindex="16">
                    <i class="fa fa-folder-open-o"></i>
                    Registar Pedido
                </button>
            </div> -->

        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos la API de Google Maps y el script de localizacion  -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtXzg7ZtNXclFqe3sKbDXvgd2FLL-44f0" ></script>
<script src="<?php echo base_url();?>static/js/geolocalizacion.js"></script>



