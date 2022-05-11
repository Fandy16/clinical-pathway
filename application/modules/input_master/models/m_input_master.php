<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_input_master extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}

	
	// DATA DAFTAR USER
	public function lihatDaftarTindakan()
	{
		$this->load->database();
		$sql = "SELECT DISTINCT A.idtind, A.kdtind, A.nmtind, A.kdkel, B.nmkelompok
				FROM mstindakan A
				JOIN mskelompok B ON A.kdkel = B.kdkel
				ORDER BY A.idtind DESC";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA DAFTAR TINDAKAN DETAIL
	public function lihatDaftarTindakanDetail($idtind, $kdtind)
	{
		$this->load->database();
		$sql = "SELECT A.idtind, A.kdtind, A.nmtind, A.kdkel, C.nmkelompok , B.kdkelas, B.biaya
				FROM mstindakan A
				LEFT JOIN mstindakanby B ON A.kdtind = B.kdtind
				LEFT JOIN mskelompok C ON A.kdkel = C.kdkel
				WHERE A.idtind = '$idtind' AND A.kdtind = '$kdtind'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA DAFTAR MASTER KELOMPOK
	public function lihatMasterKelompok()
	{
		$this->load->database();
		$sql = "SELECT kdkel, nmkelompok, tgl FROM mskelompok ORDER BY tgl DESC";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA TAMBAH MASTER TINDAKAN
	public function simpanMasterKelompok($nmkelompok, $level)
	{
		$this->load->database();
		$sql = "INSERT INTO mskelompok (kdkel,nmkelompok, tgl,crtdt,crtusr,updatedt,updateusr) VALUES 
				(NULL,'$nmkelompok', NOW(),NOW(),'$level','','')";     			
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA TAMBAH MASTER TINDAKAN
	public function lihatKodeTindakanTrakhir()
	{
		$this->load->database();
		$sql = "SELECT kdtind FROM mstindakan ORDER BY kdtind DESC LIMIT 1";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA TAMBAH MASTER TINDAKAN
	public function simpanMasterTindakan($kdkel, $kdtind, $nmtind, $level)
	{
		$this->load->database();
		$sql = "INSERT INTO mstindakan (
				idtind,kdkel,kdtind,nmtind,crtdt,crtusr,updatedt,updateusr) VALUES 
				   (NULL,'$kdkel', '$kdtind','$nmtind',NOW(),'$level','','')";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA TAMBAH MASTER TINDAKAN
	public function simpanMasterTindakanBy($kdtind, $kdkelas, $biaya, $level)
	{
		$this->load->database();
		$sql = "INSERT INTO mstindakanby (
				idtindby,kdtind,kdkelas,biaya,crtdt,crtusr,updatedt,updateusr)
				VALUES (NULL, '$kdtind', '$kdkelas', '$biaya', now(), '$level', '', '')";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA DAFTAR DETAIL BIAYA PERKELAS
	public function lihatDaftarDetailBiayaPerKelas($idtind, $kdtind, $kdkelas)
	{
		$this->load->database();
		$sql = "SELECT A.idtind, B.idtindby , A.kdtind, A.nmtind, A.kdkel, C.nmkelompok , B.kdkelas, B.biaya
				FROM mstindakan A
				LEFT JOIN mstindakanby B ON A.kdtind = B.kdtind
				LEFT JOIN mskelompok C ON A.kdkel = C.kdkel
				WHERE A.idtind = '$idtind' AND A.kdtind = '$kdtind' AND B.kdkelas = '$kdkelas'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA UBAH MASTER TINDAKAN
	public function updateMasterKelompok($kdkel, $nmkelompok, $level)
	{
		$this->load->database();
		$sql = "UPDATE mskelompok SET
				   nmkelompok = '$nmkelompok'
				  ,updatedt =NOW()
				  ,updateusr = '$level'
				WHERE kdkel = '$kdkel'";     			
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA UBAH MASTER TINDAKAN
	public function updateMasterTindakan($idtind, $kdkel, $kdtind, $nmtind)
	{
		$this->load->database();
		$sql = "UPDATE mstindakan SET
				   kdtind = '$kdtind'
				  ,kdkel = '$kdkel'
				  ,nmtind = '$nmtind'
				WHERE idtind = '$idtind' AND kdtind = '$kdtind' AND kdkel = '$kdkel'";     			
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA UBAH MASTER TINDAKAN
	public function updateMasterTindakanBy($idtindby, $kdtind, $kdkelas, $biaya)
	{
		$this->load->database();
		$sql = "UPDATE mstindakanby SET
				   kdtind = '$kdtind'
				  ,kdkelas = '$kdkelas'
				  ,biaya = '$biaya'
				WHERE idtindby = '$idtindby' AND kdtind = '$kdtind'";     			
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// HAPUS MASTER TINDAKAN
	public function hapusMasterKelompok($kdkel)
	{
		$this->load->database();
		$sql = "DELETE FROM mskelompok WHERE kdkel = '$kdkel'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// HAPUS MASTER TINDAKAN
	public function hapusMasterTindakan($idtind, $kdtind, $kdkel)
	{
		$this->load->database();
		$sql = "DELETE FROM mstindakan WHERE idtind = '$idtind' AND kdtind = '$kdtind' AND kdkel = '$kdkel'";     			
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// HAPUS MASTER TINDAKAN
	public function hapusMasterTindakanBy($idtindby, $kdtind, $kdkelas)
	{
		$this->load->database();
		$sql = "DELETE FROM mstindakanby WHERE idtindby = '$idtindby' AND kdtind = '$kdtind' AND kdkelas = '$kdkelas'";     			
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

}