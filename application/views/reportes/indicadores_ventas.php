<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">Indicadores del Mes</h2>

        <br>

        <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DEL CLIENTE Y REGISTRAR UN NUEVO PEDIDO-->
        <form class="form-horizontal">

            <div class="form-group">
                <label for="ObjMensual" class="col-sm-4 control-label">Objetivo Venta (Mes Actual):</label>
                <div class="col-sm-6">
                    <input type="text" id="ObjMensual" name="ObjMensual" value="<?php echo '$'.number_format($ObjMensual,2) ?>" class="form-control" tabindex="1" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="FactMensual" class="col-sm-4 control-label">Facturado (Mes Actual):</label>
                <div class="col-sm-6">
                    <input type="text" id="FactMensual" name="FactMensual"  value="<?php echo '$'.number_format($FactMensual,2); ?>" class="form-control" tabindex="2" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="CobMensual" class="col-sm-4 control-label">Cobrando (Mes Actual):</label>
                <div class="col-sm-6">
                    <input type="text" id="CobMensual" name="CobMensual" value="<?php echo '$'.number_format($CobMensual,2); ?>" class="form-control" tabindex="3" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="Faltan" class="col-sm-4 control-label">Faltante para Objetivo Mensual:</label>
                <div class="col-sm-6">
                    <input type="text" id="Faltan" name="Faltan" value="<?php echo '$'.number_format($Faltan,2); ?>" class="form-control" tabindex="4" readonly/>
                </div>
            </div>

        <h2 class="texto-centrado">Indicadores del día</h2>

            <hr>

            <div class="form-group">
                <label for="ObjDia" class="col-sm-4 control-label">Objetivo Venta (Día):</label>
                <div class="col-sm-6">
                    <input type="text" id="ObjDia" name="ObjDia" value="<?php echo '$'.number_format($ObjDia,2); ?>" class="form-control" tabindex="5" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="MontoPedidosLib" class="col-sm-4 control-label">Pedidos Liberados (Día):</label>
                <div class="col-sm-6">
                    <input type="text" id="MontoPedidosLib" name="MontoPedidosLib" value="<?php echo '$'.number_format($MontoPedidosLib,2); ?>" class="form-control" tabindex="6" readonly/>
                </div>
            </div>

            <div class="form-group" >
                <label for="MontoPedidosret" class="col-sm-4 control-label">Pedidos Retenidos (Día):</label>
                <div class="col-sm-6">
                    <input type="text" id="MontoPedidosret" name="MontoPedidosret" value="<?php echo '$'.number_format($MontoPedidosret,2); ?>" class="form-control" tabindex="7" readonly/>
                </div>
            </div>

        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->


