<?php  
ini_set('max_execution_time', 3600);


if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboard extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}

	public function totalDiagnosa($tgl)
	{
		$this->load->database();
		$sql = "SELECT COUNT(A.kata1) jumlah FROM msicd A JOIN tbcp B ON A.diagnosa = B.dx1 AND concat(month(B.tgl),'',year((B.tgl))) = '$tgl'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function lihatDetailDiagnosa($tgl)
	{
		$this->load->database();
		$sql = "SELECT A.kode, A.diagnosa, A.kata1, A.kata2 
				FROM msicd A
				JOIN tbcp B ON A.diagnosa = B.dx1 AND concat(month(B.tgl),'',year((B.tgl))) = '$tgl'
				ORDER BY B.crtdt DESC";
		$query = $this->db->query($sql);

		/*var_dump($query->result());
    	die();*/
    	
		return $query;
	}

	public function totalTindakan()
	{
		$this->load->database();
		$sql = "SELECT COUNT(kdcp) jmlCP FROM tbcp";
		$query = $this->db->query($sql);

		/*var_dump($query->result());
    	die();*/
    	
		return $query;
	}

	public function totalBiayaTindakan()
	{
		$this->load->database();
		$sql = "SELECT SUM(biaya) totBiaya FROM tbcp";
		$query = $this->db->query($sql);

		/*var_dump($query->result());
    	die();*/
    	
		return $query;
	}

	public function lihatDetailTindakan()
	{
		$this->load->database();
		$sql = "SELECT A.kdcp, A.nmcp, A.kdkel, B.nmkelompok, D.nmtind, A.dx1, A.nmdx, A.hari, C.hari_ke, C.jumlah,
				(C.jumlah*K.biaya)biaya_kls1, (C.jumlah*L.biaya)biaya_kls2,(C.jumlah*M.biaya)biaya_kls3
				FROM tbcp A
				JOIN mskelompok B ON A.kdkel = B.kdkel 
				JOIN tbdetcp C ON A.kdcp = C.kdcp
				JOIN mstindakan D ON C.kdtind = D.kdtind AND B.kdkel = D.kdkel
				JOIN (SELECT kdtind, biaya FROM mstindakanby WHERE kdkelas = '1') K on C.kdtind = K.kdtind
				JOIN (SELECT kdtind, biaya FROM mstindakanby WHERE kdkelas = '2') L on C.kdtind = L.kdtind
				JOIN (SELECT kdtind, biaya FROM mstindakanby WHERE kdkelas = '3') M on C.kdtind = M.kdtind
				ORDER BY A.nmcp DESC";
		$query = $this->db->query($sql);

		/*var_dump($query->result());
    	die();*/
    	
		return $query;
	}

	// DATA DAFTAR DETAIL INPUT CP
	public function lihatDetailInputCP($kdcp)
	{
		$this->load->database();
		$sql = "SELECT A.kdcp, A.kdtind, B.nmtind, A.hari_ke, A.biaya
				FROM tbdetcp A
				JOIN mstindakan B ON A.kdtind = B.kdtind
				WHERE A.kdcp = '$kdcp'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function lihatPendapatanCPPerTanggal()
	{
		$this->load->database();
		$sql = "SELECT tgl, biaya FROM tbcp";
		$query = $this->db->query($sql);

		/*var_dump($query->result());
    	die();*/
    	
		return $query;
	}

	public function lihatDaftarTindakanYangSeringKeluar()
	{
		$this->load->database();
		$sql = "SELECT A.kdtind, B.nmtind, SUM(A.jumlah)jmlTindakan, SUM(A.biaya) jmlBiaya
				FROM tbdetcp A
				JOIN mstindakan B ON A.kdtind = B.kdtind
				GROUP BY A.kdtind";
		$query = $this->db->query($sql);

		/*var_dump($query->result());
    	die();*/
    	
		return $query;
	}

	public function lihatHasilInputCP()
	{
		$this->load->database();
		$sql = "SELECT DISTINCT A.kdcp, A.nmcp, A.kdkel, B.nmkelompok, A.dx1, A.nmdx, A.hari FROM tbcp A
				JOIN mskelompok B ON A.kdkel = B.kdkel group by A.nmcp, A.kdkel, B.nmkelompok, A.dx1, A.nmdx, A.hari
				ORDER BY A.crtdt DESC";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// SIMPAN FILE EXCEL
	public function simpanImportExcel($nm_cp, $kd_kel, $nm_kel, $dx, $nm_dx, $kd_tind, $nm_tind, $jml_hari, $hari_ke
				 					, $jml, $kd_kls1, $biaya_kls1, $kd_kls2, $biaya_kls2, $kd_kls3, $biaya_kls3, $level)
	{
		$this->load->database();
		$sql = "INSERT INTO tbcpimport (
				   id_import,nm_cp,kd_kel,nm_kel,dx,nm_dx,kd_tind,nm_tind,jml_hari,hari_ke
				  ,jml,kd_kls1,biaya_kls1,kd_kls2,biaya_kls2,kd_kls3,biaya_kls3,crtdt,crtusr) 
				VALUES 
				  (NULL,'$nm_cp','$kd_kel','$nm_kel','$dx','$nm_dx','$kd_tind','$nm_tind','$jml_hari','$hari_ke'
				  ,'$jml','$kd_kls1','$biaya_kls1','$kd_kls2','$biaya_kls2','$kd_kls3','$biaya_kls3',NOW(),'$level')";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){

		$this->db->insert_batch('tbcpimport', $data);

	}
	
}