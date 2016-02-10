<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {

    function __construct() {
        parent::__construct();

        # cargamos la libreria para las validaciones
        $this->load->library('form_validation');
    }

    function index() {
        if($this->session->logged_in=="SI")
        {

            $datos['titulo']='Principal';
            $datos['vista']='principal';
            $this->load->view('plantillas/master_page',$datos);
        }
        else
        {
            //Si no existe inicio de sesion logeado, entonces se redirecciona a la página de login
           redirect('', 'refresh');
        }
    }

    function logout() {
        # cargamos el modelo que contiene el método requerido para el logout
        $this->load->model('GlobalModel');

        # ejecutamos consulta
        $respuesta = $this->GlobalModel->logout($this->session->usuario);

        unset($_SESSION['logged_in']);
        unset($_SESSION['usuario']);
        unset($_SESSION['cliente']);
        unset($_SESSION['nombre_cliente']);
        unset($_SESSION['pedido']);
        session_destroy();
        redirect('');
    }

    function salirPlanRuta() {
        unset($_SESSION['cliente']);
        unset($_SESSION['nombre_cliente']);
        unset($_SESSION['pedido']);
        redirect('principal');
    }

    public function Password(){

        if($this->session->logged_in=="SI")
        {
            $datos['titulo']='Cambiar Password';
            $datos['vista']='cambiar_password';
            $this->load->view('plantillas/master_page',$datos);
        }
        else
        {
            //Si no existe inicio de sesion logeado, entonces se redirecciona a la página de login
           redirect('', 'refresh');
        }
    }

    public function cambiarPassword(){

        $this->load->Model('GlobalModel');

        $datos['titulo']='Cambiar Password';
        $datos['vista']='cambiar_password';


        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        # establecemos las reglas de validación requeridas
        $this->form_validation->set_rules('nuevoPassword', 'Nuevo Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirmarPassword', 'Confirmar Password', 'trim|required|min_length[6]|matches[nuevoPassword]');

        if($this->form_validation->run() == FALSE)
        {
            # No se cumple con la(s) validación(es) requerida(s), se redirecciona nuevamente a la página de login
            $this->load->view('plantillas/master_page',$datos);
        }
        else
        {

            $usuario=$this->session->usuario;
            $password= $this->input->post('nuevoPassword');

            $respuesta=$this->GlobalModel->cambiarPassword($usuario, $password);

            if ($respuesta==1) {
                $datos['vista'] = 'errors/aviso';
                $datos['mensaje']='Tu password ha sido cambiado correctamente, el cambio tendrá efecto la próxima vez que inicies sesión.';
                $datos['link_regresar'] = 'principal';
                $this->load->view('plantillas/master_page', $datos);
            }
            else{
                $datos['mensaje']="Ocurrio un error al tratar de registrar el producto para devolución.";
                $datos['vista'] = 'errors/error';
                $this->load->view('plantillas/master_page', $datos);
            }


        }

    }



}
