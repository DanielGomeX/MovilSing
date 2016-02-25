<!DOCTYPE>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
<title>Notificacion</title>
<style type="text/css">

body {
  font-family:Tahoma;
}

img {
  border:0;
}

#page {
  width:800px;
  /*margin-top: 200px;*/
  margin:0 auto;
  padding:15px;
}

#address {
  height: 60px;
  width:400px;
  margin-left: 200px;
  top: 97px;
}

table {
  width:80%;
}

td {
  padding: 5px;
}

tr.odd {
  background:#e1ffe1;
}

#footer {
  margin-top: 10px;
}

</style>
</head>
<body>
  <div id="page">

    <div id="address">

      <p>
        <h2>HERRAMIENTAS HECORT S.A DE.C.V</h2>
      </p>
      <p>
        <h3>Reporte de Anomalia. </h3>
      </p>

        <table>
          <tr>
            <td><strong>Folio</strong></td>
            <td style="color: #F00; font-weight: bold;"><?php echo $this->session->devolucion ?></td>
          </tr>
          <tr>
            <td>Factura</td>
            <td style="color: #00C; font-weight: bold;"><?php echo $_SESSION['factura'] ?></td>
          </tr>
          <tr>
            <td>Fecha:</td>
            <td><?php echo date("d/m/y") ?></td>
          </tr>
          <tr>
            <td>Cliente:</td>
            <td><?php echo $custid ?></td>
          </tr>
          <tr>
            <td>Nombre:</td>
            <td><?php echo $cliente ?></td>
          </tr>
          <tr>
            <td>Zona:</td>
            <td><?php echo $this->session->usuario ?></td>
          </tr>

          <tr>
            <td>Importe antes de impuetos:</td>
            <td><?php echo '$'.number_format($subTotal,2)  ?></td>
          </tr>

          <tr>
            <td>Motivo:</td>
            <td><?php echo $observaciones ?></td>
          </tr>

        </table>
        <br>
        <div>
         Para más detalles consulte el folio en la estación correspondiente dentro del sistema SING Desktop
       </div>

   </div>
   <!--end address-->

   <div id="footer">
    <hr>
    <table >
      <tr>
        <td>
         <center>
          <small>
            Este mensaje es para uso exclusivo del destinatario y puede contener informaci&oacute;n  confidencial o privilegiada. 
            Si usted no es el destinatario del mismo, cualquier uso, copia, divulgaci&oacute;n, difusi&oacute;n o distribuci&oacute;n est&aacute; 
            strictamente prohibida.
          </small>
        </center>
      </td>
    </tr>
    <tr>
      <td>
        <center>
          <p><small><br>
            © HERRAMIENTAS HECORT S.A. DE C.V. Derechos Reservados
          </small></p>
        </center>
      </td>
    </tr>
  </table>
  <p></p>
</div><!--end footer-->

</div><!--end page-->


</body>
</html>