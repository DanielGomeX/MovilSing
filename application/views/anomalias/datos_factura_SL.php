<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">Datos Factura</h2>



        <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DE LA FACTURA -->
        <form class="form-horizontal" method="post">

            <!-- Datos Generales -->

            <div class="form-group">
                <label for="factura" class="col-sm-2 control-label">Factura:</label>
                <div class="col-sm-10">
                    <input type="text" id="factura" name="factura" value="<?php echo $factura ?>" class="form-control" tabindex="1" autocomplete="off" />
                </div>
            </div>

            <div class="form-group" >
                <label for="invcDate" class="col-sm-2 control-label">Fecha factura:</label>
                <div class="col-sm-10">
                    <input type="text" id="invcDate" name="invcDate" value="<?php echo $invcDate ?>" class="form-control" tabindex="11" />
                </div>
            </div>


            <div class="form-group">
                <label for="custid" class="col-sm-2 control-label">Cliente:</label>
                <div class="col-sm-10">
                    <input type="text" id="custid" name="custid" value="<?php echo $custid ?>" class="form-control" tabindex="5"  autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="cliente" class="col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-10">
                    <input type="text" id="cliente" name="cliente" value="<?php echo $cliente ?>" class="form-control" tabindex="6" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="zona" class="col-sm-2 control-label">Zona:</label>
                <div class="col-sm-10">
                    <input type="text" id="zona" name="zona" value="<?php echo $zona ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="vendedor" class="col-sm-2 control-label">Representante:</label>
                <div class="col-sm-10">
                    <input type="text" id="vendedor" name="vendedor" value="<?php echo $vendedor ?>" class="form-control" tabindex="15" placeholder="máximo 30 caracteres" autocomplete="off"/>
                </div>
            </div>


            <div class="form-group">
                <label for="monto" class="col-sm-2 control-label">Monto:</label>
                <div class="col-sm-10">
                    <input type="text" id="monto" name="monto" value="<?php echo $monto ?>" class="form-control" tabindex="15" placeholder="máximo 30 caracteres" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="monto2" class="col-sm-2 control-label">Monto 2:</label>
                <div class="col-sm-10">
                    <input type="text" id="monto2" name="monto2" value="<?php echo $monto2 ?>" class="form-control" tabindex="15" placeholder="máximo 30 caracteres" autocomplete="off"/>
                </div>
            </div>


            <!-- //datos generales -->


            <div class="form-group">
                <button  type="submit" id="btnProspecto" class="col-sm-offset-2 btn btn-warning " tabindex="29">
                    <i class="fa fa-pencil-square-o"></i>
                    Actualizar Información
                </button>
            </div>
        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos el sript que se usa para las devoluciones -->
<script src="<?php echo base_url();?>static/js/devoluciones.js"></script>
