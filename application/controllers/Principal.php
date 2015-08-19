<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {

    function __construct() {
        parent::__construct();
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
        unset($_SESSION['pedido']);
        session_destroy();
        redirect('');
    }

}
