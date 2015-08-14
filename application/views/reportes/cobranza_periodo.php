<article class="contenido">
    <h3>Cobranza del Periodo</h3>
    <!-- Guardamos en una vaiable de sesion la url que manda llamar a las partidas, para que
    el link regresar nos mande nuevamente a esta pantalla -->
    <?php $_SESSION['regresar']=$this->uri->uri_string(); ?>
    <div class="tabla-responsive">
        <?php if (isset($cobranza)): ?>
        <table id="tbCobranzaPeriodo" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>
                        Cliente
                    </th>
                    <th>
                        Nombre
                    </th>
                    <th>
                        Fecha
                    </th>
                    <th>
                        Forma Pago
                    </th>
                    <th>
                        Recibo
                    </th>
                    <th>
                        Importe
                    </th>
                    <th>
                        Comentario
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cobranza as $registro): ?>
                <tr>
                    <td>
                        <?php echo $registro['CustId']; ?>
                    </td>
                    <td>
                        <?php echo utf8_encode($registro['name']); ?>
                    </td>
                    <td>
                        <?php echo $registro['Fecha']; ?>
                    </td>
                    <td>
                        <?php echo $registro['Tipo']; ?>
                    </td>
                    <td>
                        <?php echo $registro['NumRecibo']; ?>
                    </td>
                    <td>
                        <?php echo $registro['TotalPago']; ?>
                    </td>
                    <td>
                        <?php echo utf8_encode($registro['Comentarios']); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
</article>