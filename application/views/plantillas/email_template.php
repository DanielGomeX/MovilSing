<!DOCTYPE>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
<title>HTML Invoice Template</title>
<style type="text/css">
<!--
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

#logo {
  float:left;
  margin:0;
}

#address {
  height: 60px;
  width:400px;
  margin-left: 200px;
  top: 97px;
  
}

table {
  width:100%;
}

td {
  padding: 5px;
}

tr.odd {
  background:#e1ffe1;
}
#apDiv1 {
  position: absolute;
  width: 355px;
  height: 105px;
  z-index: 1;
  left: 800px;
  top: 97px;
}
#content {
  /*height: 60px;
  width:400px;
  margin-left: 200px;*/
  /* [disabled]top: 300px; */
  margin-top: 10em;
}

-->
</style>
</head>
<body>
<div id="page">
  <div id="logo">
    <a href="http://www.hecort.com/"><img src="http://www.hecort.com/logo1.JPG"></a>
  </div><!--end logo-->
  
  <div id="address">

    <p><strong>HERRAMIENTAS HECORT S.A DE.C.V</strong><br>
      <strong>Reporte de Devolucion. </strong><br>
    </p>
    <div id="apDiv1" style="right: 20px; top: 80px">
      <table width="50" border="0">
        <tr>
          <td width="27%"><strong>REGISTRO#</strong></td>
          <td width="73%" style="color: #F00; font-weight: bold;">[FOLIO]</td>
        </tr>
        <tr>
          <td><strong>Factura#</strong></td>
          <td style="color: #00C; font-weight: bold;">[INVCNBR]</td>
        </tr>
        <tr>
          <td><strong>Fecha:</strong></td>
          <td><strong>[FECHA]</strong></td>
        </tr>
        <tr>
          <td><strong>Zona:</strong></td>
          <td>[ZONA]</td>
        </tr>
        <tr>
          <td><strong>Vendedor:</strong></td>
          <td>[VENDEDOR]</td>
        </tr>
      </table>
      <br>
      <br>
    </div>
    
  </div>
  <!--end address-->

  <div id="content">
    <table width="77%" border="0">
      <tr>
        <td colspan="2" bgcolor="#666666"><strong>CLIENTE</strong></td>
      </tr>
      <tr>
        <td width="11%"><strong>CustID</strong>:</td>
        <td width="89%">[CUSTID]</td>
      </tr>
      <tr>
        <td><strong>Cliente:</strong></td>
        <td>[CLIENTE]</td>
      </tr>
      <tr>
        <td><strong>Direccion:</strong></td>
        <td>[DIRECCION]</td>
      </tr>
      <tr>
        <td><strong>Colonia:</strong></td>
        <td>[COLONIA]</td>
      </tr>
      <tr>
        <td><strong>Ciudad:</strong></td>
        <td>[CIUDAD]</td>
      </tr>
      <tr>
        <td><strong>Estado:</strong></td>
        <td>[ESTADO]</td>
      </tr>
      <tr>
        <td><strong>CP:</strong></td>
        <td>[CP]</td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#333333" style="color: #FFF; font-weight: bold;">DETALLE</td>
      </tr>
    </table>
    <hr>
     [TABLA]<br>
    <hr>
    <p>
      [OBSERVACIONES]</p>

    <hr><center>
      <table width="50" border="0">
        <tr>
          <td><small>Este mensaje es para  uso exclusivo del destinatario y puede contener informaci&oacute;n  confidencial o privilegiada. Si usted no es el destinatario del mismo, cualquier uso, copia, divulgaci&oacute;n, difusi&oacute;n o distribuci&oacute;n est&aacute; estrictamente prohibida.
          
          </small></td>
        </tr>
        <tr>
          <td><small>This communication is for the exclusive use of 
        the addressee and may contain proprietary, confidential or privileged 
        information. If you are not the intended recipient any use, copying, 
        disclosure, dissemination or distribution is strictly prohibited. </small></td>
        </tr>
      </table>
      <p><small><br>
        © HERRAMIENTAS HECORT S.A. DE C.V. Derechos Reservados 2014
      </small></p>
    </center>
    <p></p>
  </div><!--end content-->
</div><!--end page-->


</body></html>