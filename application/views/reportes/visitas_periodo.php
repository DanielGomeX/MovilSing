<article class="row">

    <div class="col-md-12">

        <h2>Visitas del Periodo</h2>
        <!-- Guardamos en una vaiable de sesion la url que manda llamar a las partidas, para que
        el link regresar nos mande nuevamente a esta pantalla -->
        <?php $_SESSION['regresar']=$this->uri->uri_string(); ?>

        <div class="table-responsive">
            <?php if (isset($visitas)):
            ?>
            <table id="tbVisitasPeriodo" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>
                            Cliente
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Fecha Visita
                        </th>
                        <th>
                            Comentario
                        </th>
                        <th>
                            Semana
                        </th>
                        <th>
                            Dia
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($visitas as $visita):
                    ?>
                    <tr>
                        <td>
                            <?php echo $visita['Custid']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($visita['Nombre']); ?>
                        </td>
                        <td>
                            <?php echo $visita['Fecha']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($visita['Comentario']); ?>
                        </td>
                        <td>
                            <?php echo $visita['Semana']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($visita['Dia']); ?>
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