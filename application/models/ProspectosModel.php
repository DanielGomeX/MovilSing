<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#línea requerida para poder heredar de la clase padre
require_once APPPATH.'models/AbstractModel.php';

class ProspectosModel extends AbstractModel {

    function __construct() {
        parent::__construct();
    }

    /**
     * Busca en la BD aquellos prospectos asociados al usuario que aun no han sido liberados, es decir,
     * que aun no tienen número de cliente asignado.
     * @param  [type] $zona [usuario del cual se obtendran los prospectos asociados]
     * @return [arreglo]
     */
    public function prospectos($zona){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ProspectosPorUsuario(?)}";

        # asignamos los valores de los parametros
        $this->params = array($zona);

        return $this->get_rows();
    }

    /**
     * Busca en la base de datos información referente al prospecto seleccionado
     * @param  [string] $idProspecto
     * @return [arreglo]              [un solo registro con la información encontrada]
     */
    public function obtenerDatosProspecto($idProspecto) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerDatosProspecto(?)}";

        # asignamos los valores de los parametros
        $this->params = array($idProspecto);

        return $this->get_rows();
    }

    /**
     * Permite obtener los asentamientos (colonias) que pertenecen al código postal en cuestion
     * @param [string] $codigoPostal
     */
    public function ObtenerAsentamientosSepomexPorCodigo($codigoPostal){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerAsentamientosPorCodigoPostal(?)}";

        # asignamos los valores de los parametros
        $this->params = array($codigoPostal);

        return $this->get_rows();
    }

    /**
     *  Permite registrar en la BD un nuevo prospecto con sus información general
     */
    public function registrarProspecto($datosProspecto){
        # mandamos llamar al stored procedure
		$this->query = "{call MovilSing_AgregarProspectoCliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosProspecto" ya es un array
        $this->params=$datosProspecto;

        $this->execute_insert();
    }


    /**
     *  Permite registrar en la BD un nuevo prospecto con sus información general
     */
    public function actualizarProspecto($datosProspecto){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ActualizarProspectoCliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosProspecto" ya es un array
        $this->params=$datosProspecto;

        //print_r($datosProspecto);
        $this->execute_update();
    }

    /**
     *  Permite eliminar un registro en la BD de un prospecto
     */
    public function eliminarProspecto($idProspecto){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_EliminarProspectoCliente(?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosProspecto" ya es un array
        $this->params=array($idProspecto);

        $this->execute_delete();
    }


    /**
     *  Permite cambiar el staus del prospecto y actualizar o insertar comentario
     */
    public function actualizarStatusProspecto($idProspecto, $status, $usuario, $comentario){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ActualizarStatusProspecto(?,?,?,?)}";
        # asignamos los valores de los parametros, en este caso la variable "$datosProspecto" ya es un array
        $this->params=array($idProspecto,
                            $status,
                            $usuario,
                            $comentario);

        return $this->execute_update();
    }

}
