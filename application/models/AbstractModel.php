<?php


class AbstractModel extends CI_Model {
    ############################### PROPIEDADES ABSTRACTAS ################################

    //private static $db_host = "srv-datos2\pruebas";
    //private static $db_user = "desarrollo";
    //private static $db_pass = "desarrollo";
    private $db_host="";
    private $db_user = "";
    private $db_pass="";
    protected $db_name = "";
    protected $query; #se usa para asignar una consulta o el nombre del stored procedure a ejecutar
    protected $params = array();
    protected $rows = array();
    private $conn;


    function __construct() {
        parent::__construct();
    }


    ############################### METODOS PRIVADOS ################################

    # Conectar a la base de datos
    private function open_connection() {
        $parametrosConexion = array(
            "UID" => $this->config->item('db_user'), //self::$db_user,
            "PWD" => $this->config->item('db_pass'), //self::$db_pass,
            "Database" => $this->config->item('db_name') //$this->db_name
            );

        # Establecemos la conexión con el servidor de base de datos
        //$this->conn = sqlsrv_connect(self::$db_host, $parametrosConexion);
        $this->conn = sqlsrv_connect($this->config->item('db_host'), $parametrosConexion);


        if( $this->conn )
        {
            return $this->conn;
        }
        else
        {
          echo "Error al establecer comunicación con el servidor de base de datos." ;
          //die( print_r( sqlsrv_errors(), true));
        }
    }

    # Desconectar la base de datos
    private function close_connection() {
        sqlsrv_close($this->conn);
    }

    ############################### METODOS ABSTRACTOS ################################

    /**
     * Ejecuta un query simple del tipo INSERT
     * @return [null] [verdadero se se ejecuto correctamente la consulta, caso contrario falso]
     */
    protected function execute_insert() {
        #
        $result = sqlsrv_query($this->open_connection(), $this->query, $this->params);

        if ($result) {
            return true;
        } else {
            return false;
        }

        # Free statement and connection resources
        sqlsrv_free_stmt($result);
        $this->close_connection();
    }

    /**
     * Ejecutar un query simple del tipo UPDATE
     * @return [null] [verdadero se se ejecuto correctamente la consulta, caso contrario falso]
     */
    protected function execute_update() {
        #
        $result = sqlsrv_query($this->open_connection(), $this->query, $this->params);

        if ($result) {
            return true;
        } else {
            return false;
        }

        # Free statement and connection resources
        sqlsrv_free_stmt($result);
        $this->close_connection();
    }

    /**
     * Ejecutar un query simple del tipo UPDATE
     * @return [null] [verdadero se se ejecuto correctamente la consulta, caso contrario falso]
     */
    protected function execute_delete() {
        #
        $result = sqlsrv_query($this->open_connection(), $this->query, $this->params);

        if ($result) {
            return true;
        } else {
            return false;
        }

        # Free statement and connection resources
        sqlsrv_free_stmt($result);
        $this->close_connection();
    }

    # Traer resultados de una consulta en un Array (un solo registro con uno o varios campos)
    protected function get_row() {
        #
        $result = sqlsrv_query($this->open_connection(), $this->query, $this->params);

        if ($result) {
            while ($this->rows[] = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC));
        } else {
            die(print_r(sqlsrv_errors(), true));
        }

        # Free statement and connection resources
        sqlsrv_free_stmt($result);
        $this->close_connection();

        #
        array_pop($this->rows);

        return $this->rows;
    }

    # Traer resultados de una consulta en un Array (varios registros con uno o varios campos)
    protected function get_rows() {

        $result = array();

        // Get return value
        $sentencia = sqlsrv_query($this->open_connection(), $this->query, $this->params);

        //
        do {
           while ($row = sqlsrv_fetch_array($sentencia, SQLSRV_FETCH_ASSOC)) {
               // Loop through each result set and add to result array
               $result[] = $row;
           }
        } while (sqlsrv_next_result($sentencia));

        # Free statement and connection resources
        sqlsrv_free_stmt($sentencia);
        $this->close_connection();

        return $result;
    }


    /*
    protected function get_multiple_rows() {

        $result = array();

        #
        $sentencia = sqlsrv_query($this->open_connection(), $this->query, $this->params);

        // Get return value
        do {
           while ($row = sqlsrv_fetch_array($sentencia, SQLSRV_FETCH_ASSOC)) {
               // Loop through each result set and add to result array
               $result[] = $row;
           }
        } while (sqlsrv_next_result($sentencia));

        # Free statement and connection resources
        sqlsrv_free_stmt($sentencia);
        $this->close_connection();

        return $result;
    }
    */


}
