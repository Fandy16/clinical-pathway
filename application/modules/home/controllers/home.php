<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('');
		// $this->load->model(array(''));
		$this->load->database();
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email', 'encryption'));
		$this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
	}

	private function _render($view, $data)
	{

		$this->load->view('head', $data);
	    $this->load->view('sidebar');
		$this->load->view('header');
	    $this->load->view($view);
	    $this->load->view('footer');
	}

	public function index()
	{

	  	$data['']='';

	  	$this->_render('V_home', $data);

	}
 
    // public function index()
    // {
    //     $this->load->view('homepage/view_homepage');
    // }
}