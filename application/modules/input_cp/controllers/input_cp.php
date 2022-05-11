<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Input_cp extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_input_cp');
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

	  	$data['lihatDaftarKelompokEdit'] = $this->m_input_cp->lihatDaftarKelompok();
	  	$data['lihatDaftarTindakanEdit'] = $this->m_input_cp->lihatDaftarTindakanEdit();

	  	$data['ambilDataDiagHasilEdit'] = $this->m_input_cp->lihatDaftarDiagnosa();
	  	$data['ambilDataKelHasilEdit'] = $this->m_input_cp->lihatDaftarKelompok();
	  	$data['ambilDataTindHasilEdit'] = $this->m_input_cp->lihatDaftarTindakanEdit();

	  	$this->_render('V_input_cp', $data);

	}

	public function pilih_nama_diagnosa() {

	    $query = $this->m_input_cp->lihatDaftarDiagnosa();

	    ?>

	    <option value=""> -pilih kode / nama diagnosa- </option>
	    <?php foreach ($query->result() as $kolom): ?>
	        <option value="<?php echo $kolom->nm_diag ?>"> <?php echo $kolom->nm_diag ?> </option>
	    <?php endforeach ?>

	    <?php

  	}

  	
  	public function pilih_nama_kelompok() {

      	$query = $this->m_input_cp->lihatDaftarKelompok();

	    ?>

	    <option value=""> -pilih nama Kelompok- </option>
	    <?php foreach ($query->result() as $kolom): ?>
	        <option value="<?php echo $kolom->kdkel ?>"> <?php echo $kolom->nmkelompok ?> </option>
	    <?php endforeach ?>

	    <?php

  	}

  	public function pilih_nama_tindakan() {

  		$kdkel = $this->input->post('pilihKelompok');

      	$query = $this->m_input_cp->lihatDaftarTindakan($kdkel);

	    ?>

	    <option value=""> -pilih nama tindakan- </option>
	    <?php foreach ($query->result() as $kolom): ?>
	        <option value="<?php echo $kolom->kdtind ?>"> <?php echo $kolom->nmtind ?> </option>
	    <?php endforeach ?>

	    <?php

  	}

  	public function ambil_biaya_tindakan() {

  		$kdtind 	= $this->input->post('pilihTindakan');
	    $kdkelas   	= $this->input->post('kelasPerawatan');

      	$query = $this->m_input_cp->ambilBiayaTindakan($kdtind, $kdkelas);

      	
      	$biaya_tindakan = 0;

	  	foreach ($query->result() as $kolom) {
	  		$biaya_tindakan = $kolom->biaya;
	  	}

      	if ($kdtind == null || $kdkelas == null) {
      		echo "0";
      	} else {
      		echo $biaya_tindakan;
      	}

  	}

  	public function simpanInputTindakanCP() {

	    $this->load->library('session');
	    $this->load->model('m_input_cp');
	    

	    $nama_cp   	= $this->input->post('namaCP');
	    $inputDx   	= $this->input->post('pilihDiagnosa');
	    $hari   	= $this->input->post('lamaPerawatan');
	    $kdkel   	= $this->input->post('pilihKelompok');
	    $kdtin  	= $this->input->post('pilihTindakan');
	    $hari_ke   	= $this->input->post('jml_hari');
	    $jumlah   	= $this->input->post('jml_tindakan');
	    $idkomp		= $this->input->post('ip_komputer');
	    $level 		= $this->session->userdata("ses_nama");


	    // $query = $this->m_input_cp->ambilNamaDiag($dx);
	    $dx = "";
	    $nmdx = "";
	    $dx = substr($inputDx, 0, 5);
	    $nmdx = substr($inputDx, 11);


	    $query_kelas1 = $this->m_input_cp->ambilBiayaTindakan($kdtin, '1');
      	$biaya_tind_kelas1 = 0;
	  	foreach ($query_kelas1->result() as $kolom) {
	  		$biaya_tind_kelas1 = $kolom->biaya;
	  	}

	  	$query_kelas2 = $this->m_input_cp->ambilBiayaTindakan($kdtin, '2');
      	$biaya_tind_kelas2 = 0;
	  	foreach ($query_kelas2->result() as $kolom) {
	  		$biaya_tind_kelas2 = $kolom->biaya;
	  	}

	  	$query_kelas3 = $this->m_input_cp->ambilBiayaTindakan($kdtin, '3');
      	$biaya_tind_kelas3 = 0;
	  	foreach ($query_kelas3->result() as $kolom) {
	  		$biaya_tind_kelas3 = $kolom->biaya;
	  	}

	    $kelas1 = $biaya_tind_kelas1 * $jumlah;
	    $kelas2 = $biaya_tind_kelas2 * $jumlah;
	    $kelas3 = $biaya_tind_kelas3 * $jumlah;


	    // var_dump($kdtin);
	    // var_dump($kdkel);
	    // var_dump($nama_cp);
	    // var_dump($hari);
	    // var_dump($hari_ke);
	    // var_dump($dx);
	    // var_dump($nmdx);
	    // var_dump($jumlah);
	    // var_dump($kelas1);
	    // var_dump($kelas2);
	    // var_dump($kelas3);
	    // var_dump($idkomp);
	    // var_dump($level);
	    // die();

	    $this->m_input_cp->simpanInputanCP($kdtin, $kdkel, $nama_cp, $hari, $hari_ke, $dx, $nmdx, $jumlah, $kelas1, $kelas2, $kelas3, $idkomp, $level);
	      
  	}

  	public function simpanUpdateTindakanCP() {

	    $this->load->library('session');
	    $this->load->model('m_input_cp');

	    $noidtmp    = $this->input->post('idInputEdit');
	    $kdtin  	= $this->input->post('pilihTindakanEdit');
	    $kdkel   	= $this->input->post('pilihKelompokEdit');
	    $hari_ke   	= $this->input->post('jmlHariEdit');
	    $jumlah   	= $this->input->post('jmlTindakanEdit');
	    $idkomp		= $this->input->post('ip_komputer');
	    $level 		= $this->input->post('levelEdit');

	    $query_kelas1 = $this->m_input_cp->ambilBiayaTindakan($kdtin, '1');
      	$biaya_tind_kelas1 = 0;
	  	foreach ($query_kelas1->result() as $kolom) {
	  		$biaya_tind_kelas1 = $kolom->biaya;
	  	}

	  	$query_kelas2 = $this->m_input_cp->ambilBiayaTindakan($kdtin, '2');
      	$biaya_tind_kelas2 = 0;
	  	foreach ($query_kelas2->result() as $kolom) {
	  		$biaya_tind_kelas2 = $kolom->biaya;
	  	}

	  	$query_kelas3 = $this->m_input_cp->ambilBiayaTindakan($kdtin, '3');
      	$biaya_tind_kelas3 = 0;
	  	foreach ($query_kelas3->result() as $kolom) {
	  		$biaya_tind_kelas3 = $kolom->biaya;
	  	}

	    $kelas1 = $biaya_tind_kelas1 * $jumlah;
	    $kelas2 = $biaya_tind_kelas2 * $jumlah;
	    $kelas3 = $biaya_tind_kelas3 * $jumlah;


	    // var_dump($noidtmp);
	    // var_dump($kdtin);
	    // var_dump($kdkel);
	    // var_dump($hari_ke);
	    // var_dump($jumlah);
	    // var_dump($kelas1);
	    // var_dump($kelas2);
	    // var_dump($kelas3);
	    // var_dump($idkomp);
	    // var_dump($level);
	    // die();

	    $this->m_input_cp->updateInputanCP($noidtmp, $kdtin, $kdkel, $hari_ke, $jumlah, $kelas1, $kelas2, $kelas3, $idkomp, $level);
	      
  	}

  	public function tabelDaftarInputCP(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');

	    $idkomp	= $this->input->post('ip_komputer');
	    $level 	= $this->session->userdata("ses_nama");

	    $query  = $this->m_input_cp->lihatDaftarInputan($idkomp, $level);


	    $no = 1;
	    $data = array();
	    $aktif = array();
	    foreach($query->result() as $kolom){
	     

	      $data[]       = array(

	        // "kosong"    =>'',
	        "no"        => "<center><span >" . $no++ . "</span></center>",
	        "KELOMPOK" 	=> "<span>" .$kolom->nmkelompok. "</span>",
	        "TINDAKAN"  => "<span>" .$kolom->nmtind. "</span>",
	        "HARIKE"    => "<span><center>".$kolom->hari." </center></span>",
	        "JUMLAH"    => "<span><center>".number_format($kolom->jumlah)." </center></span>",
	        "KELAS1"     => "<span>".number_format($kolom->kelas1)." </span>",
	        "KELAS2"     => "<span>".number_format($kolom->kelas2)." </span>",
	        "KELAS3"     => "<span>".number_format($kolom->kelas3)." </span>",
	        "EDIT"    	=> "<center><button class='btn bg-orange btn-sm' type='button' onclick='editHasilInputan(\"".$kolom->noidtmp."\", \"".date("Y-m-d H:s:i", strtotime($kolom->tgl))."\", \"".$level."\", \"".$kolom->kdkel."\", \"".$kolom->kdtin."\", \"".$kolom->hari."\", \"".$kolom->hari_ke."\", \"".number_format($kolom->jumlah)."\")'><i class='fa fa-lg fa-edit'></i></button>",
	        "HAPUS"    	=> "<center><button class='btn bg-maroon btn-sm' type='button' onclick='hapusHasilInputan(\"".$kolom->noidtmp."\", \"".$kolom->tgl."\", \"".$level."\")'><i class='fa fa-lg fa-close'></i></button>"
	        // "kosong"    =>'',                 


	      );
	    }


	    $obj = array(
	      "data"  => $data
	    );
	    
	    echo json_encode($obj);
	      
  	}

  	public function totalBiayaTindakanCPKelas1(){

		$uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');

	    $idkomp	= $this->input->post('ip_komputer');
	    $level 	= $this->session->userdata("ses_nama");

	    $query  = $this->m_input_cp->lihatDaftarInputan($idkomp, $level);

		// var_dump($idkomp);
		// die();

		$tot_biaya_kelas1 = 0;
		$jml = 0;

	  	foreach ($query->result() as $kolom) {
	  		$jml = $kolom->jumlah;
	  		$tot_biaya_kelas1 += $kolom->kelas1;
	  	}

		if ($jml == 0) {
      		echo 0;
      	} else {
      		echo "Rp. " .number_format($tot_biaya_kelas1,2,',','.');
      	}

  //     	 	var_dump(number_format($tot_biaya_kelas1));
		// die();

	}

	public function totalBiayaTindakanCPKelas2(){

		$uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');

	    $idkomp	= $this->input->post('ip_komputer');
	    $level 	= $this->session->userdata("ses_nama");

	    $query  = $this->m_input_cp->lihatDaftarInputan($idkomp, $level);

		// var_dump($idkomp);
		// die();

		$tot_biaya_kelas2 = 0;
		$jml = 0;

	  	foreach ($query->result() as $kolom) {
	  		$jml = $kolom->jumlah;
	  		$tot_biaya_kelas2 += $kolom->kelas2;
	  	}

		if ($jml == 0) {
      		echo 0;
      	} else {
      		echo "Rp. " .number_format($tot_biaya_kelas2,2,',','.');
      	}

	}

	public function totalBiayaTindakanCPKelas3(){

		$uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');

	    $idkomp	= $this->input->post('ip_komputer');
	    $level 	= $this->session->userdata("ses_nama");

	    $query  = $this->m_input_cp->lihatDaftarInputan($idkomp, $level);

		// var_dump($idkomp);
		// die();

		$tot_biaya_kelas3 = 0;
		$jml = 0;

	  	foreach ($query->result() as $kolom) {
	  		$jml = $kolom->jumlah;
	  		$tot_biaya_kelas3 += $kolom->kelas3;
	  	}

		if ($jml == 0) {
      		echo 0;
      	} else {
      		echo "Rp. " .number_format($tot_biaya_kelas3,2,',','.');
      	}

	}

	public function hapusDataInputTindakan(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');
	    
	    $noidtmp 	= $this->input->post('id_inp');
	    $tgl    	= $this->input->post('tgl_inp');
	    $level 		= $this->session->userdata("ses_nama");

	 //    var_dump($noidtmp);
	 //    var_dump($tgl);
	 //    var_dump($level);
		// die();

	    $query  = $this->m_input_cp->hapusHasilInputan($noidtmp, $tgl, $level);


	}

	public function hapusDataInputTindakanAll(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');
	    
	    $idkomp	= $this->input->post('ip_komputer');
	    $tgl 	= date('Y-m-d');
	    $level 	= $this->session->userdata("ses_nama");

	 //    var_dump($tgl);
		// die();

	    $query  = $this->m_input_cp->hapusHasilInputanAll($idkomp, $level);


	}

	public function simpanDataInputTindakankeTabelCP(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');
	    
	    $idkomp	= $this->input->post('ip_komputer');
	    $tgl 	= date('Y-m-d');
	    $level 	= $this->session->userdata("ses_nama");

	 //    var_dump($idkomp);
	 //    var_dump($tgl);
	 //    var_dump($level);
		// die();

	    $query  = $this->m_input_cp->simpanHasilInputanKeTabelCP($idkomp, $tgl, $level);


	}

	public function simpanDataInputTindakankeTabelDetailCP(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');
	    
	    $idkomp	= $this->input->post('ip_komputer');
	    $tgl 	= date('Y-m-d');
	    $level 	= $this->session->userdata("ses_nama");

	 // 	var_dump($idkomp);
	 //    var_dump($tgl);
	 //    var_dump($level);
		// die();

	    $query  = $this->m_input_cp->simpanHasilInputanKeTabelDetailCP($idkomp, $tgl, $level);


	}


	public function tabelHasilInputCP(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');

	    $level 	= $this->session->userdata("ses_nama");

	    $query = $this->m_input_cp->lihatHasilInputCP($level);


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
	        "DETAIL"   	=> "<center><button class='btn bg-orange btn-xs' type='button' onclick='editDetailTindNamaCP(\"".$kolom->nmcp."\", \"".$kolom->kdkel."\", \"".$kolom->nmkelompok."\", \"".$kolom->dx1."\", \"".$kolom->nmdx."\")' name='btn_detail'><i class='fa fa-pencil'></i> Edit</button>",
	        "HAPUS"   	=> "<center><button class='btn bg-maroon btn-xs' type='button' onclick='hapusDetailTindCP(\"".date('Y-m-d', strtotime($kolom->tgl))."\", \"".$kolom->nmcp."\", \"".$kolom->dx1."\")' name='btn_hapus'><i class='fa fa-trash-o'></i> Hapus</button>",
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
	    $this->load->model('m_input_cp');

	    $nmcp  = $this->input->post('nama_cp');
	    $kdkel = $this->input->post('kdkel');
	    $dx    = $this->input->post('dx');

	    $query = $this->m_input_cp->lihatDetailInputCP($nmcp, $kdkel, $dx);


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
	        "EDIT"   	=> "<center><button class='btn bg-orange btn-xs' type='button' onclick='editSubDetailTindakan(\"".$kolom->noid."\",\"".$kolom->kdcp."\", \"".$kolom->kdkel."\", \"".$kolom->kdtind."\", \"".$kolom->hari."\", \"".$kolom->hari_ke."\", \"".$kolom->jumlah."\", \"".number_format($kolom->biaya_kls1)."\", \"".number_format($kolom->biaya_kls2)."\", \"".number_format($kolom->biaya_kls3)."\")' name='btn_detail'><i class='fa fa-pencil'></i> Edit</button>",
	        // "kosong"    =>'',                 

	      );
	    }


	    $obj = array(
	      "data"  => $data
	    );
	    
	    echo json_encode($obj);
	      
  	}

  	public function simpanUpdateNamaCPTind(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');
	    
	    $nmcp	= $this->input->post('nama_cp_edit');
	    $kdkel	= $this->input->post('kdkel');
	    $dx	= $this->input->post('dx');
	    $level 	= $this->session->userdata("ses_nama");

	 //    var_dump($nmcp);
	 //    var_dump($kdkel);
	 //    var_dump($dx);
	 //    var_dump($level);
		// die();

	    $query  = $this->m_input_cp->simpanUpdateNamaCP($nmcp, $kdkel, $dx, $level);


	}

	public function simpanUpdateDetailTindCP(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');
	    
	    $noid		= $this->input->post('noid');
	    $kdcp		= $this->input->post('kdcp');
	    $kdtind		= $this->input->post('nm_tind_edit');
	    $hari_ke	= $this->input->post('hari_ke_edit');
	    $jumlah		= $this->input->post('jml_tnd_edit');
	    $level 		= $this->session->userdata("ses_nama");

	 //    var_dump($noid);
	 //    var_dump($kdcp);
	 //    var_dump($kdtind);
	 //    var_dump($hari_ke);
	 //    var_dump($jumlah);
	 //    var_dump($level);
		// die();

	    $query  = $this->m_input_cp->simpanUpdateDetailTindakan($noid, $kdcp, $kdtind, $hari_ke, $jumlah, $level);


	}

	public function hapusDaftarInputTindakanCPAll(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_input_cp');
	    
	    $tgl	= $this->input->post('tgl');
	    $nmcp	= $this->input->post('nm_cp');
	    $dx		= $this->input->post('dx');

	 //    var_dump($tgl);
	 //    var_dump($nmcp);
	 //    var_dump($dx);
		// die();

	    $query  = $this->m_input_cp->hapusHasilInputanDiTBCP($tgl, $nmcp, $dx);
	    $query  = $this->m_input_cp->hapusHasilInputanDiTBDETCP($tgl);


	}
 
   
}