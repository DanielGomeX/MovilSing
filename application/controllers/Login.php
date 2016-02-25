<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
    # cargamos el modelo para la autenticación
		$this->load->model('GlobalModel');
	}

  /**
   * Permite el acceso a la aplicación en caso de una autenticación válida
   * @return
   */
  function index() {

    # cargamos la libreria para las validaciones
    $this->load->library('form_validation');

    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    # establecemos las reglas de validación requeridas
    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
    //$this->form_validation->set_rules('password', 'Password', 'trim|required');

    if($this->form_validation->run() == FALSE)
    {
      # No se cumple con la(s) validación(es) requerida(s), se redirecciona nuevamente a la página de login
      $this->load->view('login');
    }
    else
    {
      # Verificamos que previamente NO EXISTA una variable de sesion usuario, de ser así, entonces la creamos
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

  /**
   * Permite validar las credenciales de autenticación contra la base de datos
   * @param  [string] $password
   * @return [bool]   [retorna un true en caso de que el codigo de error encontrado sea 0 y un false si el codigo es diferente de cero]
   */
  function check_database($password) {

    $username = $this->input->post('username');

    //ejecutamos la consulta a la BD
    $respuesta = $this->GlobalModel->login($username, $password);

    #obtenemos los valores de los campos de la respuesta
    $codigo=$respuesta[0]['codigo'];
    $mensaje=$respuesta[0]['mensaje'];

    #si el código de la respuesta es 0, significa que se ha logeado correctamente en la BD
    if ($codigo==0) {
      return TRUE;
    }
    else {
      #caso contrario, mostramos el mensaje de error
      $this->form_validation->set_message('check_database', $mensaje);
      return false;
    }
  }


}

/* End of file LoginController.php */
/* Location: ./application/controllers/LoginController.php */
