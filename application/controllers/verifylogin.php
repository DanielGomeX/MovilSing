<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

   function __construct() {

     parent::__construct();
   }

    //This method will have the credentials validation
   function index() {

     #cargamos la libreria para las validaciones
     $this->load->library('form_validation');

     #establecemos las reglas de validación requeridas
     $this->form_validation->set_rules('username', 'Username', 'trim|required');
     #$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
     $this->form_validation->set_rules('password', 'Password', 'trim|required');


     if($this->form_validation->run() == FALSE)
     {
       #No se cumple con la(s) validación(es) requerida(s), se redirecciona nuevamente a la página de login
       $this->load->view('login');
     }
     else
     {

        #Si NO EXISTE previamente una variable de sesion usuario, entonces la creamos
        if (!isset($_SESSION['usuario'])) {
          $_SESSION['logged_in']='SI';
          $_SESSION['usuario']=$this->input->post('username');

         //Entramos a la aplicación
         redirect('principal', 'refresh');
        }
        else{
          #Si ya xiste la variable de sesion usuario, se redirecciona nuevamente a la página de login
          $this->load->view('login');
        }

     }
   }

   #Por implementar
   function check_database($password) {

     //Field validation succeeded.  Validate against database
     $username = $this->input->post('username');

     //query the database
     $result = $this->user->login($username, $password);

     if($result)
     {
       $sess_array = array();
       foreach($result as $row)
       {
         $sess_array = array(
           'id' => $row->id,
           'username' => $row->username
         );
         $this->session->set_userdata('logged_in', $sess_array);
       }
       return TRUE;
     }
     else
     {
       $this->form_validation->set_message('check_database', 'Invalid username or password');
       return false;
     }
   }


}
