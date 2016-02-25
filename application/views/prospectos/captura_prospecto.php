<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">Nuevo Prospecto </h2>

        <!-- Formulario Modal para mostrar la búsqueda de códigos postales -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Buscar Colonia / Fracc. por código postal</h4>
                    </div>
                    <div class="modal-body">

                        <!-- FORMULARIO -->
                        <form class="form-inline"  method="post">
                            <div class="form-group" >
                                <label for="cpBuscar">Código Postal: </label>
                                <input type="text" class="form-control" id="cpBuscar" name="cpBuscar" value="<?php echo  set_value('cpBuscar'); ?>" placeholder="5 dígitos requeridos" autocomplete="off" tabindex="1"/>
                                <?php echo form_error('cpBuscar'); ?>
                            </div>

                            <!-- este objeto ejecuta un javascript, ver script llamado prospectos.js -->
                            <button id="btnBuscarCodigo" class="btn btn-warning" tabindex="2">
                                <i class="fa fa-search"></i>
                                Buscar
                            </button>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped table-condensed" id="tbAsentamientos">
                                <!-- esta parte se completa con el código que regresa la consulta ajax programada en el botón:
                                      buscar código postal dentro del archivo script llamado prospectos,js
                                  -->
                              </table>
                          </div>

                      </div>
                      <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                     </div>
                 </div>
             </div>
         </div>
         <!-- //Modal -->


         <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DEL PROSPECTO -->
         <form class="form-horizontal" method="post" action="<?php echo base_url() ?>ProspectosController/registrarProspecto">

            <!-- establecemos el status inicial como (C) "captura" para que el script no oculte los botons de CP y Regitrar Prospecto -->
            <input type="hidden" id="status" name="status" value="C">

            <!-- Datos Generales -->
            <div class="form-group">
                <label for="folio" class="col-sm-2 control-label">Folio:</label>
                <div class="col-sm-10">
                    <input type="text" id="folio" name="folio" value="<?php echo  set_value('folio'); ?>" class="form-control" tabindex="1" autocomplete="off" autofocus/>
                    <?php echo form_error('folio'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="tipoCliente" class="col-sm-2 control-label">Tipo de Solicitud:</label>
                <div class="col-sm-10">
                    <select class="form-control" name="tipoCliente" tabindex="2">
                        <option selected disabled value="">Seleccione una opción</option>
                        <option value="DETALLISTA" <?php echo set_select('tipoCliente', 'DETALLISTA');?> >DETALLISTA</option>
                        <option value="MAYORISTA" <?php echo set_select('tipoCliente', 'MAYORISTA');?> >MAYORISTA</option>
                    </select>
                    <?php echo form_error('tipoCliente'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="localidad" class="col-sm-2 control-label">Localidad:</label>
                <div class="col-sm-10">
                    <select class="form-control" name="localidad" tabindex="3">
                        <option selected disabled value="">Seleccione una opción</option>
                        <option value="LOCAL" <?php echo set_select('localidad', 'LOCAL');?> >LOCAL</option>
                        <option value="FORANEO" <?php echo set_select('localidad', 'FORANEO');?> >FORANEO</option>
                    </select>
                    <?php echo form_error('localidad'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-10">
                    <input type="text" id="nombre" name="nombre" value="<?php echo  set_value('nombre'); ?>" class="form-control" tabindex="4" placeholder="persona física o razón social" autocomplete="off"/>
                    <?php echo form_error('nombre'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="rfc" class="col-sm-2 control-label">RFC:</label>
                <div class="col-sm-10">
                    <input type="text" id="rfc" name="rfc" value="<?php echo  set_value('rfc'); ?>" class="form-control" tabindex="5" placeholder="12 caracteres persona física, 13 persona moral" autocomplete="off"/>
                    <?php echo form_error('rfc'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="direccion" class="col-sm-2 control-label">Direccion:</label>
                <div class="col-sm-10">
                    <input type="text" id="direccion" name="direccion" value="<?php echo  set_value('direccion'); ?>" class="form-control" tabindex="6" placeholder="Calle y número" autocomplete="off"/>
                    <?php echo form_error('direccion'); ?>
                </div>
            </div>

            <div class="form-group" >

                <label for="cp" class="col-sm-2 control-label">C. P. :</label>
                <div class="col-sm-10">
                    <input type="text" id="cp" name="cp" value="<?php echo  set_value('cp'); ?>" class="form-control" tabindex="7" readonly/>
                    <?php echo form_error('cp'); ?>
                </div>
            </div>

            <div class="form-group">
                
                <button type="button" class="btn btn-primary btn-sm col-sm-offset-2" id="btnCP" tabindex="8">
                    <!-- este objeto ejecuta un javascript, ver script llamado prospectos.js  -->
                    <i class="fa fa-search"></i>
                    Código Postal
                </button>
            </div>
            
            <div class="form-group">
                <label for="colonia" class="col-sm-2 control-label">Colonia:</label>
                <div class="col-sm-10">
                    <input type="text" id="colonia" name="colonia" value="<?php echo  set_value('colonia'); ?>" class="form-control" tabindex="9"  readonly/>
                    <?php echo form_error('colonia'); ?>
                </div>
            </div>

            <div class="form-group" >
                <label for="ciudad" class="col-sm-2 control-label">Ciudad:</label>
                <div class="col-sm-10">
                    <input type="text" id="ciudad" name="ciudad" value="<?php echo  set_value('ciudad'); ?>" class="form-control" tabindex="10" readonly/>
                </div>
            </div>

            <div class="form-group" >
                <label for="municipio" class="col-sm-2 control-label">Municipio:</label>
                <div class="col-sm-10">
                    <input type="text" id="municipio" name="municipio" value="<?php echo  set_value('municipio'); ?>" class="form-control" tabindex="11" readonly/>
                </div>
            </div>

            <div class="form-group" >
                <label for="estado" class="col-sm-2 control-label">Estado:</label>
                <div class="col-sm-10">
                    <input type="text" id="estado" name="estado" value="<?php echo  set_value('estado'); ?>" class="form-control" tabindex="12" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label for="giro" class="col-sm-2 control-label">Giro:</label>
                <div class="col-sm-10">
                    <select class="form-control" name="giro" tabindex="13">
                        <option selected disabled value="" >Seleccione una opción</option>
                        <option value="FERRETERIA" <?php echo  set_select('giro', 'FERRETERIA');?> >FERRETERIA</option>
                        <option value="CONSTRUCCION" <?php echo  set_select('giro', 'CONSTRUCCION');?> >CONSTRUCCION</option>
                        <option value="TORNILLERIA" <?php echo  set_select('giro', 'TORNILLERIA');?> >TORNILLERIA</option>
                        <option value="BALCONERIA" <?php echo  set_select('giro', 'BALCONERIA');?> >BALCONERIA</option>
                        <option value="PINTURAS" <?php echo  set_select('giro', 'PINTURAS');?> >PINTURAS</option>
                        <option value="MADERERIA" <?php echo  set_select('giro', 'MADERERIA');?> >MADERERIA</option>
                        <option value="ACEROS Y PERFILES" <?php echo  set_select('giro', 'ACEROS Y PERFILES');?> >ACEROS Y PERFILES </option>
                        <option value="OTROS" <?php echo  set_select('giro', 'OTROS');?> >OTROS </option>
                    </select>
                    <?php echo form_error('giro'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="representante" class="col-sm-2 control-label">Representante del negocio:</label>
                <div class="col-sm-10">
                    <input type="text" id="representante" name="representante" value="<?php echo  set_value('representante'); ?>" class="form-control" tabindex="14" placeholder="nombre del representante del negocio" autocomplete="off"/>
                    <?php echo form_error('representante'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="gerente" class="col-sm-2 control-label">Gerente del negocio:</label>
                <div class="col-sm-10">
                    <input type="text" id="gerente" name="gerente" value="<?php echo  set_value('gerente'); ?>" class="form-control" tabindex="15" placeholder="máximo 30 caracteres" autocomplete="off"/>
                    <?php echo form_error('gerente'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="telefono" class="col-sm-2 control-label">Teléfono:</label>
                <div class="col-sm-10">
                    <input type="text" id="telefono" name="telefono" value="<?php echo  set_value('telefono'); ?>" class="form-control" tabindex="16" placeholder="incluir clave lada, 10 dígitos, no parentesis, no guiones, no espacios "/>
                    <?php echo form_error('telefono'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-10">
                    <input type="text" id="email" name="email" value="<?php echo  set_value('email'); ?>" class="form-control" tabindex="17" placeholder="máximo 30 caracteres" autocomplete="off"/>
                    <?php echo form_error('email'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="comentarios" class="col-sm-2 control-label">Comentarios:</label>
                <div class="col-sm-10">
                    <input type="text" id="comentarios" name="comentarios" value="<?php echo  set_value('comentarios'); ?>" class="form-control" tabindex="18" autocomplete="off"/>
                    <?php echo form_error('comentarios'); ?>
                </div>
            </div>
            <!-- //datos generales -->


            <!-- Datos para las Referencias -->
            <div class="well well-sm">
                <h4>Referencias</h4>
            </div>

            <div class="form-group">
                <label for="empresa1" class="col-sm-2 control-label">Empresa 1:</label>
                <div class="col-sm-10">
                    <input type="text" id="empresa1" name="empresa1" value="<?php echo  set_value('empresa1'); ?>" class="form-control" tabindex="19" />
                    <?php echo form_error('empresa1'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="empresa1telefono" class="col-sm-2 control-label">Teléfono Empresa 1:</label>
                <div class="col-sm-10">
                    <input type="text" id="empresa1telefono" name="empresa1telefono" value="<?php echo  set_value('empresa1telefono'); ?>" class="form-control" tabindex="20" placeholder="incluir clave lada, 10 dígitos, no parentesis, no guiones, no espacios "/>
                    <?php echo form_error('empresa1telefono'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="empresa2" class="col-sm-2 control-label">Empresa 2:</label>
                <div class="col-sm-10">
                    <input type="text" id="empresa2" name="empresa2" value="<?php echo  set_value('empresa2'); ?>" class="form-control" tabindex="21" />
                    <?php echo form_error('empresa2'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="empresa2telefono" class="col-sm-2 control-label">Teléfono Empresa 2:</label>
                <div class="col-sm-10">
                    <input type="text" id="empresa2telefono" name="empresa2telefono" value="<?php echo  set_value('empresa2telefono'); ?>" class="form-control" tabindex="22" placeholder="incluir clave lada, 10 dígitos, no parentesis, no guiones, no espacios "/>
                    <?php echo form_error('empresa2telefono'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="empresa3" class="col-sm-2 control-label">Empresa 3:</label>
                <div class="col-sm-10">
                    <input type="text" id="empresa3" name="empresa3" value="<?php echo  set_value('empresa3'); ?>" class="form-control" tabindex="23" />
                    <?php echo form_error('empresa3'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="empresa3telefono" class="col-sm-2 control-label">Teléfono Empresa 3:</label>
                <div class="col-sm-10">
                    <input type="text" id="empresa3telefono" name="empresa3telefono" value="<?php echo  set_value('empresa3telefono'); ?>" class="form-control" tabindex="24" placeholder="incluir clave lada, 10 dígitos, no parentesis, no guiones, no espacios "/>
                    <?php echo form_error('empresa3telefono'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="empresa4" class="col-sm-2 control-label">Empresa 4:</label>
                <div class="col-sm-10">
                    <input type="text" id="empresa4" name="empresa4" value="<?php echo  set_value('empresa4'); ?>" class="form-control" tabindex="25" />
                    <?php echo form_error('empresa4'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="empresa4telefono" class="col-sm-2 control-label">Teléfono Empresa 4:</label>
                <div class="col-sm-10">
                    <input type="text" id="empresa4telefono" name="empresa4telefono" value="<?php echo  set_value('empresa4telefono'); ?>" class="form-control" tabindex="26" placeholder="incluir clave lada, 10 dígitos, no parentesis, no guiones, no espacios "/>
                    <?php echo form_error('empresa4telefono'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="empresa5" class="col-sm-2 control-label">Empresa 5:</label>
                <div class="col-sm-10">
                    <input type="text" id="empresa5" name="empresa5" value="<?php echo  set_value('empresa5'); ?>" class="form-control" tabindex="27" />
                    <?php echo form_error('empresa5'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="empresa5telefono" class="col-sm-2 control-label">Teléfono Empresa 5:</label>
                <div class="col-sm-10">
                    <input type="text" id="empresa5telefono" name="empresa5telefono" value="<?php echo  set_value('empresa5telefono'); ?>" class="form-control" tabindex="28" placeholder="incluir clave lada, 10 dígitos, no parentesis, no guiones, no espacios " />
                    <?php echo form_error('empresa5telefono'); ?>
                </div>
            </div>
            <!--//Datos referencias  -->

            <div class="form-group">
                <button  type="submit" id="btnProspecto" class="col-sm-offset-2 btn btn-warning " tabindex="29">
                    <i class="fa fa-folder-open-o"></i>
                    Registar Prospecto
                </button>
            </div>

        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos el sript que se usa para los prospectos -->
<script src="<?php echo base_url();?>static/js/prospectos.js"></script>