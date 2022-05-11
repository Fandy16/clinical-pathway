<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_tambah_user extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}

	// DATA DAFTAR USER
	public function lihatDaftarUser()
	{
		$this->load->database();
		$sql = "SELECT IDUSER, USRNAME, NMUSER, LVL, NMLVL, FOTO, AKTIF FROM MSUSER ORDER BY NMUSER";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA DAFTAR USER
	public function lihatDaftarUser2()
	{
		$this->load->database();
		$sql = "CALL sp_pathway_lihat_daftar_user () ";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA DAFTAR USER
	public function simpanUserBaru($username, $passw, $namaUser, $level)
	{
		$this->load->database();
		$sql = "INSERT INTO MSUSER (USRNAME, PWD, PWD_LAMA, NMUSER, LVL, NMLVL, FOTO, AKTIF, CRTDT, CRTUSR, UPDATEDT, UPDATEUSR)
      			VALUES('$username', '$passw', null, '$namaUser', 2, 'user1', 'pengguna.png', 1, now(), '$level', null, null)";     			
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA DAFTAR USER
	public function simpanUserBaru2($username, $passw, $namaUser, $level)
	{
		$this->load->database();
		$sql = "call sp_pathway_tambah_user_baru ('{$username}', '{$passw}', '{$namaUser}', '{$level}') ";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA DAFTAR USER
	public function resetPasswordUser($passw, $level, $id_user, $username)
	{
		$this->load->database();
		$sql = "UPDATE MSUSER SET PWD = '$passw', UPDATEDT = 'NOW()', UPDATEUSR = '$level' WHERE IDUSER = '$id_user' AND USRNAME = '$username'";     			
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	
}