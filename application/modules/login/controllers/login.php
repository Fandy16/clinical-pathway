<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('m_login');
		// $this->load->model(array(''));
		$this->load->database();
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email', 'encryption'));
		$this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
	}

	private function _render($view, $data)
	{

		$this->load->view('head', $data);
	    $this->load->view($view);
	}

	public function index(){

        redirect(base_url()."login/form");

    }

	public function form(){

        $data = '';
        $this->load->library('session');
        $this->session->unset_userdata('ses_username');
        $this->session->unset_userdata('ses_password');
        $this->session->unset_userdata('ses_nama');
        $this->session->unset_userdata('ses_foto');
        $this->session->unset_userdata('ses_id_level');
        $this->session->unset_userdata('ses_level');
        $this->_render('v_login', $data);

    }

    public function actionLogin(){

        $this->load->library('session');
        $this->load->model('m_login');
        $user   = $this->input->post('username');
        $user   = $this->clean($user);
        $pass   = $this->input->post('password');
        $pass   = $this->clean($pass);


        if($this->m_login->login_user($user)) {
            $query = $this->m_login->login_user($user);
            $nama=$query->row()->nmuser;
            if ($nama!="") {
                $datasesi = array(
                    'ses_username'  => $query->row()->usrname,
                    'ses_password' => $query->row()->pwd,
                    'ses_nama' => $query->row()->nmuser,
                    'ses_foto' => $query->row()->foto,
                    'ses_id_level' => $query->row()->lvl,
                    'ses_level' => $query->row()->nmlvl,
                );

                $this->session->set_userdata($datasesi);

                $pass_encript = password_hash($pass, PASSWORD_DEFAULT);

                $hash = $query->row()->pwd;
                $username  = $query->row()->usrname;
                $nama = $query->row()->nmuser;
                $foto = $query->row()->foto;
                $id_level = $query->row()->lvl;
                $nm_level = $query->row()->nmlvl;

                // var_dump($pass_encript);
                // var_dump($hash);
                // var_dump($username);
                // var_dump($nama);
                // var_dump($foto);
                // var_dump($nm_level);
                // die();
                
                    if (password_verify($pass, $hash)) {

                       // redirect(base_url()."home");

                    $nm_level = $query->row()->nmlvl;

                    if ($nm_level == 'user1') {
                        redirect(base_url().'dashboard');
                    } else if ($nm_level == 'admin') {
                        // redirect(base_url().'daftar_user_opname_admin');
                        redirect(base_url().'input_cp');
                    }


                    } else {

                        $this->session->set_flashdata("pesan","<div class='alert alert-danger'>Username dan atau Password Salah !!!</div>");
                        redirect(base_url()."login/form"); 
                    }

            } else {

                $this->session->flashdata("pesan","<div class='alert alert-danger'>Username dan atau Password Salah !!!</div>");
                redirect(base_url()."login/form"); 
                
            } 
            
        }
       
    }

    public function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
       $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

       return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }

    public function logout() {
        $this->session->unset_userdata('ses_username');
        $this->session->unset_userdata('ses_password');
        $this->session->unset_userdata('ses_nama');
        $this->session->unset_userdata('ses_foto');
        $this->session->unset_userdata('ses_id_level');
        $this->session->unset_userdata('ses_level');

		redirect('login');
    }

}
