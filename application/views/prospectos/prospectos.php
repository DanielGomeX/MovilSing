<article class="row">

    <div class="col-md-12">

        <h2>Mis Prospectos</h2>

        <div class="form-group">
            <a class="btn btn-warning" role="button" href="prospectoCaptura">
                <i class="fa fa-folder-open-o"></i>
                Registar Nuevo Prospecto
            </a>
        </div>

        <!-- TABLA DE PROSPECTOS -->
        <div class="table-responsive">
            <!-- Si la variable prospectos no esta vacia, mostramos la tabla con los datos -->
            <?php if (isset($prospectos)):
            ?>
            <table id="tbProspectos" class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            Fecha
                        </th>
                        <th>
                            Folio
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Giro
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Tipo Cliente
                        </th>
                        <th>
                            Colonia
                        </th>
                        <th>
                            Ciudad
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($prospectos as $prospecto):
                        ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url(); ?>prospectoDatos/<?php echo ($prospecto['IdProspecto']); ?>">Ver</a>
                        </td>
                        <td>
                            <?php echo $prospecto['FechaSolicitud']; ?>
                        </td>
                        <td>
                            <?php echo $prospecto['Folio']; ?>
                        </td>
                        <td>
                            <?php echo $prospecto['DescStatus']; ?>
                        </td>
                        <td>
                            <?php echo $prospecto['Giro']; ?>
                        </td>
                        <td>
                            <?php echo $prospecto['Nombre']; ?>
                        </td>
                        <td>
                            <?php echo $prospecto['TipoCliente']; ?>
                        </td>
                        <td>
                            <?php echo $prospecto['Colonia']; ?>
                        </td>
                        <td>
                            <?php echo $prospecto['Ciudad']; ?>
                        </td>

                        <td>
                            <!-- Si el status del prospecto es igual a captura (C),entonces, mostramos el link para poder eliminar dicho prospecto -->
                            <?php if ($prospecto['Status']=="C"):
                            ?>
                            <a href="<?php echo base_url(); ?>eliminarProspecto/<?php echo ($prospecto['IdProspecto']); ?>">
                                Eliminar
                            </a>
                            <?php endif;
                            ?>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <?php
            endif;
            ?>
        </div>


    </div><!-- //columna -->

</article><!-- //renglon -->
