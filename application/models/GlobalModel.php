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


    /**
     * Permite obtener el email que tiene registrado al supervisor del usuario
     * @param  [string] $usuario [description]
     * @return email
     */
    public function obtenerEmailSupervisor($usuario){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerEmailSupervisor(?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosDevolucion" ya es un array
        $this->params=array($usuario);

        return $this->get_row();
    }


    /**
     * Permite obtener el email que tiene registrado el usuario
     * @param  [string] $usuario [description]
     * @return email
     */
    public function obtenerEmailUsuario($usuario){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerEmailUsuario(?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosDevolucion" ya es un array
        $this->params=array($usuario);

        return $this->get_row();
    }


    /**
     * Obtiene los destinatarios de correo del personal administrativo que sebe estar enterado de que se ha enviado una devolución
     * @param  [string] $proceso [nombre del procesos del cual se obtendran los registros de los email de los destinatarios a notificar]
     * @param  [string] $status  [nombre del status del cual se filtraran los registros de los email de los destinatarios a notificar]
     * @return [arreglo con los emails de los destinatarios]
     */
    public function obtenerEmailAdministrativosNotificacionDevolucion($proceso, $status){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_AnomaliasPostVenta_NotificacionDevolucionAdministrativos(?,?)}";

        # asignamos los valores de los parametros, en este caso la variable "$datosDevolucion" ya es un array
        $this->params=array($proceso,$status);

        return $this->get_rows();
    }

}
