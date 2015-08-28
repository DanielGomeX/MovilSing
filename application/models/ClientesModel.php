<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#línea requerida para poder heredar de la clase padre
require_once APPPATH.'models/AbstractModel.php';

class ClientesModel extends AbstractModel {

    function __construct() {
        parent::__construct();
    }

    public function clientesPlanRuta($zona){
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerClientesPlanRuta(?)}";

        # asignamos los valores de los parametros
        $this->params = array($zona);

        return $this->get_rows();
    }

    public function buscarClientes($buscar, $zona) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_BuscarClientes(?,?)}";

        # asignamos los valores de los parametros
        $this->params = array($buscar, $zona);

        return $this->get_rows();
    }

    /**
     * Permite buscar en la base de datos información referente al cliente
     * @param  [string] $cliente [número de cliente a consultar en la BD]
     * @return [arreglo]         [un solo registro con la información encontrada]
     */
    public function obtenerDatosCliente($cliente) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerDatosCliente(?)}";

        # asignamos los valores de los parametros
        $this->params = array($cliente);

        return $this->get_rows();
    }


    /**
     * (Por implementar )Regresa las coordenas de geolocalización (latitud, longitud) registradas para el cliente
     * @param  [string] $cliente [número de cliente a consultar en la BD]
     * @return [arreglo]         [un solo registro con la información encontrada]
     */
    public function obtenerCoordenadasGPSCliente($cliente) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerCoordenadasGPSCliente(?)}";

        # asignamos los valores de los parametros
        $this->params = array($cliente);

        return $this->get_rows();
    }


    /**
     * Permite buscar en la base de datos las últimas 5 visitas registradas al cliente seleccionado
     * @param  [string] $cliente [número de cliente a consultar en la BD]
     * @param  [string] $usuario [usuario del cual se van a obtener las visitas registradas]
     * @return [arreglo]         [registros encontrado]
     */
    public function obtenerVisitas($cliente, $usuario) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerUltimasVisitas (?,?)}";

        # asignamos los valores de los parametros
        $this->params = array($cliente, $usuario);

        return $this->get_rows();
    }

    /**
     * Permite buscar en la base de datos información referente a las visitas registradas del periodo actual
     * @param  [string] $usuario  [usuario del cual se van a obtener las visitas registradas]
     * @return [arreglo]          [registros encontrados]
     */
    public function obtenerVisitasPeriodo($usuario) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerVisitasPeriodo (?)}";

        # asignamos los valores de los parametros
        $this->params = array($usuario);

        return $this->get_rows();
    }

    /**
     * Permite Registra la visita que realiza el vendedor al cliente
     * @param  string $cliente     [cliente al cual se le realiza la visita]
     * @param  string $usuario     [usauiro que registra la visita]
     * @param  string $motivo      [motivo de la visita, venta, cobranza o no exitosa]
     * @param  string $comentario  [breve comentario referente a la visita con el cliente]
     * @param  string $tipocliente [cliento o prospecto]
     * @return null
     */
    public function registrarVisita($cliente, $usuario, $motivo, $comentario, $tipocliente) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_RegistrarVisita(?,?,?,?,?)}";

        #asignamos los valores de los parametros
        $this->params = array($cliente, $usuario, $motivo, $comentario, $tipocliente);

        $this->execute_insert();
    }

    public function obtenerCobranza($cliente, $usuario) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerUltimasCobranzas (?,?)}";

        # asignamos los valores de los parametros
        $this->params = array($cliente, $usuario);

        return $this->get_rows();
    }

    /**
     * Permite buscar en la base de datos información referente a la cobrnza registradas del periodo actual
     * @param  [string] $usuario  [usuario del cual se van a obtener las cobranzas registradas]
     * @return [arreglo]          [registros encontrados]
     */
    public function obtenerCobranzaPeriodo($usuario) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerCobranzaPeriodo (?)}";

        # asignamos los valores de los parametros
        $this->params = array($usuario);

        return $this->get_rows();
    }

    /**
     * Permite registra la cobranza que realiza el vendedor al cliente
     * @param  string $usuario     [usuario que registra la cobranza]
     * @param  string $cliente     [cliente al cual se le realiza la cobranza]
     * @param  string $formapago   [forma de pago: efectivo, cheque, transferencia]
     * 
     * @param  string $recibo      [numero de recibo con el cual se registra la cobranza]
     * @param  string $importe     [importe por el cual se realiza la cobranza]
     * @param  string $referencia  [valor que sirve para rastrear el pago en el banco]
     * @param  string $fechacobro  [fecha en la cual se deberia de ver reflejado el pago en el banco]
     * @param  string $comentario  [generalmente se usa para registrar las facturas que avalan el pago recibido]
     * @return null
     */
    public function registrarCobranza($usuario, $cliente, $formapago, $banco, $recibo, $importe, $referencia, $fechacobro, $comentario)  {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_RegistrarCobranza(?,?,?,?,?,?,?,?,?)}";

        #asignamos los valores de los parametros
        $this->params = array($usuario, $cliente, $formapago, $banco, $recibo, $importe, $referencia, $fechacobro, $comentario);

        return $this->get_rows();
    }


    public function obtenerEntregas($cliente) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerUltimasEntregas (?)}";

        # asignamos los valores de los parametros
        $this->params = array($cliente);

        return $this->get_rows();
    }

    public function obtenerSaldos($cliente) {
        # mandamos llamar al stored procedure
        $this->query = "{call MovilSing_ObtenerSaldosVencidos (?)}";

        # asignamos los valores de los parametros
        $this->params = array($cliente);

        return $this->get_rows();
    }



}
