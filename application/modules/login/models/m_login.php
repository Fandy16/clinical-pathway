<?php  
ini_set('max_execution_time', 3600);


if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}

	public function login_user($username){
		$this->load->database();
		$sql = "SELECT usrname, pwd, nmuser, lvl, nmlvl, foto FROM msuser WHERE usrname = '$username'";
		// $sql = "call sp_pathway_login_user('$username')";
		$query = $this->db->query($sql);

		/*var_dump($query->result());
    	die();*/
    	
		return $query;

	}
	
}