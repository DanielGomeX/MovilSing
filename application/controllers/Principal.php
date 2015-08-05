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
            //If no session, redirect to login page
           redirect('', 'refresh');
        }
    }

    function logout() {
        //$this->session->unset_userdata('logged_in');
        unset($_SESSION['logged_in']);
        unset($_SESSION['usuario']);
        unset($_SESSION['cliente']);
        unset($_SESSION['pedido']);
        session_destroy();
        redirect('');
    }

}
