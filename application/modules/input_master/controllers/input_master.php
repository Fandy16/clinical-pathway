<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Input_master extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_input_master');
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

	  	$this->_render('V_input_master', $data);

	}

	public function tabelDaftarMasterTindakan(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_master');

	    $query = $this->m_input_master->lihatDaftarTindakan();


	    $no = 1;
	    $data = array();
	    $aktif = array();
	    foreach($query->result() as $kolom){
	      

	      $data[]       = array(

	        // "kosong"    =>'',
	        "no"        => "<center><span >" . $no++ . "</span></center>",
	        "NAMAKEL"  	=> "<span>" .$kolom->nmkelompok. "</span>",
	        "NAMATIND"  => "<span>" .$kolom->nmtind. "</span>",
	        "DETAIL"    => "<center><button class='btn bg-purple btn-sm' type='button' onclick='detailHasilInputan(\"".$kolom->idtind."\", \"".$kolom->kdtind."\", \"".$kolom->nmkelompok."\")'><i class='fa fa-lg fa-check'></i> detail</button>",
	        "EDIT"    	=> "<center><button class='btn bg-orange btn-sm' type='button' onclick='editHasilInputan(\"".$kolom->idtind."\", \"".$kolom->kdtind."\", \"".$kolom->nmtind."\", \"".$kolom->kdkel."\", \"".$kolom->nmkelompok."\")'><i class='fa fa-lg fa-edit'></i> Ubah</button>",
	        "HAPUS"    => "<center><button class='btn bg-maroon btn-sm' type='button' onclick='hapusHasilInputan(\"".$kolom->idtind."\", \"".$kolom->kdtind."\", \"".$kolom->kdkel."\")'><i class='fa fa-lg fa-close'></i> Hapus</button>"

	      );
	    }


	    $obj = array(
	      "data"  => $data
	    );
	    
	    echo json_encode($obj);
	      
  	}

  	public function tabelDaftarMasterKelompok(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_master');

	    $query = $this->m_input_master->lihatMasterKelompok();


	    $no = 1;
	    $data = array();
	    $aktif = array();
	    foreach($query->result() as $kolom){
	      

	      $data[]       = array(

	        // "kosong"    =>'',
	        "no"        => "<center><span >" . $no++ . "</span></center>",
	        "NAMAKEL"  	=> "<span>" .$kolom->nmkelompok. "</span>",
	        "TANGGAL"   => "<center><span>" .date('d-M-Y H:i:s', strtotime($kolom->tgl)). "</span></center>",
	        "EDIT"    	=> "<center><button class='btn bg-orange btn-sm' type='button' onclick='editMasterKelompok(\"".$kolom->kdkel."\", \"".$kolom->nmkelompok."\")'><i class='fa fa-lg fa-edit'></i> Ubah</button>",
	        "HAPUS"    => "<center><button class='btn bg-maroon btn-sm' type='button' onclick='hapusMasterKelompokBaru(\"".$kolom->kdkel."\")'><i class='fa fa-lg fa-close'></i> Hapus</button>"

	      );
	    }


	    $obj = array(
	      "data"  => $data
	    );
	    
	    echo json_encode($obj);
	      
  	}

  	public function pilih_nama_kelompok() {

      	$query = $this->m_input_master->lihatMasterKelompok();

	    ?>

	    <option value=""> -pilih nama Kelompok- </option>
	    <?php foreach ($query->result() as $kolom): ?>
	        <option value="<?php echo $kolom->kdkel ?>"> <?php echo $kolom->nmkelompok ?> </option>
	    <?php endforeach ?>

	    <?php

  	}

  	public function tabelDaftarMasterTindakanDetail(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_master');

	    $idtind 	= $this->input->post('id_tindakan');
	    $kdtind 	= $this->input->post('kd_tindakan');


	    $query = $this->m_input_master->lihatDaftarTindakanDetail($idtind, $kdtind);


	    $no = 1;
	    $data = array();
	    $aktif = array();
	    foreach($query->result() as $kolom){
	      

	      $data[]       = array(

	        // "kosong"    =>'',
	        "no"        => "<center><span >" . $no++ . "</span></center>",
	        "NAMATIND"  => "<span>" .$kolom->nmtind. "</span>",
	        "KELAS"  	=> "<span><center>" .$kolom->kdkelas. "</center></span>",
	        "BIAYA"  	=> "<span><center>Rp. " .number_format($kolom->biaya). "</center></span>",

	      );
	    }


	    $obj = array(
	      "data"  => $data
	    );
	    
	    echo json_encode($obj);
	      
  	}

  	public function lihatBiayaKelas1Edit(){

		$uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_master');

	    $idtind 	= $this->input->post('idTindakan');
	    $kdtind 	= $this->input->post('kdTindakan');


	    $query = $this->m_input_master->lihatDaftarDetailBiayaPerKelas($idtind, $kdtind, '1');

		// var_dump($idkomp);
		// die();

		$biaya1 = 0;

	  	foreach ($query->result() as $kolom) {
	  		$biaya1 = $kolom->biaya;
	  	}

      		echo $biaya1;

  		// var_dump(number_format($biaya1));
		// die();

	}

	public function lihatBiayaKelas2Edit(){

		$uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_master');

	    $idtind 	= $this->input->post('idTindakan');
	    $kdtind 	= $this->input->post('kdTindakan');


	    $query = $this->m_input_master->lihatDaftarDetailBiayaPerKelas($idtind, $kdtind, '2');

		// var_dump($idkomp);
		// die();

		$biaya2 = 0;

	  	foreach ($query->result() as $kolom) {
	  		$biaya2 = $kolom->biaya;
	  	}

      		echo $biaya2;

  		// var_dump(number_format($biaya2));
		// die();

	}

	public function lihatBiayaKelas3Edit(){

		$uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_master');

	    $idtind 	= $this->input->post('idTindakan');
	    $kdtind 	= $this->input->post('kdTindakan');


	    $query = $this->m_input_master->lihatDaftarDetailBiayaPerKelas($idtind, $kdtind, '3');

		// var_dump($idkomp);
		// die();

		$biaya3 = 0;

	  	foreach ($query->result() as $kolom) {
	  		$biaya3 = $kolom->biaya;
	  	}

      		echo $biaya3;

  		// var_dump(number_format($biaya1));
		// die();

	}

	public function lihatIdTindakanByKelas1Edit(){

		$uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_master');

	    $idtind 	= $this->input->post('idTindakan');
	    $kdtind 	= $this->input->post('kdTindakan');


	    $query = $this->m_input_master->lihatDaftarDetailBiayaPerKelas($idtind, $kdtind, '1');

		// var_dump($idkomp);
		// die();

		$idTindBy1 = 0;

	  	foreach ($query->result() as $kolom) {
	  		$idTindBy1 = $kolom->idtindby;
	  	}

      		echo $idTindBy1;

  		// var_dump(number_format($idTindBy1));
		// die();

	}

	public function lihatIdTindakanByKelas2Edit(){

		$uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_master');

	    $idtind 	= $this->input->post('idTindakan');
	    $kdtind 	= $this->input->post('kdTindakan');


	    $query = $this->m_input_master->lihatDaftarDetailBiayaPerKelas($idtind, $kdtind, '2');

		// var_dump($idkomp);
		// die();

		$idTindBy2 = 0;

	  	foreach ($query->result() as $kolom) {
	  		$idTindBy2 = $kolom->idtindby;
	  	}

      		echo $idTindBy2;

  		// var_dump(number_format($idTindBy1));
		// die();

	}

	public function lihatIdTindakanByKelas3Edit(){

		$uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_master');

	    $idtind 	= $this->input->post('idTindakan');
	    $kdtind 	= $this->input->post('kdTindakan');


	    $query = $this->m_input_master->lihatDaftarDetailBiayaPerKelas($idtind, $kdtind, '3');

		// var_dump($idkomp);
		// die();

		$idTindBy3 = 0;

	  	foreach ($query->result() as $kolom) {
	  		$idTindBy3 = $kolom->idtindby;
	  	}

      		echo $idTindBy3;

  		// var_dump(number_format($idTindBy1));
		// die();

	}

  	public function simpanMasterTindakanBaru() {

	    $this->load->library('session');
	    $this->load->model('m_input_master');
	    

	    $kdkel 	= $this->input->post('nmKelompok');
	    $nmtind = $this->input->post('namaTindakan');
	    $level 	= $this->session->userdata("ses_nama");


	    $query = $this->m_input_master->lihatKodeTindakanTrakhir();

	    $tind = "";
	    $kodetind = "";

	  	foreach ($query->result() as $kolom) {
	  		$tind = $kolom->kdtind;
	  	}

      	$kodetind = $tind + "1";

	    // var_dump($kdkel);
	    // var_dump($tind);
	    // var_dump($kodetind);
	    // var_dump($nmtind);
	    // var_dump($level);
	    // die();

	    $this->m_input_master->simpanMasterTindakan($kdkel, $kodetind, $nmtind, $level);

	    echo $kodetind;

  	}

  	public function simpanMasterTindakanByBaru() {

	    $this->load->library('session');
	    $this->load->model('m_input_master');

	    $kdtind 	 = $this->input->post('kode_tind');
	    $biayaKelas1 = $this->input->post('biayaKelas1');
	    $biayaKelas2 = $this->input->post('biayaKelas2');
	    $biayaKelas3 = $this->input->post('biayaKelas3');
	    $level 		 = $this->session->userdata("ses_nama");


	    // var_dump($kdtind);
	    // var_dump($biayaKelas1);
	    // var_dump($biayaKelas2);
	    // var_dump($biayaKelas3);
	    // var_dump($level);
	    // die();

	    $this->m_input_master->simpanMasterTindakanBy($kdtind, '1', $biayaKelas1, $level);
	    $this->m_input_master->simpanMasterTindakanBy($kdtind, '2', $biayaKelas2, $level);
	    $this->m_input_master->simpanMasterTindakanBy($kdtind, '3', $biayaKelas3, $level);

  	}

  	public function updateMasterTindakanEdit() {

	    $this->load->library('session');
	    $this->load->model('m_input_master');
	    

	    $idtind = $this->input->post('id_tindakan_edit');
	    $kdkel  = $this->input->post('kd_kelompok_edit');
	    $kdtind = $this->input->post('kd_tindakan_edit');
	    $nmtind = $this->input->post('namaTindakanEdit');


	    // var_dump($idtind);
	    // var_dump($kdkel);
	    // var_dump($kdtind);
	    // var_dump($nmtind);
	    // die();

	    $this->m_input_master->updateMasterTindakan($idtind, $kdkel, $kdtind, $nmtind);

  	}

  	public function updateMasterTindakanByEdit() {

	    $this->load->library('session');
	    $this->load->model('m_input_master');
	    
	    $kdtind 	 = $this->input->post('kd_tindakan_edit');;
	    $idtindby1 	 = $this->input->post('id_tindBy_edit1');
	    $idtindby2 	 = $this->input->post('id_tindBy_edit2');
	    $idtindby3 	 = $this->input->post('id_tindBy_edit3');
	    $biayaKelasEdit1 = $this->input->post('biayaKelasEdit1');
	    $biayaKelasEdit2 = $this->input->post('biayaKelasEdit2');
	    $biayaKelasEdit3 = $this->input->post('biayaKelasEdit3');


	    // var_dump($idtindby1);
	    // var_dump($idtindby2);
	    // var_dump($idtindby3);
	    // var_dump($biayaKelasEdit1);
	    // var_dump($biayaKelasEdit2);
	    // var_dump($biayaKelasEdit3);
	    // var_dump($kdtind);
	    // die();

	    $this->m_input_master->updateMasterTindakanBy($idtindby1, $kdtind, '1', $biayaKelasEdit1);
	    $this->m_input_master->updateMasterTindakanBy($idtindby2, $kdtind, '2', $biayaKelasEdit2);
	    $this->m_input_master->updateMasterTindakanBy($idtindby3, $kdtind, '3', $biayaKelasEdit3);

  	}

  	public function hapusMasterTindakan() {

	    $this->load->library('session');
	    $this->load->model('m_input_master');
	    

	    $idtind = $this->input->post('idtind');
	    $kdtind = $this->input->post('kdtind');
	    $kdkel  = $this->input->post('kdkel');
	    $idtindby1 = $this->input->post('id_tindBy_edit1');
	    $idtindby2 = $this->input->post('id_tindBy_edit2');
	    $idtindby3 = $this->input->post('id_tindBy_edit3');


	    // var_dump($idtind);
	    // var_dump($kdtind);
	    // var_dump($kdkel);
	    // var_dump($idtindby1);
	    // var_dump($idtindby2);
	    // var_dump($idtindby3);
	    // die();

	    $this->m_input_master->hapusMasterKelompok($kdkel);
	    $this->m_input_master->hapusMasterTindakan($idtind, $kdtind, $kdkel);
	    $this->m_input_master->hapusMasterTindakanBy($idtindby1, $kdtind, '1');
	    $this->m_input_master->hapusMasterTindakanBy($idtindby2, $kdtind, '2');
	    $this->m_input_master->hapusMasterTindakanBy($idtindby3, $kdtind, '3');

  	}

  	public function simpanMasterKelompokBaru() {

	    $this->load->library('session');
	    $this->load->model('m_input_master');
	    

	    $nmkelompok = $this->input->post('namaKelBaru');
	    $level 		= $this->session->userdata("ses_nama");


	    // var_dump($nmkelompok);
	    // var_dump($level);
	    // die();

	    $this->m_input_master->simpanMasterKelompok($nmkelompok, $level);

  	}

  	public function updateMasterKelompokedit() {

	    $this->load->library('session');
	    $this->load->model('m_input_master');
	    

	    $kdkel 		= $this->input->post('kd_kelompok_edit');
	    $nmkelompok = $this->input->post('nmKelompokEdit');
	    $level 		= $this->session->userdata("ses_nama");


	    // var_dump($kdkel);
	    // var_dump($nmkelompok);
	    // var_dump($level);
	    // die();

	    $this->m_input_master->updateMasterKelompok($kdkel, $nmkelompok, $level);

  	}

  	public function hapusMasterKelompok() {

	    $this->load->library('session');
	    $this->load->model('m_input_master');
	    

	    $kdkel 		= $this->input->post('kdkel');

	    // var_dump($kdkel);
	    // var_dump($nmkelompok);
	    // var_dump($level);
	    // die();

	    $this->m_input_master->hapusMasterKelompok($kdkel);;

  	}

}