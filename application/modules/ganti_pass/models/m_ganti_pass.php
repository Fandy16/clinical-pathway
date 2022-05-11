<?php  
ini_set('max_execution_time', 3600);


if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_ganti_pass extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}

	public function ganti_pass($passbaru, $passlama, $username)
	{
		$this->load->database();
		$sql = "UPDATE msuser SET pwd = '$passbaru' ,pwd_lama = '$passlama' ,updatedt = now() ,updateusr = '$username' WHERE usrname = '$username'";
		$query = $this->db->query($sql);

		/*var_dump($query->result());
    	die();*/
    	
		return $query;
	}
	
}