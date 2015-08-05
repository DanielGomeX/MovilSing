<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->helper(array('form'));
		$this->load->view('login');
	}

}

/* End of file LoginController.php */
/* Location: ./application/controllers/LoginController.php */
