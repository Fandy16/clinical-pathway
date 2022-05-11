<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Hasil_input_cp extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_hasil_input_cp');
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

	  	$this->_render('V_hasil_input_cp', $data);

	}

	public function tabelDaftarInputCP(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_hasil_input_cp');

	    $query = $this->m_hasil_input_cp->lihatHasilInputCP();


	     $no = 1;
	    $data = array();
	    $aktif = array();
	    foreach($query->result() as $kolom){
	      

	      $data[]       = array(

	        // "kosong"    =>'',
	        "no"        => "<center><span >" . $no++ . "</span></center>",
	        "NAMACP"  	=> "<span>" .$kolom->nmcp. "</span>",
	        "KELOMPOK"  => "<span>".$kolom->nmkelompok."</span>",
	        "DIAGNOSA"  => "<span>" .$kolom->nmdx. "</span>",
	        "HARI" 	    => "<span><center>".$kolom->hari." hari</center></span>",
	        "DETAIL"   	=> "<center><button class='btn bg-purple btn-xs' type='button' onclick='lihatDetailTindakan(\"".$kolom->nmcp."\", \"".$kolom->kdkel."\", \"".$kolom->dx1."\")' name='btn_detail'><i class='fa fa-search-plus'></i> Detail</button>",
	        // "kosong"    =>'',                 

	      );
	    }


	    $obj = array(
	      "data"  => $data
	    );
	    
	    echo json_encode($obj);
	      
  	}

  	public function tabelDaftarDetalInputCP(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_hasil_input_cp');

	    $nmcp  = $this->input->post('nama_cp');
	    $kdkel = $this->input->post('kdkel');
	    $dx    = $this->input->post('dx');

	    $query = $this->m_hasil_input_cp->lihatDetailInputCP($nmcp, $kdkel, $dx);


	     $no = 1;
	    $data = array();
	    $aktif = array();
	    foreach($query->result() as $kolom){
	      

	      $data[]       = array(

	        // "kosong"    =>'',
	        "no"       		=> "<center><span >" . $no++ . "</span></center>",
	        "TANGGAL" 		=> "<span><center>" .date('d-M-Y H:i:s', strtotime($kolom->tgl)). "</center></span>",
	        "NMTINDAKAN" 	=> "<span>" .$kolom->nmtind. "</span>",
	        "JUMLAH" 		=> "<span><center> ".number_format($kolom->jumlah)." </center></span>",
	        "HARI" 	    	=> "<span><center>".$kolom->hari_ke." </center></span>",
	        "KELAS1" 		=> "<span>Rp. ".number_format($kolom->biaya_kls1)." </span>",
	        "KELAS2" 		=> "<span>Rp. ".number_format($kolom->biaya_kls2)." </span>",
	        "KELAS3" 		=> "<span>Rp. ".number_format($kolom->biaya_kls3)." </span>",
	        // "kosong"    =>'',                 

	      );
	    }


	    $obj = array(
	      "data"  => $data
	    );
	    
	    echo json_encode($obj);
	      
  	}

  	
}