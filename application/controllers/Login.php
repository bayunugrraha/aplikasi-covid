<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        
    }
	
	public function index()
	{
        $data['project_name'] = "CLUSTERING ANALYSIS COVID 19";
        $data['established'] = "2020";
        $this->load->view('member/Login',$data);
	}
		
	public function doLogin() {
        $dataPost = $this->input->post();
        if ($this->m_login->checkLogin($dataPost['Username'], $dataPost['Password'])) {
            redirect('admin/dashboard');  
        }else{
			$this->session->set_flashdata('GagalLogin', 'Ya');
            redirect('login');
        }
    }
	
    function logout() {
        $this->session->unset_userdata('loginData');
        redirect('home');
    }
       
}
