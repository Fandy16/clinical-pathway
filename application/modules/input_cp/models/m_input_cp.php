<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_input_cp extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}

	public function lihatDaftarDiagnosa()
	{
		$this->load->database();
		$sql = "SELECT diagnosa, diagnosa as kode_diag, concat(diagnosa, ' -   ' ,kata1) as nm_diag FROM msicd ORDER BY diagnosa ASC;";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function lihatDaftarKelas()
	{
		$this->load->database();
		$sql = "SELECT kdkelas, nmkelas FROM mskelas";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function lihatDaftarKelompok()
	{
		$this->load->database();
		$sql = "SELECT kdkel, nmkelompok FROM mskelompok";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function lihatDaftarTindakan($kdkel)
	{
		$this->load->database();
		$sql = "SELECT kdtind, nmtind, kdkel FROM mstindakan WHERE kdkel = '$kdkel'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function lihatDaftarTindakanEdit()
	{
		$this->load->database();
		$sql = "SELECT kdtind, nmtind, kdkel FROM mstindakan";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function ambilNamaDiag($dx)
	{
		$this->load->database();
		$sql = "SELECT diagnosa, kata1 FROM msicd where diagnosa = '$dx'";
		$query = $this->db->query($sql);

		return $query;
	}

	public function ambilBiayaTindakan($kdtind, $kdkelas)
	{
		$this->load->database();
		$sql = "SELECT biaya FROM mstindakanby WHERE kdtind = '$kdtind' AND kdkelas = '$kdkelas'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function simpanInputanCP($kdtin, $kdkel, $nama_cp, $hari, $hari_ke, $dx, $nmdx, $jumlah, $kelas1, $kelas2, $kelas3, $idkomp, $level)
	{
		$this->load->database();
		$sql = "INSERT INTO tbcptmp (noidtmp,kdtin,kdkel,tgl,nama_cp,hari,hari_ke,dx,nmdx
				,jumlah,kelas1,kelas2,kelas3,idkomp,crtdt,crtusr,updatedt,updateusr) VALUES 
				(NULL,'$kdtin','$kdkel',NOW(),'$nama_cp','$hari','$hari_ke','$dx','$nmdx'
				,'$jumlah','$kelas1','$kelas2','$kelas3','$idkomp',NOW(),'$level','','')";

		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function updateInputanCP($noidtmp, $kdtin, $kdkel, $hari_ke, $jumlah, $kelas1, $kelas2, $kelas3, $idkomp, $level)
	{
		$this->load->database();
		$sql = "UPDATE tbcptmp SET
				   kdtin = '$kdtin'
				  ,kdkel = '$kdkel'
				  ,hari_ke = '$hari_ke'
				  ,jumlah = '$jumlah'
				  ,kelas1 = '$kelas1'
				  ,kelas2 = '$kelas2'
				  ,kelas3 = '$kelas3'
				  ,updatedt = NOW()
				  ,updateusr = '$level'
				WHERE noidtmp = '$noidtmp' AND idkomp = '$idkomp' AND crtusr = '$level'";

		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function lihatDaftarInputan($idkomp, $level)
	{
		$this->load->database();
		$sql = "SELECT A.noidtmp, A.tgl, A.kdkel, C.nmkelompok, A.kdtin, B.nmtind, A.nama_cp, 
				A.hari, A.hari_ke, A.jumlah, A.kelas1 , A.kelas2, A.kelas3
				FROM tbcptmp A
				JOIN mstindakan B ON A.kdtin = B.kdtind
				JOIN mskelompok C ON A.kdkel = C.kdkel
				WHERE A.idkomp = '$idkomp' AND  A.crtusr = '$level'
				ORDER BY A.crtdt DESC";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function hapusHasilInputanAll($idkomp, $level)
	{
		$this->load->database();
		$sql = "DELETE FROM tbcptmp WHERE idkomp = '$idkomp' AND crtusr = '$level'; ";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function hapusHasilInputan($noidtmp, $tgl, $level)
	{
		$this->load->database();
		// $sql = "call sp_pathway_hapus_inputcp ('{$noidtmp}', '{$tgl}', '{$level}')";
		$sql = "DELETE FROM tbcptmp WHERE noidtmp = '$noidtmp' AND tgl = '$tgl' AND crtusr = '$level'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function simpanHasilInputanKeTabelCP($idkomp, $tgl, $level) {
		$this->load->database();
		$sql = "INSERT INTO tbcp (kdcp,tgl,nmcp,kdkel,dx1,nmdx,hari,idkomp,crtdt,crtusr,updatedt,updateusr) 
				SELECT DISTINCT
				   NULL AS kdcp, tgl AS tgl, nama_cp AS nmcp, kdkel AS kdkel, dx AS dx1, nmdx AS nmdx
				  ,hari AS hari, idkomp AS idkomp, NOW() AS crtdt, '$level' AS crtusr, '' AS updatedt, '' AS updateusr
				FROM tbcptmp
				WHERE idkomp = '$idkomp' AND cast(tgl as Date) = '$tgl' AND crtusr = '$level'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function simpanHasilInputanKeTabelDetailCP($idkomp, $tgl, $level) {
		$this->load->database();
		$sql = "INSERT INTO tbdetcp (noid,kdcp,kdtind,hari_ke,jumlah,crtdt,crtusr,updatedt,updateusr) 
				SELECT DISTINCT NULL AS noid, B.kdcp AS kdcp, A.kdtin AS kdtind, A.hari_ke AS hari_ke,
				   A.jumlah AS jumlah, NOW() AS crtdt, '$level' AS crtusr,''  AS updatedt,''  AS updateusr
				FROM tbcptmp A
				JOIN tbcp B ON A.kdkel = B.kdkel AND A.dx = B.dx1 AND A.tgl = B.tgl AND A.idkomp = B.idkomp AND A.crtusr = B.crtusr
				WHERE A.idkomp = '$idkomp' AND cast(A.tgl as Date) = '$tgl' AND A.crtusr = '$level'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	// DATA DAFTAR HASIL INPUT CP
	public function lihatHasilInputCP($level)
	{
		$this->load->database();
		$sql = "SELECT DISTINCT A.tgl, A.kdcp, A.nmcp, A.kdkel, B.nmkelompok, A.dx1, A.nmdx, A.hari, A.crtusr FROM tbcp A
				JOIN mskelompok B ON A.kdkel = B.kdkel where A.crtusr = '$level' group by A.nmcp, A.kdkel, B.nmkelompok, A.dx1, A.nmdx, A.hari
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
		$sql = "SELECT C.noid, A.kdcp, A.tgl, A.kdkel, B.nmkelompok, A.dx1, A.nmdx, C.kdtind, D.nmtind,A.hari, 
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

	public function simpanUpdateNamaCP($nmcp, $kdkel, $dx, $level)
	{
		$this->load->database();
		$sql = "UPDATE tbcp SET
				   nmcp = '$nmcp'
				  ,updatedt = NOW()
				  ,updateusr = '$level'
				WHERE kdkel = '$kdkel' AND dx1 = '$dx'";

		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function simpanUpdateDetailTindakan($noid, $kdcp, $kdtind, $hari_ke, $jumlah, $level)
	{
		$this->load->database();
		$sql = "UPDATE tbdetcp SET
				   kdtind = '$kdtind'
				  ,hari_ke = '$hari_ke'
				  ,jumlah = '$jumlah'
				  ,updatedt = NOW()
				  ,updateusr = '$level'
				WHERE noid = '$noid' AND kdcp = '$kdcp'";

		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function hapusHasilInputanDiTBCP($tgl, $nmcp, $dx)
	{
		$this->load->database();
		$sql = "DELETE FROM tbcp WHERE cast(tgl as Date) = '$tgl' AND nmcp = '$nmcp' AND dx1 = '$dx'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

	public function hapusHasilInputanDiTBDETCP($tgl)
	{
		$this->load->database();
		$sql = "DELETE FROM tbdetcp WHERE cast(crtdt as Date) = '$tgl'";
		$query = $this->db->query($sql);

		// var_dump($query->result());
  //   	die();
    	
		return $query;
	}

}