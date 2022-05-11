<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_hasil_input_cp extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}

	// DATA DAFTAR HASIL INPUT CP
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

	// DATA DAFTAR DETAIL INPUT CP
	public function lihatDetailInputCP($nmcp, $kdkel, $dx)
	{
		$this->load->database();
		$sql = "SELECT A.kdcp, A.tgl, A.kdkel, A.dx1, C.kdtind, D.nmtind,A.hari, 
				C.hari_ke, C.jumlah, (C.jumlah*K.biaya)biaya_kls1, (C.jumlah*L.biaya)biaya_kls2,
				(C.jumlah*M.biaya)biaya_kls3
				FROM tbcp A
				JOIN mskelompok B ON A.kdkel = B.kdkel
				JOIN tbdetcp C ON A.kdcp = C.kdcp
				JOIN mstindakan D ON C.kdtind = D.kdtind AND A.kdkel = D.kdkel
				JOIN (SELECT kdtind, biaya FROM mstindakanby WHERE kdkelas = '1') K on C.kdtind = K.kdtind
				JOIN (SELECT kdtind, biaya FROM mstindakanby WHERE kdkelas = '2') L on C.kdtind = L.kdtind
				JOIN (SELECT kdtind, biaya FROM mstindakanby WHERE kdkelas = '3') M on C.kdtind = M.kdtind
				WHERE A.nmcp = '$nmcp' AND A.kdkel = '$kdkel' AND A.dx1 = '$dx'
				group by A.kdcp, A.tgl, A.kdkel, A.dx1, C.kdtind, D.nmtind, A.hari, C.hari_ke";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}
	
}