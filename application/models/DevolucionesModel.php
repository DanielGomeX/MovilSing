<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#línea requerida para poder heredar de la clase padre
require_once APPPATH.'models/AbstractModel.php';

class DevolucionesModel extends AbstractModel {

    function __construct() {
        parent::__construct();
    }

    /**
     * Busca en la BD aquellas devoluciones pendientes capturadas por el usuario
     * @param  [string] $zona [usuario del cual se obtendran los registros asociados de devoluciones]
     * @return [arreglo]
     */
    public function obtenerDevolucionesPendientes($zona){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVentaPendientes(?)}";

        # asignamos los valores de los parametros
        $this->params = array($zona);

        return $this->get_rows();
    }

    /**
     * Elimina los registros relacionados a una devolucion con status de captura
     * @param [int] $idDevolucion [Número de devolución  cons status de Captura a eliminar]
     */
    public function EliminarDevolucionCaptura($idDevolucion){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_EliminarDevolucionCaptura(?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosProspecto" ya es un array
        $this->params=array($idDevolucion);

        return $this->execute_delete();
    }

    /**
     * Busca en la base de datos, la factura a la que ue se desa realizar una devolucion
     * @param  [string] $factura
     * @return [arreglo con un solo registro con la información encontrada]
     */
    public function obtenerDatosFactura($factura, $usuario) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVentaDatosFactura(?,?)}";

        # asignamos los valores de los parametros
        $this->params = array($factura,
                              $usuario);

        return $this->get_rows();
    }

    /**
     * Busca en la base de datos de la factura (BD Herramientas) que se desea capturar
     * @param  [string] $factura
     * @return [arreglo con un solo registro con la información encontrada]]
     */
    public function obtenerDatosFacturaSL($factura) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVentaDatosFacturaSL(?)}";

        # asignamos los valores de los parametros
        $this->params = array($factura);

        return $this->get_rows();
    }


    public function ObtenerFacturasCliente($cliente, $usuario) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_ObtenerFacturasCliente(?,?)}";

        # asignamos los valores de los parametros
        $this->params = array($cliente, $usuario);

        return $this->get_rows();
    }


    /**
     * Guarda en la base de datos un nuevo registros referente a una nueva devolución
     * @param  [arreglo]    arreglo con los datos necesario para el nuevo registro de devolución
     * @return [arreglo con un solo registro con el número consecutivo de la devolución]
     */
    public function registrarDevolucion($datosDevolucion){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_RegistrarDevolucionVendedor(?,?,?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosDevolucion" ya es un array
        $this->params=$datosDevolucion;

        return $this->get_row();
    }

    /**
     * Busca en la base de datos, los datos generales (de encabezado) de la devolución
     * @param  [string] $idAnomalia
     * @return arreglo de registros
     */
    public function obtenerDatosDevolucion($idAnomalia) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_ObtenerDatosDevolucion(?)}";

        # asignamos los valores de los parametros
        $this->params = array($idAnomalia);

        return $this->get_rows();
    }

    /**
     * Obtiene los productos asociados a la factura
     * @param  [string] $factura [Número de factura de la cual se desean obtener los productos asociados]
     * @return [arreglo de varios registros]
     */
    public function obtenerDatosProductosFactura($factura) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPosVenta_DetalleProductosFactura(?)}";

        # asignamos los valores de los parametros
        $this->params = array($factura);

        return $this->get_rows();
    }

    /**
     * Permite obtener los datos generales del producto que ahora será devuelto de la factura en cuestión
     * @param  [string] $factura  [número de factura en donde se buscara el producto]
     * @param  [string] $articulo [clave del producto a buscar]
     * @return [arreglo con un solo registro]
     */
    public function obtenerDatosProductoParaDevolucion($factura, $articulo) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_ObtenerDatosArticuloDevolucion(?,?)}";

        # asignamos los valores de los parametros
        $this->params = array($factura,
                              $articulo);

        return $this->get_rows();
    }

    /**
     * Permite obtener el producto que se dió en especie (en caso de aplicar) del producto que ahora será devuelto
     * @param  [string] $factura  [factura en la cual se desea buscar el producto]
     * @param  [string] $articulo [clave del articulo del cual se busca si cuenta con especie ]
     */
    public function obtenerDatosProductoEspecieParaDevolucion($factura, $articulo) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_ObtenerDatosArticulosDevolucionEspecie(?,?)}";

        # asignamos los valores de los parametros
        $this->params = array($factura,
                              $articulo);

        return $this->get_rows();
    }

    /**
     * Permite registrar el producto a devolver
     * @param  [arreglo] $datosProductoDevolucion [parametros recibidos: IdAnomalia, InvcNbr, InvtID, Cantidad, IdCausa, Observaciones]
     * @return [boolean]
     */
    public function registrarProductoParaDevolucion($datosProductoDevolucion){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_AgregaProductoDevolucion(?,?,?,?,?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosDevolucion" ya es un array
        $this->params=$datosProductoDevolucion;

        return $this->execute_insert();
    }


    /**
     * Permite agregar todos aquellos productos de la factura que aun no han sido agregados para devolución
     * @param  [arreglo] $datosProductoDevolucion [parametros recibidos: IdAnomalia, InvcNbr,  motivo]
     * @return [boolean]
     */
    public function registrarProductosParaDevolucion($datosProductoDevolucion){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_AgregarProductosDevolucion(?,?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosDevolucion" ya es un array
        $this->params=$datosProductoDevolucion;

        return $this->execute_insert();
    }


    /**
     * Cambia de status la solicitud y registrar historial
     * @param  [string] $devolucion
     * @param  [tring] $status        [nuevo status de la solicitud]
     * @param  [string] $observaciones
     * @param  [string] $usuario
     */
    public function cambiarStatus($devolucion, $status, $observaciones, $usuario){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_Anomalias_PostVenta_ActualizarStatus(?,?,?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosProspecto" ya es un array
        $this->params=array($devolucion,
                            $status,
                            $observaciones,
                            $usuario
                          );

        return $this->execute_update();
    }

    /**
     * Obtiene el detalle de productos registrados para devolucion
     * @param  [string] $idAnomalia
     * @return [arreglo con los registros de productos]
     */
    public function obtenerDetalleProductosDevolucion($idAnomalia) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_DetalleDevolucion(?)}";

        # asignamos los valores de los parametros
        $this->params = array($idAnomalia);

        return $this->get_rows();
    }

    /**
     * Elimina de una devolución la partida especificada
     * @param  [NUMERIC(9)] $idDevolucion
     * @param  [NUMERIC(9)] $idDetalleDevolucion
     */
    public function eliminarProductoParaDevolucion($idDevolucion, $idDetalleDevolucion){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_EliminarArticulo(?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosProspecto" ya es un array
        $this->params=array($idDevolucion,
                            $idDetalleDevolucion
                          );

        $this->execute_delete();
    }

    /**
     * obtiene los datos referentes al envio de guias
     * @param  [NUMERIC(9] $idDevolucion
     */
    public function obtenerDatosEnvioAanomalia($idDevolucion) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerDatosEnvioAnomalia(?)}";

        # asignamos los valores de los parametros
        $this->params = array($idDevolucion);

        return $this->get_rows();
    }

    /**
     * Guarda en la base de datos un nuevo registros referente al registro de solicitud de guia así como el PDF correspondiente de la guia
     * @param  [arreglo]    arreglo con los datos necesario para el nuevo registro de devolución
     * @return [arreglo con un solo registro con el número consecutivo de la devolución]
     */
    public function registrarGuiaDevolucion($parametrosGuia){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVentaCrearGuiasPdf(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosDevolucion" ya es un array
        $this->params=$parametrosGuia;

        //return $this->get_row();
        return $this->execute_insert();
    }

    /**
     * Obtiene los paquetes registrados con guia para envio
     * @param  [numeric(9)] $idDevolucion
     */
    public function obtenerPaquetesParaEnvio($idDevolucion) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostventa_ListaGuias(?)}";

        # asignamos los valores de los parametros
        $this->params = array($idDevolucion);

        return $this->get_rows();
    }

    /**
     * Registra en la base de datos el paquete para devolucion
     * @param  [arreglo] $parametrosPaquete
     */
    public function registrarPaquete($parametrosPaquete){
        # mandamos llamar al stored procedure
        //$this->query = "{call MovilSing_AnomaliaspostVenta_GuiasDevolucion_OP(?,?,?,?,?,?,?)}";
        $this->query = "{call MovilSing_AnomaliasPostVenta_RegistrarPaqueteDevolucion(?,?,?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosDevolucion" ya es un array
        $this->params=$parametrosPaquete;

        return $this->execute_insert();
    }

    /**
     * Elimina de la base de datos el paquete registrado previamente para devolucion
     * @param  [arreglo] $parametrosPaquete
     */
    public function eliminarPaquete($parametrosPaquete){
        # mandamos llamar al stored procedure
        //$this->query = "{call MovilSing_AnomaliaspostVenta_GuiasDevolucion_OP(?,?,?,?,?,?,?)}";
        $this->query = "{call MovilSing_AnomaliasPostVenta_EliminarPaqueteDevolucion(?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosDevolucion" ya es un array
        $this->params=$parametrosPaquete;

        return $this->execute_delete();
    }

    /**
     * Finaliza el registro del envio de una devolución
     * @param  [arreglo] $parametrosEnvio [description]
     */
    public function registrarEnvio($parametrosEnvio){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_RegistrarEnvio (?,?,?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosDevolucion" ya es un array
        $this->params=$parametrosEnvio;

        //return $this->get_row();
        return $this->execute_update();
    }

    public function obtenerCausasNotasCredito() {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ListaCausasNotasCredito}";

        # asignamos los valores de los parametros
        //$this->params = array($factura);

        return $this->get_rows();
    }




}
