<?php

class PlanRutaController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('PedidosModel');
        $this->load->model('PartidasModel');
        $this->load->model('ClientesModel');

        #cargamos la libreria para validación de formularios de forma global
        #ya que varios métodos mandan llamar al mismo formulario
        $this->load->library('form_validation');

        #si el usuario no está autenticado, se redirecciona para que se registre
        if($this->session->logged_in<>"SI")
        {
            redirect('','refresh');
        }
    }

    /**
     * muestra los clientes pertenecientes al usuario que debe de visitar conforme a la programación del plan de ruta
     * @return
     */
    public function index() {
        $datos['titulo'] = 'Plan Ruta';

        $datos['clientes_planruta'] = $this->ClientesModel->clientesPlanRuta($this->session->usuario);

        $datos['vista'] = 'planRuta/buscar_cliente';

        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * se crea a manera de prueba para usar json con ajax
     * @return [type] [description]
     */
    public function coordeneas() {

        $planRuta=$this->ClientesModel->clientesPlanRuta($this->session->usuario);

        $json=array();
        #Obtenemos el nuevo número de pedido asignado
        foreach ($planRuta as $registro) {
             $json[] = array('cliente'  => $registro['Cliente'],
                              'nombre'  => utf8_encode($registro['Nombre']),
                              'latitud' => 21.906207,
                              'longitud'=> -102.290083,
                              );
        }

        echo json_encode($json);
    }

    /**
     * Verifica si la variable de sesión "pedido" NO EXISTE (es decir, su valor es nulo),
     * si es así, entonces se redirecciona a Plan de Ruta, esto es por si el usuario trata de entrar
     * directamente a este método sin que haya seguido el flujo de captura de un pedido
     * @return [type] [description]
     */
    private function validaSessionPedido(){

        if(is_null($this->session->pedido))
        {
            redirect('planruta');
        }
    }

    /**
     * Permite registrar el encabezado de un nuevo pedido en la BD
     * @return string Retorna el número de pedido
     */
    public function nuevo() {
        $datos['titulo'] = 'Registrar Partida';

        #registra el encabezado del pedido en la BD
        $consulta = $this->PedidosModel->registrarPedido($this->session->cliente);

        #Obtenemos el nuevo número de pedido asignado
        foreach ($consulta[0] as $key => $value) {
            $datos['pedido'] = $value;
        }

        #Creamos la variable de session pedido con el número de pedidos que nos regresó la consulta previa
        $_SESSION['pedido']=$datos['pedido'];

        $datos['vista'] = 'planRuta/pedido_encabezado';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Permite agregar al pedido en la base de datos la partida capturada
     * @return
     */
    public function agregarPartida() {

        $this->validaSessionPedido();

        $datos['titulo'] = 'Registrar Partida';
        $datos['vista'] = 'planRuta/pedido_encabezado';

        #Establecemos las reglas de validación
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('clave', 'Codigo', array('required', 'max_length[30]'));
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'required|numeric|greater_than[0]');

        #Validamos el formulario, si es igual a false, entonces algún campo no cumple con las reglas establecidas
        if ($this->form_validation->run() == false) {
            $this->load->view('plantillas/master_page', $datos);
        } else {

            $clave = $this->input->post('clave');
            $cantidad = $this->input->post('cantidad');

            $datos_partida = array();
            $datos_partida = $this->PartidasModel->registrarPartidaPedido($this->session->pedido, strtoupper($clave), $cantidad);

            foreach ($datos_partida as $registro) {
                $datos['error']=$registro['Err'];
                $datos['producto']=$registro['Producto'];
                $datos['mensaje']=$registro['Mensaje'];
                $datos['existencia']=$registro['Existencia'];
            }

            $this->load->view('plantillas/master_page', $datos);

        }
    }

    /**
     * Permite eliminar de la base de datos la partida registrada previamente en el pedido
     * @param  [string] $id [identificador único de la partida a eliminar]
     * @return
     */
    public function eliminarPartida($id) {

        $this->PartidasModel->eliminarPartida($id);

        $this->mostrarPartidas();
    }

    /**
     * muestra las partidas registradas al pedido, antes de mostrar dichas partidas se ejecuta el procedimiento
     * para el cálculo de descuentos y promociones
     * @return [type] [description]
     */
    public function mostrarPartidas() {

        $this->validaSessionPedido();

        #ejecutamos procedimeintos para aplicar descuentos y promociones correspondientes
        $totales=$this->PartidasModel->aplicarDescuentosPromociones($this->session->pedido);

        foreach ($totales as $tot) {
            $datos['subtotal']=$tot['Importe'];
        }

        #mostramos partidas
        $partidas=$this->PartidasModel->obtenerPartidasPedido($this->session->pedido);

        $datos['partidas_pedido'] = $partidas;
        $datos['total_partidas'] = count($partidas);
        $datos['vista'] = 'planRuta/pedido_detalle';
        $datos['titulo'] = 'Captura Pedido';

        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Consulta en la base de datos aquellos productos que coincidan con el criterio de búsqueda capturado
     * @return
     */
    public function buscarProducto() {

        # establecemos las reglas de validación correspondientes
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('descripcion', 'Buscar', 'required|min_length[3]|max_length[15]');

        $datos['vista'] = 'planRuta/pedido_encabezado';

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('plantillas/master_page', $datos);
        } else {
            $cliente =  $this->session->cliente;
            $contiene = $this->input->post('descripcion');
            $datos['productos'] = $this->PartidasModel->obtenerProductosPorFiltro($contiene);
            $this->load->view('plantillas/master_page', $datos);
        }
    }

    /**
     * muestra la información general del pedido antes de que el usuario lo guarde o lo cancele
     * @return
     */
    public function resumenPedido() {

        $this->validaSessionPedido();

        $datos['titulo']='Resumen Pedido';

        #ejecutamos verificador de condiciones crediticias
        $this->PedidosModel->aplicarCondicionesCrediticias($this->session->pedido);

        #obtenemos datos referentes al resumen del pedido
        $datos_resumen = array();
        $datos_resumen = $this->PedidosModel->obtenerDatosResumenPedido($this->session->pedido);
        foreach ($datos_resumen as $registro) {
            $datos['tipo_cliente']=$registro['TipoCliente'];
            $datos['cond_pago']=$registro['CondicionesPago'];
            $datos['cliente']=$registro['Cliente'];
            $datos['nombre']=$registro['Nombre'];
            $datos['importe']=$registro['Importe'];
            $datos['iva']=$registro['Iva'];
            $datos['total']=$registro['Total'];
            $datos['consignacion']=$registro['Consignacion'];
            $datos['direccion']=$registro['Direccion'];
            $datos['colonia']=$registro['Colonia'];
            $datos['ciudad']=$registro['Ciudad'];
            $datos['municipio']=$registro['Municipio'];
            $datos['estado']=$registro['Estado'];
            $datos['codigo_postal']=$registro['CodigoPostal'];
            $datos['causa_retencion']=$registro['CausaRetencion'];
            $datos['importe_min_venta']=$registro['ImporteMinVenta'];
        }

        $datos['vista']='planRuta/resumen_pedido';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Determina la acción final a realizar con el pedidos,es decir, se guarda o se cancela]
     * @return null
     */
    public function accionResumenPedido(){

        #asignamos las variables de session a variables locales
        $cliente=$this->session->cliente;
        $pedido=$this->session->pedido;
        $usuario=$this->session->usuario;

        #obtenemos los valores del formulario
        $comentario=$this->input->post('comentario');
        $finalizar=$this->input->post('finalizar');
        $cancelar=$this->input->post('cancelar');

        #inicializamos la varibale accion como vacia
        $accion="";

        //Si se seleccionó el botón para Finalizar el pedido
        if (isset($finalizar)) {
            $accion="G";
        }

        //Si se seleccionó el botón para Cancelar el pedido
        if (isset($cancelar)) {
            $accion="X";
        }


        $result=$this->PedidosModel->finalizarPedido($pedido, $accion, strtoupper($comentario), $usuario);

        #si la consulta regresó un valor verdadero
        if ($result) {

            #registramos la visita al cliente como visita de venta
            $motivo="2"; #Valor correspondiente al motivo: visita para venta
            $visita=$this->ClientesModel->registrarVisita($cliente,$usuario, $motivo, strtoupper($comentario), "cliente");

            #limpiamos variables de sesión referentes al pedido
            unset($_SESSION['pedido']);

            $datos['vista']='planRuta/que_deseas_hacer';
            $datos['mensaje']='¿Qué deseas hacer ahora...?';
            $this->load->view('plantillas/master_page', $datos);
        }
    }

    /**
     *  obtiene las diversas consignaciones que tiene registradas el cliente del pedido
     * @return
     */
    public function mostrarConsignaciones(){

        $this->validaSessionPedido();

        $datos['titulo']='Consignaciones';

        #obtenemos la información de la BD
        $datos['consignaciones'] = $this->PedidosModel->obtenerConsignaciones($this->session->cliente);

        $datos['vista']='planRuta/consignaciones_cliente';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Permite cambiar en la BD la consignación del pedido
     * @param  [string] $consignacion [el número de identificación de la consignación que se cambiara]
     * @return
     */
    public function cambiarConsignacion($consignacion){

        #cambiamos la consignación del pedido en la BD
        $this->PedidosModel->cambiarConsignacion($this->session->pedido, $consignacion);
        # regresamos a la  vista del resumen del pedido
        $this->resumenPedido();
    }

    /**
     * Permite retomar del cliente seleccionado en el plan de ruta un pedido ,siempre y cuendo el pedido
     * tenga un status válido para ser retomado.
     * @param  string $pedido número de pedido del cual se desea retomar
     * @return null
     */
    public function retomarPedido($pedido) {

        #si la variable de sesion cliente contiene el valor de un número de cliente, entonces se procese a verificar si el pedido puede ser retomado
        if (!is_null($this->session->cliente)) {

            $datos['titulo'] = 'Registrar Partida';

            #se ejecuta consulta para validar si el pedido se puede retomar
            $consulta = $this->PedidosModel->retomarPedidoCliente($pedido);

            $respuesta="";
            #asignamos el valor retornado por la consulta a la variable respuesta
            foreach ($consulta as $registro) {
                $respuesta = $registro['custid'];
            }

            #si la variable respuesta es igual a la variable de session cliente, entonces el pedidos puede ser retomado
            #ya que pertenece al cliente que se tienen seleccionado en el  plan de ruta
            if ($respuesta==$this->session->cliente){
                #creamos la variable de session pedido con el número de pedidos que se desea retomar
                $_SESSION['pedido']=$pedido;

                $datos['vista'] = 'planRuta/pedido_encabezado';
                $this->load->view('plantillas/master_page', $datos);
            }
            else {
                echo "Tu pedido no puede ser retomado, favor de verificar.";
            }
        }
        else{
             #la varibale de sessión no existe previamente, se sale del sistema
             redirect('logout','refresh');
        }
    }

    /**
     * Consulta en la BD  los registros correspondientes a las partidas del pedido
     * @param  [string] $pedido numero de pedido del cual se desean consultar las partidas
     * @return [null]
     */
    public function consultarPartidasPedido($pedido) {
        #Obtenemos las partidas del pedido
        $partidas=$this->PartidasModel->obtenerPartidasPedido($pedido);

        $datos['partidas'] = $partidas;
        $datos['vista'] = 'planRuta/partidas_pedido';
        $datos['titulo'] = 'Partidas del Pedido';

        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Permite buscar en la BD clientes pertenecientes al usuario
     * @return
     */
    public function buscarCliente() {

        $datos['titulo'] = 'Plan Ruta';
        $datos['vista'] = 'planRuta/buscar_cliente';

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('buscar', 'Buscar', 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('plantillas/master_page', $datos);
        } else {
            $buscar = $this->input->post('buscar');

            #buscamos los clientes que pertenecen al usuario autenticado
            $datos['clientes'] = $this->ClientesModel->buscarClientes($buscar, $this->session->usuario);
            $this->load->view('plantillas/master_page', $datos);
        }
    }

    /**
     * Busca en la base de datos la información general correspondiente al cliente seleccionado
     * y la muestra en pantalla, también crea una variable de sessión llamada cliente con el número
     * de cliente seleccionado.
     * @param  string $cliente número de cliente seleccionado
     * @return [null]
     */
    public function mostrarDatosCliente($cliente) {
        $datos['titulo'] = 'Datos Cliente';

        #Obtenemos la información del clientre de la base de datos
        $datos_cliente= $this->ClientesModel->ObtenerDatosCliente($cliente);

        #Recorremos el registro encontrado para asignar los valores a las varibles y mostrar l información en pantalla
        foreach ($datos_cliente as $registro) {
            $datos['nombre']=$registro['Nombre'];
            $datos['tipo_cliente']=$registro['Tipo'];
            $datos['direccion']=$registro['Direccion'];
            $datos['colonia']=$registro['Colonia'];
            $datos['ciudad']=$registro['Ciudad'];
            $datos['estado']=$registro['Estado'];
            $datos['telefono']=$registro['Telefono'];
            $datos['email']=$registro['Email'];
            $datos['cond_pago']=$registro['CondPago'];
            $datos['limite_credito']=$registro['LimiteCredito'];
            $datos['credito_disponible']=$registro['CreditoDisp'];
            $datos['dias_prom_pago']=$registro['DiasPromPago'];
            $datos['cheques_devueltos']=$registro['ChequesDev'];
            $datos['saldo_actual']=$registro['Saldo'];
            $datos['zona']=$registro['Zona'];
        }

        #inicializamos las coordenadas en cero para el caso en que el cliente no tenga coordenadas registradas
        $datos['latitud']=0;
        $datos['longitud']=0;

        #obtenemos las coordenas registradas
        $coordenadasGPS=$this->ClientesModel->obtenerCoordenadasGPSCliente($cliente);
        #recorremos cada campo para asignar valores a las variables latitud y longitud
        foreach ($coordenadasGPS as $coordenadas) {
                $datos['latitud']=$coordenadas['Latitud'];
                $datos['longitud']=$coordenadas['Longitud'];
        }

        #Esta validación sirve para identificar si el cliente escribió directamente en la url
        #algún numero de cliente que quizá no le pertencezca a su zona
        if($this->session->usuario==trim($datos['zona']))
        {
            #Creamos la variable de session "cliente" con el número de cliente seleccionado
            $_SESSION['cliente']=$cliente;

            #Creamos la variable de session "nombre_cliente" con el número de cliente seleccionado
            $_SESSION['nombre_cliente']=$datos['nombre'];

            $datos['cliente'] = $cliente;
            $datos['vista'] = 'planRuta/datos_cliente';

            $this->load->view('plantillas/master_page', $datos);
        }
        else{
            echo "El cliente que escribiste MANUALMENTE no pertenece a tu zona.";
        }
    }

    /**
     * Busca en la base de datos la información correspondiente de las últimas
     * 5 visitas registradas y las muestra en pantalla
     * @return [null]
     */
    public function mostrarVisitas(){

        $datos['titulo']='Visitas';
        $datos['vista']='planRuta/visitas_cliente';

        #asignamos el valor de la variable se session cliente a una variable local
        $cliente=$this->session->cliente;
        $usuario=$this->session->usuario;

        #Obtenemos los registros de las visitas realizadas
        $datos['visitas'] = $this->ClientesModel->obtenerVisitas($cliente, $usuario);

        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Busca en la base de datos la información correspondiente de los últimos
     * 10 registros de cobranza del cliente y los muestra en pantalla
     * @return [null]
     */
    public function mostrarCobranza(){
        $datos['titulo']='Cobranza';

        #asignamos el valor de la variable se session cliente a una variable local
        $cliente=$this->session->cliente;

        #Obtenemos los registros de las visitas realizadas
        $datos['cobranza'] = $this->ClientesModel->obtenerCobranza($cliente, $this->session->usuario);

        $datos['cliente']=$cliente;
        $datos['vista']='planRuta/cobranza_cliente';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Busca en la base de datos la información correspondiente de las últimas
     * 10 entregas registradas y las muestra en pantalla
     * @return [null]
     */
    public function mostrarEntregas(){

        $datos['titulo']='Entregas';

        #asignamos el valor de la variable se session cliente a una variable local
        $cliente=$this->session->cliente;

        #Obtenemos los registros de las visitas realizadas
        $datos['entregas'] = $this->ClientesModel->obtenerEntregas($cliente);

        $datos['cliente']=$cliente;
        $datos['vista']='planRuta/entregas_cliente';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Busca en la base de datos la información correspondiente de los últimos
     * 10 registros de saldo vencidos del cliente y los muestra en pantalla
     * @return [null]
     */
    public function mostrarSaldos(){

        $datos['titulo']='Saldos';

        #asignamos el valor de la variable se session cliente a una variable local
        $cliente=$this->session->cliente;

        #Obtenemos los registros de las visitas realizadas
        $datos['saldos'] = $this->ClientesModel->obtenerSaldos($cliente);

        $datos['cliente']=$cliente;
        $datos['vista']='planRuta/saldos_cliente';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Busca en la base de datos la información correspondiente a las pedidos
     * registrados al cliente en el periodo actual
     * @return [null]
     */
    public function pedidosCliente() {

        $datos['titulo']='Pedidos del cliente';

        #obtenemos datos referentes al resumen del pedido
        $datos['pedidos'] = $this->PedidosModel->obtenerPedidosCliente($this->session->cliente);

        $datos['vista']='planRuta/pedidos_cliente';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Permite registrar el motivo por el cual la visita que se realizó al cliente no fue exitosa
     * @return null
     */
    public function registrarVisitaNoExitosa() {

        $datos['titulo'] = 'Visitas';
        $datos['vista'] = 'planRuta/visitas_cliente';

        #Establecemos las reglas de validación
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('comentario', 'comentario', 'required');

        #Validamos el formulario, si es igual a false, entonces algún campo no cumple con las reglas establecidas
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('plantillas/master_page', $datos);
        } else {

            #asignamos las variables de session a variables locales
            $cliente=$this->session->cliente;
            $usuario=$this->session->usuario;
            $comentario = $this->input->post('comentario');

            #registramos la visita al cliente como visita de venta
            $motivo="9"; #Valor correspondiente al motivo: otros
            $visita=$this->ClientesModel->registrarVisita($cliente, $usuario, $motivo, strtoupper($comentario), 'cliente');

            #mostramos las visitas incluyendo el último registro realizado
            redirect('visitas');
        }
    }

    /**
     * Permite registrar el motivo por el cual la visita que se realizó al cliente no fue exitosa
     * @return null
     */
    public function registrarCobranza() {

        $datos['titulo'] = 'Cobranza';
        $datos['vista'] = 'planRuta/registrar_cobranza';

        #Establecemos las reglas de validación
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('recibo', 'Recibo', 'required');
        $this->form_validation->set_rules('importe', 'Importe', 'required|numeric');
        $this->form_validation->set_rules('formaPago', 'FormaPago', 'required');
        $this->form_validation->set_rules('banco', 'Banco', 'required');
        $this->form_validation->set_rules('referencia', 'Referencia', 'required');
        $this->form_validation->set_rules('fechaCobro', 'Fecha de cobro', 'required');
        $this->form_validation->set_rules('comentario', 'Comentario', 'required');

        #Validamos el formulario, si es igual a false, entonces algún campo no cumple con las reglas establecidas
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('plantillas/master_page', $datos);
        } else {

            #asignamos las variables de session a variables locales
            $cliente=$this->session->cliente;
            $usuario=$this->session->usuario;

            #si la página se validó correctamente, agregamos un nuevo registro de cobranza
            $recibo = $this->input->post('recibo');
            $importe = $this->input->post('importe');
            $formapago = $this->input->post('formaPago');
            $banco = $this->input->post('banco');
            $referencia = $this->input->post('referencia');
            $fechacobro = $this->input->post('fechaCobro');
            $comentario = $this->input->post('comentario');

            #ejecutamos query
            $cobranza=$this->ClientesModel->registrarCobranza($usuario, $cliente, $formapago, $banco, $recibo, $importe, $referencia, $fechacobro, $comentario);

            #obtenemos los valores de cada campo
            foreach ($cobranza as $registro) {
                $datos['error']=$registro['Error'];
                $datos['desc']=$registro['Descripcion'];
            }

           if ($datos['error']===0) {

                #mostramos las cobranzas registradas incluyendo el último registro ingresado
                redirect('cobranza');
           }
           else {
            $this->load->view('plantillas/master_page', $datos);
           }

        }
    }

    /**
     * Permite mostrar los comentariosasociados al pedido
     * @param  [string] $pedido [número de pedido del cual se desean obtener los comentarios]
     * @return
     */
    public function mostrarComentariosPedido($pedido){

        $datos['titulo']='Comentarios';
        $datos['vista']='planRuta/comentarios_pedido';

        #Obtenemos los registros de las visitas realizadas
        $datos['comentarios'] = $this->PedidosModel->obtenerComentariosPedido($pedido);

        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     *  Muestra los diferentes plazos (condiciones de crédito) que se pueden elegiar para cambiar el plazo de un pedido
     * @return
     */
    public function mostrarCondicionesPagoEspecial(){

        $this->validaSessionPedido();

        $datos['titulo']='Condiciones Pago';

        #obtenemos la información de la BD
        $datos['condicionesPago'] = $this->PedidosModel->obtenerCondicionesPagoEspecial();

        $datos['vista']='planRuta/condiciones_pago_cliente';
        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * Permite cambiar en la BD la consignación del pedido
     * @param  [string] $consignacion [el número de identificación de la consignación que se cambiara]
     * @return
     */
    public function cambiarCondicionPago($condicion){

        #cambiamos la consignación del pedido en la BD
        $this->PedidosModel->cambiarCondicionPagoEspecial($condicion, $this->session->pedido);
        # regresamos a la  vista del resumen del pedido
        $this->resumenPedido();
    }

}
