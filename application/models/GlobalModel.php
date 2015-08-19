<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#línea requerida para poder heredar de la clase padre
require_once APPPATH.'models/AbstractModel.php';

class GlobalModel extends AbstractModel {

    function __construct() {
        parent::__construct();
    }


    /**
     * Permite la salida del usuario en la aplicación registrandolo como desconectado en la BD
     * @param  [string] $usuario [identificador del usuario del cual se desconectará de la aplicacion en la BD]
     * @return [bool]
     */
    public function logout($usuario) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_LogOut(?)}";

        #asignamos los valores de los parametros
        $this->params = array($usuario);

        $this->execute_update();
    }


    /**
     * Permite la entrada del usuario a la aplicación registrandolo como conectado en la BD
     * @param  [type] $usuario  [identificador del usuario en la base de datos]
     * @param  [type] $password [contraseña de auntenticación del usuario que tiene registrada en la base de datos]
     * @return [array]          [arreglo de un registro con los campos codigo y mensaje ]
     */
    public function login($usuario, $password) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_LogIn (?,?)}";

        # asignamos los valores de los parametros
        $this->params = array($usuario, $password);

        return $this->get_rows();
    }



}
