<?php

class PedidosController extends CI_Controller {

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
            $datos['productos'] = $this->PartidasModel->obtenerProductosPorDescripcion($cliente, $contiene);

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
            unset($_SESSION['cliente']);
            unset($_SESSION['pedido']);
            # direccionamos la aplicación al plan de ruta
            redirect('planruta');
        }
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


}
