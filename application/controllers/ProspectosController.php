<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProspectosController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ProspectosModel');

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
     * Muestra los prospectos asociados al usuario
     * @return
     */
    public function index() {
        $datos['titulo'] = 'Mis Prospectos';

        $datos['prospectos'] = $this->ProspectosModel->prospectos($this->session->usuario);

        $datos['vista'] = 'prospectos/prospectos';

        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Permite mandar a la vista la información general correspondiente al prospecto seleccionado
     * @param  string $idProspecto
     * @return [null]
     */
    public function mostrarDatosProspecto($idProspecto) {
        $datos['titulo'] = 'Datos Prospecto';

        #Obtenemos la información del clientre de la base de datos
        $datos_prospecto= $this->ProspectosModel->ObtenerDatosProspecto($idProspecto);

        #$datos['idProspecto']=$datos_prospecto[0]['IdProspecto'];
        $datos['status']=$datos_prospecto[0]['Status'];
        $datos['folio']=$datos_prospecto[0]['Folio'];
        $datos['fechaSolicitud']=$datos_prospecto[0]['FechaSolicitud'];
        $datos['tipoCliente']=$datos_prospecto[0]['TipoCliente'];
        $datos['localidad']=$datos_prospecto[0]['Localidad'];
        $datos['nombre']=$datos_prospecto[0]['Nombre'];
        $datos['rfc']=$datos_prospecto[0]['Rfc'];
        $datos['direccion']=$datos_prospecto[0]['Direccion'];
        $datos['cp']=$datos_prospecto[0]['Cp'];
        $datos['colonia']=$datos_prospecto[0]['Colonia'];
        $datos['ciudad']=$datos_prospecto[0]['Ciudad'];
        $datos['municipio']=$datos_prospecto[0]['Municipio'];
        $datos['estado']=$datos_prospecto[0]['Estado'];
        $datos['giro']=$datos_prospecto[0]['Giro'];
        $datos['representante']=$datos_prospecto[0]['Representante'];
        $datos['gerente']=$datos_prospecto[0]['Gerente'];
        $datos['telefono']=$datos_prospecto[0]['Telefono'];
        $datos['email']=$datos_prospecto[0]['EMail'];
        $datos['comentarios']=$datos_prospecto[0]['Comentarios'];
        $datos['empresa1']=$datos_prospecto[0]['Empresa1'];
        $datos['empresa1telefono']=$datos_prospecto[0]['Empresa1telefono'];
        $datos['empresa2']=$datos_prospecto[0]['Empresa2'];
        $datos['empresa2telefono']=$datos_prospecto[0]['Empresa2telefono'];
        $datos['empresa3']=$datos_prospecto[0]['Empresa3'];
        $datos['empresa3telefono']=$datos_prospecto[0]['Empresa3telefono'];
        $datos['empresa4']=$datos_prospecto[0]['Empresa4'];
        $datos['empresa4telefono']=$datos_prospecto[0]['Empresa4telefono'];
        $datos['empresa5']=$datos_prospecto[0]['Empresa5'];
        $datos['empresa5telefono']=$datos_prospecto[0]['Empresa5telefono'];

        $_SESSION['prospecto']=$idProspecto;
        $datos['vista'] = 'prospectos/editar_prospecto';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Direcciona a la vista de captura de información de un nuevo prospecto
     * @return  [null]
     */
    public function nuevoProspecto() {
        $datos['titulo'] = 'Capturar Prospecto';
        $datos['vista'] = 'prospectos/captura_prospecto';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Permite mandar a la vista los asentamientos (colonias) encontrados que pertenecen al código postal en cuestion
     * @return [null]
     */
    public function obtenerAsentamientos() {
        $codigo_postal= $this->input->get('codigo');
        $result = $this->ProspectosModel->ObtenerAsentamientosSepomexPorCodigo($codigo_postal);
        echo json_encode($this->utf8_converter($result));
    }

    /**
     * Registra en la BD la información capurada del nuevo prospecto
     * @return null
     */
    public function registrarProspecto() {

        $datos['titulo'] = 'Capturar Prospecto';
        $datos['vista'] = 'prospectos/captura_prospecto';

        #Establecemos las reglas de validación
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('folio', 'Folio', 'required');
        $this->form_validation->set_rules('tipoCliente', 'Tipo de Solicitud', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('rfc', 'RFC', 'required|min_length[12]|max_length[13]');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required');
        $this->form_validation->set_rules('cp', 'C.P.', 'required|numeric|exact_length[5]');
        $this->form_validation->set_rules('colonia', 'Colonia', 'required');
        $this->form_validation->set_rules('giro', 'Giro', 'required');
        $this->form_validation->set_rules('localidad', 'Localidad', 'required');
        $this->form_validation->set_rules('representante', 'Representante', 'required|max_length[50]');
        $this->form_validation->set_rules('gerente', 'Gerente', 'required|max_length[50]');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[30]');
        $this->form_validation->set_rules('comentarios', 'Comentario', 'required');
        $this->form_validation->set_rules('empresa1', 'Empresa 1', 'required');
        $this->form_validation->set_rules('empresa1telefono', 'Teléfono empresa 1', 'required|numeric|exact_length[10]');
        #$this->form_validation->set_rules('empresa2', 'Empresa 2', 'required');
        #$this->form_validation->set_rules('empresa2telefono', 'Teléfono empresa 2', 'required|numeric|exact_length[10]');
        #$this->form_validation->set_rules('empresa3', 'Empresa 3', 'required');
        #$this->form_validation->set_rules('empresa3telefono', 'Teléfono empresa 3', 'required|numeric|exact_length[10]');
        #$this->form_validation->set_rules('empresa4telefono', 'Teléfono empresa 4', 'numeric|exact_length[10]');
        #$this->form_validation->set_rules('empresa5telefono', 'Teléfono empresa 5', 'numeric|exact_length[10]');

        #Validamos el formulario, si es igual a false, entonces algún campo no cumple con las reglas establecidas
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('plantillas/master_page', $datos);
        } else {

            #asignamos las variables de session a variables locales
            $usuario=$this->session->usuario;

            #si la página se validó correctamente, agregamos un nuevo registro de cobranza
            $folio = strtoupper($this->input->post('folio'));
            $tipoCliente = $this->input->post('tipoCliente');
            $nombre = utf8_encode(strtoupper($this->input->post('nombre')));
            $rfc = strtoupper($this->input->post('rfc'));
            $direccion = utf8_encode(strtoupper($this->input->post('direccion')));
            $cp = $this->input->post('cp');
            $colonia = utf8_encode(strtoupper($this->input->post('colonia')));
            $ciudad = utf8_encode(strtoupper($this->input->post('ciudad')));
            $estado = utf8_encode(strtoupper($this->input->post('estado')));
            $telefono = $this->input->post('telefono');
            $email= strtoupper($this->input->post('email'));
            $giro = $this->input->post('giro');
            $localidad = $this->input->post('localidad');
            $representante = utf8_encode(strtoupper($this->input->post('representante')));
            $gerente = utf8_encode(strtoupper($this->input->post('gerente')));
            $comentario = utf8_encode(strtoupper($this->input->post('comentarios')));
            $empresa1 = utf8_encode(strtoupper($this->input->post('empresa1')));
            $empresa1telefono = $this->input->post('empresa1telefono');
            $empresa2 = utf8_encode(strtoupper($this->input->post('empresa2')));
            $empresa2telefono = $this->input->post('empresa2telefono');
            $empresa3 = utf8_encode(strtoupper($this->input->post('empresa3')));
            $empresa3telefono = $this->input->post('empresa3telefono');
            $empresa4 = utf8_encode(strtoupper($this->input->post('empresa4')));
            $empresa4telefono = $this->input->post('empresa4telefono');
            $empresa5 = utf8_encode(strtoupper($this->input->post('empresa5')));
            $empresa5telefono = $this->input->post('empresa5telefono');

            $parametros_datos_prospecto=array(
                        $usuario,
                        $folio,
                        $tipoCliente,
                        $nombre,
                        $rfc,
                        $direccion,
                        $cp,
                        $colonia,
                        $ciudad,
                        $estado,
                        $telefono,
                        $email,
                        $giro,
                        $localidad,
                        $representante,
                        $gerente,
                        $comentario,
                        $empresa1,
                        $empresa1telefono,
                        $empresa2,
                        $empresa2telefono,
                        $empresa3,
                        $empresa3telefono,
                        $empresa4,
                        $empresa4telefono,
                        $empresa5,
                        $empresa5telefono
                        );

            #ejecutamos query
            $this->ProspectosModel->registrarProspecto($parametros_datos_prospecto);

            redirect('prospectos');
        }
    }

    /**
     * Registra en la BD la información capurada del nuevo prospecto
     * @return null
     */
    public function actualizarProspecto() {
        $datos['vista'] = 'prospectos/editar_prospecto';

        //
        $datos['folio']=strtoupper($this->input->post('folio'));
        $datos['tipoCliente']=strtoupper($this->input->post('tipoCliente'));
        $datos['nombre']=strtoupper($this->input->post('nombre'));
        $datos['rfc']=strtoupper($this->input->post('rfc'));
        $datos['direccion'] = strtoupper($this->input->post('direccion'));
        $datos['cp'] =  $this->input->post('cp');
        $datos['colonia'] = strtoupper($this->input->post('colonia'));
        $datos['ciudad']  = strtoupper($this->input->post('ciudad'));
        $datos['municipio'] = strtoupper($this->input->post('municipio'));
        $datos['estado'] = strtoupper($this->input->post('estado'));
        $datos['telefono'] =  $this->input->post('telefono');
        $datos['email'] = strtoupper($this->input->post('email'));
        $datos['giro'] = $this->input->post('giro');
        $datos['localidad'] = $this->input->post('localidad');
        $datos['representante'] = strtoupper($this->input->post('representante'));
        $datos['gerente'] = strtoupper($this->input->post('gerente'));
        $datos['comentarios'] = strtoupper($this->input->post('comentarios'));
        $datos['empresa1'] = strtoupper($this->input->post('empresa1'));
        $datos['empresa1telefono'] =  $this->input->post('empresa1telefono');
        $datos['empresa2'] =  strtoupper($this->input->post('empresa2'));
        $datos['empresa2telefono'] = $this->input->post('empresa2telefono');
        $datos['empresa3'] = strtoupper($this->input->post('empresa3'));
        $datos['empresa3telefono'] =  $this->input->post('empresa3telefono');
        $datos['empresa4'] = strtoupper($this->input->post('empresa4'));
        $datos['empresa4telefono'] = $this->input->post('empresa4telefono');
        $datos['empresa5'] = strtoupper($this->input->post('empresa5'));
        $datos['empresa5telefono'] = $this->input->post('empresa5telefono');

        #Establecemos las reglas de validación
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('folio', 'Folio', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('rfc', 'RFC', 'required|min_length[12]|max_length[13]');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required');
        $this->form_validation->set_rules('cp', 'C.P.', 'required|numeric|exact_length[5]');
        $this->form_validation->set_rules('representante', 'Representante', 'required|max_length[50]');
        $this->form_validation->set_rules('gerente', 'Gerente', 'required|max_length[50]');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[30]');
        $this->form_validation->set_rules('comentarios', 'Comentario', 'required');
        $this->form_validation->set_rules('empresa1', 'Empresa 1', 'required');
        $this->form_validation->set_rules('empresa1telefono', 'Teléfono empresa 1', 'required|numeric|exact_length[10]');
        #$this->form_validation->set_rules('empresa2', 'Empresa 2', 'required');
        #$this->form_validation->set_rules('empresa2telefono', 'Teléfono empresa 2', 'required|numeric|exact_length[10]');
        #$this->form_validation->set_rules('empresa3', 'Empresa 3', 'required');
        #$this->form_validation->set_rules('empresa3telefono', 'Teléfono empresa 3', 'required|numeric|exact_length[10]');
        #$this->form_validation->set_rules('empresa4telefono', 'Teléfono empresa 4', 'numeric|exact_length[10]');
        #$this->form_validation->set_rules('empresa5telefono', 'Teléfono empresa 5', 'numeric|exact_length[10]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('plantillas/master_page', $datos);
        } else {

            $folio = strtoupper($this->input->post('folio'));
            $tipoCliente = $this->input->post('tipoCliente');
            $nombre = strtoupper($this->input->post('nombre'));
            $rfc = strtoupper($this->input->post('rfc'));
            $direccion = strtoupper($this->input->post('direccion'));
            $cp = $this->input->post('cp');
            $colonia = strtoupper($this->input->post('colonia'));
            $ciudad = strtoupper($this->input->post('ciudad'));
            $municipio = strtoupper($this->input->post('municipio'));
            $estado = strtoupper($this->input->post('estado'));
            $telefono = $this->input->post('telefono');
            $email= strtoupper($this->input->post('email'));
            $giro = $this->input->post('giro');
            $localidad = $this->input->post('localidad');
            $representante = strtoupper($this->input->post('representante'));
            $gerente = strtoupper($this->input->post('gerente'));
            $comentario = strtoupper($this->input->post('comentarios'));
            $empresa1 = strtoupper($this->input->post('empresa1'));
            $empresa1telefono = $this->input->post('empresa1telefono');
            $empresa2 = strtoupper($this->input->post('empresa2'));
            $empresa2telefono = $this->input->post('empresa2telefono');
            $empresa3 = strtoupper($this->input->post('empresa3'));
            $empresa3telefono = $this->input->post('empresa3telefono');
            $empresa4 = strtoupper($this->input->post('empresa4'));
            $empresa4telefono = $this->input->post('empresa4telefono');
            $empresa5 = strtoupper($this->input->post('empresa5'));
            $empresa5telefono = $this->input->post('empresa5telefono');

            $parametros_datos_prospecto=array(
                        $this->session->prospecto,
                        $folio,
                        $tipoCliente,
                        $nombre,
                        $rfc,
                        $direccion,
                        $cp,
                        $colonia,
                        $ciudad,
                        $municipio,
                        $estado,
                        $telefono,
                        $email,
                        $giro,
                        $localidad,
                        $representante,
                        $gerente,
                        $comentario,
                        $empresa1,
                        $empresa1telefono,
                        $empresa2,
                        $empresa2telefono,
                        $empresa3,
                        $empresa3telefono,
                        $empresa4,
                        $empresa4telefono,
                        $empresa5,
                        $empresa5telefono
                        );

            $this->ProspectosModel->actualizarProspecto($parametros_datos_prospecto);
            redirect('prospectos');
        }

    }

    /**
     * Permite eliminar el prospecto capturado previamente siempre y cuando el status sea igual a "C" (captura) 
     * @return [null]
     */
    public function eliminarProspecto($idProspecto) {
        $this->ProspectosModel->eliminarProspecto($idProspecto);
        redirect('prospectos');
    }


    /**
     * permite convertir recursivamente todos los valores de un array al formato UTF8
     * @param  [array] $array [arreglo de datos que se desea convertir]
     * @return [array]        [mismo arreglo convertido a formato UTF8]
     */
    private function utf8_converter($array) {
        array_walk_recursive($array, function(&$item, $key){
            //la función mb_detect_encoding revisa si el valor ya esta en formato UTF8
            if(!mb_detect_encoding($item, 'utf-8', true)){
                    $item = utf8_encode($item);
                }
            });

        return $array;
    }

}

/* End of file ProspectosController.php */
/* Location: ./application/controllers/ProspectosController.php */