<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportesController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('PedidosModel');
        $this->load->model('ClientesModel');
        $this->load->model('PartidasModel');

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
     * Muestra la información encontrada correspondiente a las partidas que se encuentran actualmente con BackOrder
     * @return [null]
     */
    public function backOrder() {

        $datos['titulo']='BackOrder';
        $datos['vista']='reportes/back_order';

        #obtenemos datos referentes al resumen del pedido
        $datos['backOrder'] = $this->ClientesModel->obtenerDatosCliente($this->session->usuario);

        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Muestra la información encontrada correspondiente a las partidas que se encuentran actualmente con BackOrder
     * @return [null]
     */
    public function indicadoresVentasUsuario() {

        $datos['titulo']='Indicadores';
        $datos['vista']='reportes/indicadores_ventas';

        #obtenemos datos referentes al resumen del pedido
        $respuesta = $this->ClientesModel->indicadoresVentasUsuario($this->session->usuario);

        $datos['ObjMensual']=$respuesta[0]['ObjMensual'];
        $datos['FactMensual']=$respuesta[0]['FactMensual'];
        $datos['CobMensual']=$respuesta[0]['CobMensual'];
        $datos['Faltan']=$respuesta[0]['Faltan'];
        $datos['ObjDia']=$respuesta[0]['ObjDia'];
        $datos['MontoPedidosLib']=$respuesta[0]['MontoPedidosLib'];
        $datos['MontoPedidosret']=$respuesta[0]['MontoPedidosret'];

        $this->load->view('plantillas/master_page', $datos);
    }




    public function Existencias() {
        $datos['titulo']='Consulta Existencias';
        $datos['vista']='reportes/existencias';
        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * Consulta en la base de datos aquellos productos que coincidan con el criterio de búsqueda capturado
     * @return
     */
    public function buscarExistencia() {

        # establecemos las reglas de validación correspondientes
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('descripcion', 'Buscar', 'required|min_length[3]|max_length[15]');

        $datos['vista'] = 'reportes/existencias';

        if ($this->form_validation->run() == FALSE) {
            $this->Existencias();
        } else {
            //$cliente =  $this->session->cliente;
            $contiene = $this->input->post('descripcion');

            $datos['productos'] = $this->PartidasModel->obtenerProductosPorFiltro($contiene);
            $this->load->view('plantillas/master_page', $datos);
        }
    }


}

/* End of file ReportesController.php */
/* Location: ./application/controllers/ReportesController.php */