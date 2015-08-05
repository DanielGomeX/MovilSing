<?php


class PlanRutaController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ClientesModel');
        $this->load->model('PedidosModel');

        #cargamos la libreria para validación de formularios de forma global
        #ya que varios métodos mandan llamar al mismo formulario
        $this->load->library('form_validation');

        #si el usuario no está autenticado, se redirecciona para que se registre
        if($this->session->logged_in<>"SI")
        {
           redirect('','refresh');
       }
    }

    public function index() {
        $datos['titulo'] = 'Plan Ruta';
        $datos['clientes_planruta'] = $this->ClientesModel->clientesPlanRuta($this->session->usuario);
        $datos['vista'] = 'buscar_cliente';
        $this->load->view('plantillas/master_page', $datos);
    }

    public function buscarCliente() {

        $datos['titulo'] = 'Plan Ruta';
        $datos['vista'] = 'buscar_cliente';

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
        $datos_cliente = array();
        $datos_cliente = $this->ClientesModel->ObtenerDatosCliente($cliente);

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

        #Esta validación sirve para identificar si el cliente escribió directamente en la url
        #algún numero de cliente que quizá no le pertencezca a su zona
        if($this->session->usuario==trim($datos['zona']))
        {
            #Creamos la variable de session "cliente" con el número de cliente seleccionado
            $_SESSION['cliente']=$cliente;

            $datos['cliente'] = $cliente;
            $datos['vista'] = 'datos_cliente';
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
        $datos['vista']='visitas_cliente';

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
        $datos['vista']='cobranza_cliente';
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
        $datos['vista']='entregas_cliente';
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
        $datos['vista']='saldos_cliente';
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

        $datos['vista']='pedidos_cliente';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Permite registrar el motivo por el cual la visita que se realizó al cliente no fue exitosa
     * @return null
     */
    public function registrarVisitaNoExitosa() {

        $datos['titulo'] = 'Visitas';
        $datos['vista'] = 'visitas_cliente';

        #Establecemos las reglas de validación
        $this->form_validation->set_rules('comentario', 'comentario', 'required');

        #Validamos el formulario, si es igual a false, entonces algún campo no cumple con las reglas establecidas
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('plantillas/master_page', $datos);
        } else {

            #asignamos las variables de session a variables locales
            $cliente=$this->session->cliente;
            $usuario=$this->session->usuario;

            #si la página se validó correctamente
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
        $datos['vista'] = 'registrar_cobranza';

        #Establecemos las reglas de validación
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('recibo', 'Recibo', 'required');
        $this->form_validation->set_rules('importe', 'Importe', 'required|numeric');
        $this->form_validation->set_rules('formaPago', 'FormaPago', 'required');
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
            $formapago = $this->input->post('formaPago');
            $referencia = $this->input->post('referencia');
            $importe = $this->input->post('importe');
            $recibo = $this->input->post('recibo');
            $fechacobro = $this->input->post('fechaCobro');
            $comentario = $this->input->post('comentario');

            #ejecutamos query
            $cobranza=$this->ClientesModel->registrarCobranza($usuario, $cliente, $formapago, $recibo, $importe, $referencia, $fechacobro, $comentario);

            #obtenemos los valores de cada campo
            foreach ($cobranza as $registro) {
                $datos['error']=$registro['Error'];
                $datos['desc']=$registro['Descripcion'];
            }

           if ($datos['error']===0) {

                /*
                #registramos la visita al cliente como visita de cobranza
                $motivo="3"; #Valor correspondiente al motivo: visita para cobranza
                $visita=$this->ClientesModel->registrarVisita($cliente,$usuario, $motivo, strtoupper($comentario), "cliente");
                */

                #mostramos las cobranzas registradas incluyendo el último registro ingresado
                redirect('cobranza');
           }
           else {
            $this->load->view('plantillas/master_page', $datos);
           }

        }
    }
}
