<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


#línea requerida para poder heredar de la clase padre
require_once APPPATH.'models/AbstractModel.php';

class PartidasModel extends AbstractModel {

    function __construct() {
        parent::__construct();
    }

    public function obtenerPartidasPedido($pedido) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_PartidasPedido(?)}";

        #asignamos los valoes de los parametros
        $this->params = array($pedido);

        return $this->get_rows();
    }


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


    public function eliminarPartida($id) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_EliminarPartida(?)}";

        #asignamos los valores de los parametros
        $this->params = array($id);

        $this->execute_delete();
    }

    public function obtenerProductosPorDescripcion($cliente, $contiene) {
        //Revisar este SP ya que hay que obtener los productos sin importar el almacen

        # mandamos llamar al stored procedure
        $this->query = "{call MovilSING_ObtenerProductosPorDescripcion(?,?)}";

        #asignamos los valoes de los parametros
        $this->params = array($cliente,
                            $contiene);

        return $this->get_rows();
    }


    public function aplicarDescuentosPromociones($pedido){
        $this->query="{call MovilSing_ProcesadorDescuentosPromociones(?)}" ;

        #asignamos los valoes de los parametros
        $this->params = array($pedido);

        return $this->get_rows();
    }


}

/* End of file PartidasModel.php */
/* Location: ./application/models/PartidasModel.php */