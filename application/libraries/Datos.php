<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datos {

	############################### PROPIEDADES ABSTRACTAS ################################

    private static $db_host = "srv-datos2\pruebas";
    private static $db_user = "desarrollo";
    private static $db_pass = "desarrollo";
    protected $db_name = "ApHecort";
    protected $query;
    protected $params = array();
    protected $rows = array();
    private $conn;


    ############################### PROPIEDADES MODELO ################################
    public $Cliente;
    public $Nombre;   
    public $Error;
    public $Mensaje = '';


    ############################### ABSTRACTOS ################################
    # Conectar a la base de datos
    private function open_connection() {
        $parametrosConexion = array(
            "UID" => self::$db_user,
            "PWD" => self::$db_pass,
            "Database" => $this->db_name);

        $this->conn = sqlsrv_connect(self::$db_host, $parametrosConexion);

        return $this->conn;

        /*
          if( $this->conn )
          {
          echo "Connected";
          }
          else
          {
          echo "Error";
          die( print_r( sqlsrv_errors(), true));
          }
         */
    }

    # Desconectar la base de datos
    private function close_connection() {
        sqlsrv_close($this->conn);
    }

    # Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
    protected function execute_single_query() {
        #
        $result = sqlsrv_query($this->open_connection(), $this->query);

        if ($result) {
            return true;
        } else {
            return false;
        }

        # Free statement and connection resources
        sqlsrv_free_stmt($result);
        $this->close_connection();
    }

    # Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
    protected function execute_single_query_sp() {
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

    # Traer resultados de una consulta en un Array
    protected function get_results_from_query() {
        #
        $result = sqlsrv_query($this->open_connection(), $this->query);

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

    # Traer resultados de una consulta en un Array
    protected function get_results_from_sp() {
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


    protected function get_results_from_single_sp() {
        #
        $result = sqlsrv_query($this->open_connection(), $this->query, $this->params);

        if ($result) {
            //echo "Row successfully inserted.\n";
            while ($this->rows[] = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC));
        } else {
            //echo "Row insertion failed.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        # Free statement and connection resources
        sqlsrv_free_stmt($result);
        $this->close_connection();

        #
        array_pop($this->rows);

        return $this->rows;
    }

    protected function get_results_from_multiple_sp() {
        #
        $result = sqlsrv_query($this->open_connection(), $this->query, $this->params);

        if ($result === false) {
            echo "Error al ejecutar el SP.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        /* Movemos al siguiente resultado de la consulta */
        $next_result = sqlsrv_next_result($result);
        if ($next_result) {
            while ($this->rows[] = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC));
        } elseif (is_null($next_result)) {
            echo "No more results.\n";
        } else {
            echo "Error in moving to next result.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        # Free statement and connection resources
        sqlsrv_free_stmt($result);
        $this->close_connection();

        #
        array_pop($this->rows);

        return $this->rows;
    }



}