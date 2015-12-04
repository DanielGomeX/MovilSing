<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportesController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('PedidosModel');
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
     * Muestra los pedidos del usuario con status de liberado (L) del periodo actual
     * @return [null]
     */
	public function pedidosLiberados(){

		$datos['titulo']='Pedidos Liberados';

        #obtenemos datos referentes al resumen del pedido
        $datos['pedidos'] = $this->PedidosModel->obtenerPedidosLiberados($this->session->usuario);

        $datos['vista']='reportes/pedidos_liberados';
        $this->load->view('plantillas/master_page', $datos);
	}

    /**
     * Muestra los pedidos del usuario con status de retenido (R) del periodo actual
     * @return [null]
     */
	public function pedidosRetenidos() {

		$datos['titulo']='Pedidos Retenidos';

        #obtenemos datos referentes al resumen del pedido
        $datos['pedidos'] = $this->PedidosModel->obtenerPedidosRetenidos($this->session->usuario);

        $datos['vista']='reportes/pedidos_retenidos';
        $this->load->view('plantillas/master_page', $datos);
	}

    /**
     * Muestra los pedidios del usuario con status de pendidnete (Captura:C, Aut. Parcialmente:AP, Retenido Parcialmente:RP, y Vendedor:V)
     * del periodo actual
     * @return [null]
     */
	public function pedidosPendientes() {

		$datos['titulo']='Pedidos Pendientes';

        #obtenemos datos referentes al resumen del pedido
        $datos['pedidos'] = $this->PedidosModel->obtenerPedidosPendientes($this->session->usuario);

        $datos['vista']='reportes/pedidos_pendientes';
        $this->load->view('plantillas/master_page', $datos);
	}

    /**
     * Muestra la información encontrada correspondiente a las visitas registradas en el periodo actual
     * @return [null]
     */
	public function visitasPeriodo() {

		$datos['titulo']='Visitas del Periodo';
        $datos['vista']='reportes/visitas_periodo';

        #obtenemos datos referentes al resumen del pedido
        $datos['visitas'] = $this->ClientesModel->obtenerVisitasPeriodo($this->session->usuario);


        $this->load->view('plantillas/master_page', $datos);
	}

    /**
     * Muestra la información encontrada correspondiente a la cobranza registradas en el periodo actual
     * @return [null]
     */
	public function cobranzaPeriodo() {

		$datos['titulo']='Cobranza del Periodo';
        $datos['vista']='reportes/cobranza_periodo';

        #obtenemos datos referentes al resumen del pedido
        $datos['cobranza'] = $this->ClientesModel->obtenerCobranzaPeriodo($this->session->usuario);

        $this->load->view('plantillas/master_page', $datos);
	}


    /**
     * Muestra la información encontrada correspondiente a la cobranza registradas en el periodo actual
     * @return [null]
     */
    public function backOrder() {

        $datos['titulo']='BackOrder';
        $datos['vista']='reportes/back_order';

        #obtenemos datos referentes al resumen del pedido
        $datos['backOrder'] = $this->ClientesModel->obtenerDatosCliente($this->session->usuario);

        $this->load->view('plantillas/master_page', $datos);
    }


}

/* End of file ReportesController.php */
/* Location: ./application/controllers/ReportesController.php */