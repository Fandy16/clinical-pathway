<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Tambah_user extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_tambah_user');
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

	  	$this->_render('V_tambah_user', $data);

	}

	public function tabelDaftarNamaUser(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_tambah_user');

	    $query = $this->m_tambah_user->lihatDaftarUser();


	     $no = 1;
	    $data = array();
	    $aktif = array();
	    foreach($query->result() as $kolom){
	      // $aktif[] = $kolom->ADMIN;
	      if (($kolom->AKTIF)==true) {
	        $button = "<center><button class='btn btn-success btn-sm' style='width:85px;' type='button' onclick='simpanStatusUserAdmin(\"".$kolom->USRNAME."\")' id='status_aktif' name='status_aktif'>Aktif</button></center>";
	      }else if (($kolom->AKTIF)==false){
	        $button = "<center><button class='btn btn-danger btn-sm' style='width:85px;' type='button' onclick='simpanStatusUserAdmin(\"".$kolom->USRNAME."\")' id='status_aktif' name='status_aktif'>Tidak Aktif</button></center>";
	      }

	      $data[]       = array(

	        // "kosong"    =>'',
	        "no"        => "<center><span >" . $no++ . "</span></center>",
	        "NAMA"  	=> "<span>" .$kolom->NMUSER. "</span>",
	        "USERNAME"  => "<span>" .$kolom->USRNAME. "</span>",
	        "LEVEL"     => "<span><center>".$kolom->NMLVL." </center></span>",
	        "STATUS"    => $button,
	        "RESET"    	=> "<center>
	                      <button class='btn btn-warning btn-sm' type='button' onclick='resetPasswordUser(\"".$kolom->IDUSER."\", \"".$kolom->USRNAME."\")' name='btn_detail'><i class='fa fa-fw fa-lg fa-lg fa-cog fa-spin'></i>Reset Password</button>",  
	        // "kosong"    =>'',                 

	      );
	    }


	    $obj = array(
	      "data"  => $data
	    );
	    
	    echo json_encode($obj);
	      
  	}

  	public function simpanNamaUserAdminBaru() {

	    $this->load->library('session');
	    $this->load->model('m_tambah_user');
	    

	    $namaUser 	= $this->input->post('namaUser');
	    $username   = $this->input->post('username');
	    $password   = $this->input->post('password');

	    $level 		= $this->session->userdata("ses_level");
	    // $level       = 'admin';

	    $pass_encript = password_hash($password, PASSWORD_DEFAULT);


	    // var_dump($namaUser);
	    // var_dump($username);
	    // var_dump($pass_encript);
	    // var_dump($level);
	    // die();

	    $this->m_tambah_user->simpanUserBaru($username, $pass_encript, $namaUser, $level);

	      
  	}

  	public function resetPasswordUser() {

	    $this->load->library('session');
	    $this->load->model('m_tambah_user');
	    

	      $username = $this->input->post('username');
	      $id_user  = $this->input->post('id_user');
	      $level 	= $this->session->userdata("ses_level");
	      // $level    = 'admin';
	      $passBaru = password_hash('123456', PASSWORD_DEFAULT);

	      // var_dump($username);
	      // var_dump($id_user);
	      // var_dump($level);
	      // var_dump($passBaru);
	      // die();

	      $this->m_tambah_user->resetPasswordUser($passBaru, $level, $id_user, $username);

  	}
}