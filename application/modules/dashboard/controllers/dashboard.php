<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_dashboard');
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
	  	$bulanini = date('mY');
	  	$data['totalDiagnosa'] = $this->m_dashboard->totalDiagnosa($bulanini);
	  	$data['totalTindakan'] = $this->m_dashboard->totalTindakan();
	  	// $data['totalBiayaTindakan'] = $this->m_dashboard->totalBiayaTindakan();

	  	$this->_render('v_dashboard', $data);

	}
 
    public function tabelDetailDiagnosa(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_dashboard');

	    $bulanini = date('mY');


	    $query = $this->m_dashboard->lihatDetailDiagnosa($bulanini);


	    $no = 1;
	    $data = array();
	    $aktif = array();
	    foreach($query->result() as $kolom){
	      

	      $data[]       = array(

	        // "kosong"    =>'',
	        "no"        => "<center><span >" . $no++ . "</span></center>",
	        "KODE"  	=> "<span><center>" .$kolom->diagnosa. "</center></span>",
	        "DIAGNOSA"  => "<span>" .$kolom->kata1. "</span>",

	      );
	    }


	    $obj = array(
	      "data"  => $data
	    );
	    
	    echo json_encode($obj);
	      
  	}

  	public function tabelDetailTindakan(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_dashboard');


	    $query = $this->m_dashboard->lihatDetailTindakan();


	    $no = 1;
	    $data = array();
	    $aktif = array();
	    foreach($query->result() as $kolom){
	      

	      $data[]       = array(

	        // "kosong"    =>'',
	        "no"        => "<center><span >" . $no++ . "</span></center>",
	        "NAMACP" 	=> "<span>" .$kolom->nmcp. "</span>",
	        "DIAGNOSA"  => "<span>" .$kolom->dx1. " - " .$kolom->nmdx. "</span>",
	        "KELOMPOK" 	=> "<span>" .$kolom->nmkelompok. "</span>",
	        "NAMATIND" 	=> "<span>" .$kolom->nmtind. "</span>",
	        "PERAWATAN" => "<span><center>" .$kolom->hari. "</center></span>",
	        "HARI_KE" 	=> "<span><center>" .$kolom->hari_ke. "</center></span>",
	        "JUMLAH"  	=> "<span><center>" .$kolom->jumlah. "</center></span>",
	        "KELAS1" 	=> "<span> Rp. " .number_format($kolom->biaya_kls1). "</span>",
	        "KELAS2" 	=> "<span> Rp. " .number_format($kolom->biaya_kls2). "</span>",
	        "KELAS3" 	=> "<span> Rp. " .number_format($kolom->biaya_kls3). "</span>"

	      );
	    }


	    $obj = array(
	      "data"  => $data
	    );
	    
	    echo json_encode($obj);
	      
  	}

  	public function tabelDaftarInputCP(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_dashboard');


	    $query = $this->m_dashboard->lihatHasilInputCP();


	     $no = 1;
	    $data = array();
	    $aktif = array();
	    foreach($query->result() as $kolom){
	      

	      $data[]       = array(

	        // "kosong"    =>'',
	        "no"        => "<center><span >" . $no++ . "</span></center>",
	        "NAMACP"  	=> "<span>" .$kolom->nmcp. "</span>",
	        "KELOMPOK"  => "<span>".$kolom->nmkelompok."</span>",
	        "DIAGNOSA"  => "<span>" .$kolom->dx1. ' - ' .$kolom->nmdx. "</span>",
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

  	public function tabelDaftarDetailTindakanCP(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_dashboard');

	    $kdcp  = $this->input->post('kode_cp');

	    $query = $this->m_dashboard->lihatDetailInputCP($kdcp);


	     $no = 1;
	    $data = array();
	    $aktif = array();
	    foreach($query->result() as $kolom){
	      

	      $data[]       = array(

	        // "kosong"    =>'',
	        "no"       		=> "<center><span >" . $no++ . "</span></center>",
	        "NMTINDAKAN" 	=> "<span>" .$kolom->nmtind. "</span>",
	        "HARI" 	    	=> "<span><center>".$kolom->hari_ke." </center></span>",
	        "BIAYA" 		=> "<span>Rp. ".number_format($kolom->biaya)." </span>",
	        // "kosong"    =>'',                 

	      );
	    }


	    $obj = array(
	      "data"  => $data
	    );
	    
	    echo json_encode($obj);
	      
  	}

  	public function simpanFileExportExcel(){

	    $uri =& load_class('URI', 'core');
	    $this->load->library('session');
	    $this->load->library('encryption');
	    $this->load->model('m_dashboard');
	    
	    $nm_cp		= $this->input->post('noid');
	    $kd_kel		= $this->input->post('kdcp');
	    $nm_kel		= $this->input->post('nm_tind_edit');
	    $dx			= $this->input->post('hari_ke_edit');
	    $nm_dx		= $this->input->post('jml_tnd_edit');
	    $kd_tind	= $this->input->post('jml_tnd_edit');
	    $nm_tind	= $this->input->post('jml_tnd_edit');
	    $jml_hari	= $this->input->post('jml_tnd_edit');
	    $hari_ke	= $this->input->post('jml_tnd_edit');
	    $jml		= $this->input->post('jml_tnd_edit');
	    $kd_kls1	= $this->input->post('jml_tnd_edit');
	    $biaya_kls1	= $this->input->post('jml_tnd_edit');
	    $kd_kls2	= $this->input->post('jml_tnd_edit');
	    $biaya_kls2	= $this->input->post('jml_tnd_edit');
	    $kd_kls3	= $this->input->post('jml_tnd_edit');
	    $biaya_kls3	= $this->input->post('jml_tnd_edit');
	    $level 		= $this->session->userdata("ses_nama");

	 //    var_dump($noid);
	 //    var_dump($kdcp);
	 //    var_dump($kdtind);
	 //    var_dump($hari_ke);
	 //    var_dump($jumlah);
	 //    var_dump($level);
		// die();

	    $query  = $this->m_dashboard->simpanImportExcel($nm_cp, $kd_kel, $nm_kel, $dx, $nm_dx, $kd_tind, $nm_tind, $jml_hari, $hari_ke
				 					, $jml, $kd_kls1, $biaya_kls1, $kd_kls2, $biaya_kls2, $kd_kls3, $biaya_kls3, $level);


	}

  	public function upload(){
        $fileName = time().$_FILES['file']['name'];
        
        $config['upload_path'] = './assets/excel/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
        
        $this->load->library('upload');
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			// echo 'Data Imported successfully';


			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
			$return = new PHPExcel_Reader_Excel2007();
			
			// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
			$data = array();
			
			$numrow = 1;
			foreach($return as $row){
				// Cek $numrow apakah lebih dari 1
				// Artinya karena baris pertama adalah nama-nama kolom
				// Jadi dilewat saja, tidak usah diimport
				if($numrow > 1){
					// Kita push (add) array data ke variabel data
					array_push($data, array(

		                'nm_cp' => $row['A'],
						'kd_kel' => $row['B'],
						'nm_kel' => $row['C'],
						'dx' => $row['D'],
						'nm_dx' => $row['E'],
						'kd_tind' => $row['F'],
						'nm_tind' => $row['G'],
						'jml_hari' => $row['H'],
						'hari_ke' => $row['I'],
						'jml' => $row['J'],
						'kd_kls1' => $row['K'],
						'biaya_kls1' => $row['L'],
						'kd_kls2' => $row['M'],
						'biaya_kls2' => $row['N'],
						'kd_kls3' => $row['O'],
						'biaya_kls3' => $row['P'],

					));
				}
				
				$numrow++; // Tambah 1 setiap kali looping
			}

			// var_dump($return);
			// die();

		    $this->m_dashboard->insert_multiple($data);

		    echo 'Data Imported successfully';

			redirect('dashboard');

			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			// echo 'Data Imported error';

			// redirect('dashboard');
			return $return;
		}
 
        redirect('dashboard');
    }

    function import(){

	    if(isset($_FILES["file"]["name"])){

	      $path = $_FILES["file"]["tmp_name"];

	      $object = PHPExcel_IOFactory::load($path);

	      foreach($object->getWorksheetIterator() as $worksheet){

	        $highestRow = $worksheet->getHighestRow();

	        $highestColumn = $worksheet->getHighestColumn();

	        for($row=17; $row<=$highestRow; $row++){

	           $id_import = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
				$nm_cp = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
				$kd_kel = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
				$nm_kel = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
				$dx = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
				$nm_dx = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
				$kd_tind = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
				$nm_tind = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
				$jml_hari = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
				$hari_ke = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
				$jml = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
				$kd_kls1 = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
				$biaya_kls1 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
				$kd_kls2 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
				$biaya_kls2 = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
				$kd_kls3 = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
				$biaya_kls3 = $worksheet->getCellByColumnAndRow(16, $row)->getValue();

	           $data[] = array(

	            'id_import' => $id_import,
                'nm_cp' => $nm_cp,
				'kd_kel' => $kd_kel,
				'nm_kel' => $nm_kel,
				'dx' => $dx,
				'nm_dx' => $nm_dx,
				'kd_tind' => $kd_tind,
				'nm_tind' => $nm_tind,
				'jml_hari' => $jml_hari,
				'hari_ke' => $hari_ke,
				'jml' => $jml,
				'kd_kls1' => $kd_kls1,
				'biaya_kls1' => $biaya_kls1,
				'kd_kls2' => $kd_kls2,
				'biaya_kls2' => $biaya_kls2,
				'kd_kls3' => $kd_kls3,
				'biaya_kls3' => $biaya_kls3

	           );

	        }

	      }

	      $this->m_dashboard->insert_batch($data);

	      echo 'Data Imported successfully';

	    }

  	}

    

}