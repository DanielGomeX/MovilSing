<article class="row">

    <div class="col-md-12">

        <h3>Comentarios asociados al pedido</h3>

        <a href="<?php echo base_url(); echo $this->session->regresar; ?>">
            <i class="fa fa-arrow-circle-left"></i>
            Regresar
        </a>

        <div class="table-responsive">
            <?php if (isset($comentarios)):
            ?>
            <table id="tbComentarios" class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>
                            Fecha
                        </th>
                        <th>
                            Pedido
                        </th>
                        <th>
                            Estacion
                        </th>
                        <th>
                            Usuario
                        </th>
                        <th>
                            Comentario
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comentarios as $comentario):
                    ?>
                    <tr>
                        <td>
                            <?php echo $comentario['Fecha']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($comentario['Pedido']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($comentario['Estacion']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($comentario['Usuario']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($comentario['Comentario']); ?>
                        </td>
                    </tr>
                    <?php endforeach;
                    ?>
                </tbody>
            </table>
            <?php endif;
            ?>
        </div>

    </div><!-- //columna -->

</article><!-- //renglon -->
