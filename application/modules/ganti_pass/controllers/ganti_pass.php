<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ganti_pass extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('');
		// $this->load->model('m_ganti_pass');
		// $this->load->model(array(''));
		$this->load->database();
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email', 'encryption'));
		$this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
	}

	private function _render($view, $data)
	{

		$this->load->view('head', $data);
	    $this->load->view($view);
	}

	public function index(){

        redirect(base_url()."ganti_pass/form");

    }

	public function form(){

        $data = '';
        $this->load->library('session');
        $this->_render('v_ganti_pass', $data);

    }
    
    public function updatePass() {

    	$uri =& load_class('URI', 'core');
		$this->load->library('session');
		$this->load->library('encryption');
		$this->load->model('m_ganti_pass');

		// $noinduk = $_SESSION["ses_nomorinduk"];

		$username 	= $this->session->userdata('ses_username');
        $passLama   = $this->input->post('pass_lama');
        $passBaru   = $this->input->post('pass_baru');

        $pass_lama_encript = password_hash($passLama, PASSWORD_DEFAULT);
	    $pass_baru_encript = password_hash($passBaru, PASSWORD_DEFAULT);

  //       var_dump($username);
  //       var_dump($pass_baru_encript);
  //       var_dump($pass_lama_encript);
		// die();

        $this->m_ganti_pass->ganti_pass($pass_baru_encript, $pass_lama_encript, $username);

        redirect(base_url()."login/form"); 

    }

}
