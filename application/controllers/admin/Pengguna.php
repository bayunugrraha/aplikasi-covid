<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_pengguna');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['v_content']  = 'member/pengguna/add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_pengguna->getListPengguna();
		$data['v_content']  = 'member/pengguna/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_pengguna->getListPenggunaId($id);
		$data['v_content']  = 'member/pengguna/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $this->m_umum->generatePesan("Data tidak boleh diisi spasi","gagal");
			redirect('admin/pengguna/add'); 
		}else{
			$dataArray = array(
				"username"  	=> $post['username'],
				"password"  	=> md5($post['password']),
			);

			$insert = $this->db->insert("tbl_admin",$dataArray);
			if($insert){
				$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
				redirect('admin/pengguna/daftar');
			}else{
				$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
				redirect('admin/pengguna/add'); 
			}
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $this->m_umum->generatePesan("Data tidak boleh diisi spasi","gagal");
			redirect('admin/pengguna/add'); 
		}else{
			$dataArray = array(
				"username"  	=> $post['username'],
			);

			if($post['password']){
				$dataArray["password"]  	= md5($post['password']);
			}

			$update = $this->db->update("tbl_admin",$dataArray,array("admin_id" => $id));
			if($update){
				$this->m_umum->generatePesan("Berhasil ubah data","berhasil");
				redirect('admin/pengguna/daftar');
			}else{
				$this->m_umum->generatePesan("Gagal ubah data","gagal");
				redirect('admin/pengguna/daftar'); 
			}
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("tbl_admin",array("admin_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil hapus data","berhasil");
			redirect('admin/pengguna/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal hapus data","gagal");
			redirect('admin/pengguna/daftar'); 
		}
	}
	
}
