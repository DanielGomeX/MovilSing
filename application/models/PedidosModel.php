<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


#línea requerida para poder heredar de la clase padre
require_once APPPATH.'models/AbstractModel.php';

class PedidosModel extends AbstractModel {

    function __construct() {
        parent::__construct();
    }

    /**
     * Permite registrar el encabezado de un nuevo pedido en la BD
     * @param  [string] $cliente [Número de cliente al cual se le registrará el pedido]
     * @return [array]           [Arreglo de un solo registro que contiene el número de pedido asignado por el sistema]
     */
    public function registrarPedido($cliente) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_RegistraEncabezadoPedidoMovil(?)}";
        #asignamos los valores de los parametros
        $this->params = array($cliente);
        return $this->get_rows();
      }

    /**
     * Determinar la acción final a realizar con el pedido, es deicr, establecerlo como: cancelado,retenido o autorizado
     * @param  [string] $pedido     [número de pedido seleccionado]
     * @param  [string] $accion     [acción a realizar: G:Guardar X:Cancelar]
     * @param  [string] $comentario
     * @param  [string] $usuario    [usuario que realiza la accion final del pedido]
     * @return [null]
     */
    public function finalizarPedido($pedido,$accion,$comentario,$usuario) {
       $this->query="{call MovilSing_GuardarCancelarPedido(?,?,?,?)}" ;

        #asignamos los valoes de los parametros
        $this->params = array($pedido,
                              $accion,
                              $comentario,
                              $usuario);

        return $this->execute_update();
    }

    public function aplicarCondicionesCrediticias($pedido) {
        $this->query="{call MovilSing_ProcesadorCondicionesCredito(?)}" ;

        #asignamos los valoes de los parametros
        $this->params = array($pedido);

        return $this->execute_update();
    }

    public function obtenerDatosResumenPedido($pedido) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerDatosResumenPedido(?)}";

        #asignamos los valoes de los parametros
        $this->params = array($pedido);

        return $this->get_row();
    }

    public function cambiarConsignacion($pedido, $consignacion) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_CambiarConsignacion(?,?)}";

        #asignamos los valores de los parametros
        $this->params = array($pedido, $consignacion);

        $this->execute_update();
    }

    public function obtenerConsignaciones($cliente) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerDireccionesConsignacion (?)}";

        #asignamos los valoes de los parametros
        $this->params = array($cliente);

        return $this->get_rows();
    }

    /**
     * Obtiene los pedidos del usuario que tienen status de liberado (L)
     * @param  [string] $usuario [usuario del cual se filtraran los pedidos liberados]
     * @return [Arreglo]         [información encontrada]
     */
    public function obtenerPedidosLiberados($usuario) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerPedidosLiberadosPeriodo (?)}";

        #asignamos los valoes de los parametros
        $this->params = array($usuario);

        return $this->get_rows();
    }

    /**
     * Obtiene los pedidos del usuario que tienen status de retenido (R)
     * @param  [string] $usuario [usuario del cual se filtraran los pedidos retenidos]
     * @return [Arreglo]         [información encontrada]
     */
    public function obtenerPedidosRetenidos($usuario) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerPedidosRetenidosPeriodo (?)}";

        #asignamos los valoes de los parametros
        $this->params = array($usuario);

        return $this->get_rows();
    }

    /**
     * Obtiene los pedidos del usuario con status de pendidnete (Captura:C, Aut. Parcialmente:AP, Retenido Parcialmente:RP, y Vendedor:V)
     * del periodo actual
     * @param  [string] $usuario [usuario del cual se filtraran los pedidos pendientes]
     * @return [Arreglo]         [información encontrada]
     */
    public function obtenerPedidosPendientes($usuario) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerPedidosPendientesPeriodo (?)}";

        #asignamos los valoes de los parametros
        $this->params = array($usuario);

        return $this->get_rows();
    }

    /**
     * Obtiene todos los pedidos del cliente registrados en el periodo actual
     * @param  string $cliente [número de cliente del cual se desean consultar los pedidos registrados]
     * @return null
     */
    public function obtenerPedidosCliente($cliente) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerPedidosCliente (?)}";

        #asignamos los valoes de los parametros
        $this->params = array($cliente);

        return $this->get_rows();
    }

    /**
     * Obtiene el número de pedidos y el número de cliente del cual se desea retomar el pedido, siempre
     * y cuando el pedido pertenezca al periodo actual (mes actual) y tenga un status válido para poder ser retomado
     * @param  [string] $pedido [número de pedido que se quiere retomar]
     * @return [array]          [arreglo de un solo registro con el numero de pedido y el número de cliente]
     */
    public function retomarPedidoCliente($pedido) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_RetomarPedidoCliente (?)}";

        #asignamos los valoes de los parametros
        $this->params = array($pedido);

        return $this->get_row();
    }

    /**
     * Permite obtener los comentarios asociados al pedido
     * @param  [string] $pedido [número de pedido del cual se requieren obtener los comentarios]
     * @return [arreglo]
     */
    public function obtenerComentariosPedido($pedido) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerComentariosPedido (?)}";

        #asignamos los valoes de los parametros
        $this->params = array($pedido);

        return $this->get_rows();
    }

}


/* End of file PedidosModel.php */
/* Location: ./application/models/PedidosModel.php */