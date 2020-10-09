<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kmeans extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_covid');
		$this->load->model('M_lokasi');
		$this->load->model('M_kmeans');
    }

	public function area(){
		$data['userLogin']  	= $this->session->userdata('loginData');
		//$data['v_content']  = 'member/covid/area';
		$this->load->view('member/covid/area', $data);
	}

    public function daftar_kmeans(){
        $data['userLogin']      = $this->session->userdata('loginData');
        $data['lokasi'] = $this->M_lokasi->getListProvinsi();
        $where = "";

        if($_GET['date']){
            $where .= " WHERE tanggal = '".$_GET['date']."'";
        } else {
            $distinct_date = $this->db->query("SELECT DISTINCT tanggal FROM tbl_covid_province ORDER BY tanggal DESC")->result_array();
            $tanggal = $distinct_date[0]['tanggal'];
            $where .= " WHERE tanggal = '".$tanggal."'";
        }
        
        $data_covid = $this->db->query(
            "select * from tbl_covid_province 
            inner join tbl_province ON tbl_province.province_id = tbl_covid_province.id_province ".$where )->result();

        if(count($data_covid) > 0) {
            $data['kmeans']  = $this->M_kmeans->kmeans_2($data_covid);
        } else {
            $data['kmeans']  = null;
        }
        $data['v_content']  = 'member/covid/kmeans';
        $this->load->view('member/layout', $data);
    }


}
