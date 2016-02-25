<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#línea requerida para poder heredar de la clase padre
require_once APPPATH.'models/AbstractModel.php';

class PartidasModel extends AbstractModel {

    function __construct() {
        parent::__construct();
    }

    /**
     * Obtiene las partidas registradas al pedido
     * @param  [string] $pedido
     * @return [arreglo]
     */
    public function obtenerPartidasPedido($pedido) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_PartidasPedido(?)}";

        #asignamos los valoes de los parametros
        $this->params = array($pedido);

        return $this->get_rows();
    }

    /**
     * Registra la partidad siempre y cuando pase todas las validaciones
     * @param  [string] $pedido
     * @param  [string] $clave
     * @param  [real] $cantidad
     * @return [arreglo]
     */
    public function registrarPartidaPedido($pedido, $clave, $cantidad) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_RegistraPartidaPedido(?,?,?)}";

        #asignamos los valores de los parametros
        $this->params = array(
            $pedido,
            $clave,
            $cantidad
        );

        return $this->get_rows();
    }

    /**
     * Elimina la partidad de un pedido
     * @param  [int] $id
     * @return [int]
     */
    public function eliminarPartida($id) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_EliminarPartida(?)}";

        #asignamos los valores de los parametros
        $this->params = array($id);

        $this->execute_delete();
    }


    /**
     * Permite obtener el listado de aquellos productos que coincidan con el criterio de busqueda enviado
     * @param  [string] $contiene [valor por el cual se desea filtrar la busqueda]
     * @return [arreglo]
     */
    public function obtenerProductosPorFiltro($contiene) {

        # mandamos llamar al stored procedure
        $this->query = "{call MovilSING_ObtenerProductosPorFiltro(?)}";

        #asignamos los valoes de los parametros
        $this->params = array($contiene);

        return $this->get_rows();
    }


    /**
     * Procedimiento que aplica los descuentos y promociones vigentes segun corresponda a cada una de las partidas del pedido
     * @param  [string] $pedido
     * @return [null]
     */
    public function aplicarDescuentosPromociones($pedido){
        $this->query="{call MovilSing_ProcesadorDescuentosPromociones(?)}" ;

        #asignamos los valoes de los parametros
        $this->params = array($pedido);

        return $this->get_rows();
    }


}

/* End of file PartidasModel.php */
/* Location: ./application/models/PartidasModel.php */