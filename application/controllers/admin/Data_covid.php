<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_covid extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_covid');
		$this->load->model('M_lokasi');
    }
	
	public function index(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_covid->getAll();
		$data['lokasi']	= $this->M_lokasi->getListProvinsi();
		$data['v_content']  = 'member/covid/index';
		$this->load->view('member/layout', $data);

	}

	public function uploads(){

		$post = $this->input->post();
		$upload_path = './uploads/covid/';
		/*====================================== BEGIN UPLOADING FEATEURE IMAGE ======================================*/
		$file = "";
		if ($_FILES['file']['name'] <> "") {
			$ext           = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			$file = "Data".date("dmYHis").rand(100,999).".".$ext;

			$config['upload_path']   = $upload_path;
			$config['allowed_types'] = '*';
			$config['file_name']     = $file;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('file')){
				$error = 'error: '. $this->upload->display_errors();
				echo $error;
				die();
			}else{
				$file = "uploads/covid/".$file;
			}
		}


		$url = base_url($file); // path to your JSON file
		$data = file_get_contents($url); // put the contents of the file into a variable
		$characters = json_decode($data); // decode the JSON feed


		
		//$this->db->delete("tbl_covid_province", array("id_province" => $_POST['id_province']));
		foreach ($characters->list_perkembangan as $key => $value) {
			$time = strtotime($value->tanggal);

			$dataArray = array(
				"id_province"			=>	$_POST['id_province'],
				"kasus"					=>	$value->KASUS,
				"akumulasi_meninggal"	=>	$value->AKUMULASI_MENINGGAL,
				"akumulasi_sembuh"		=>	$value->AKUMULASI_SEMBUH,
				"rawat_isolasi"			=>	$value->AKUMULASI_DIRAWAT_OR_ISOLASI,
				"tanggal"				=>	$characters->last_date,
				"akumulasi_kasus"		=>	$value->AKUMULASI_KASUS,
			);

			$cek = $this->db->query("select * from tbl_covid_province where id_province = '".$_POST['id_province']."' AND tanggal = '".$characters->last_date."'")->row();
			if($cek){
				$dataArray['updated_date'] = date("Y-m-d");
				$this->db->update("tbl_covid_province",$dataArray, array("id_province" => $_POST['id_province'], "tanggal" =>$characters->last_date ));
			}else{
				$dataArray['created_date'] = date("Y-m-d");
				$this->db->insert("tbl_covid_province",$dataArray);
			}

			
		}
		

		redirect("admin/data_covid/all_data");		    
	}

	public function all_data(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['lokasi']	= $this->M_lokasi->getListProvinsi();
		$where = "";

		if($_GET['id_province'] && $_GET['date'] && $_GET['date_type']){
			$where .= " WHERE id_province = '".$_GET['id_province']."'";

			$where .= " AND ".$_GET['date_type']." = '".$_GET['date']."'";
		}
		$data['listData']	= $this->db->query("select * from tbl_covid_province inner join tbl_province ON tbl_province.province_id = tbl_covid_province.id_province ".$where )->result();
		$data['v_content']  = 'member/covid/all_data';
		$this->load->view('member/layout', $data);

	}
	public function truncate(){
		$truncate = $this->db->truncate("tbl_covid_province");
		if($truncate){
			$this->m_umum->generatePesan("Berhasil mengosongkan semua data","berhasil");
			redirect('admin/data_covid/all_data');
		}else{
			$this->m_umum->generatePesan("Gagal mengosongkan semua data","gagal");
			redirect('admin/data_covid/all_data'); 
		}

	}
	
}
