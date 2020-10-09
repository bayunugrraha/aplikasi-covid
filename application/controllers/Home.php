<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('M_kmeans');
    }

    public function index()
	{
        $where = "";

        if($_GET['date']){
			$data['tanggal'] = $_GET['date'];
            $where .= " WHERE tanggal = '".$data['tanggal']."'";
        } else {
            $distinct_date = $this->db->query("SELECT DISTINCT tanggal FROM tbl_covid_province ORDER BY tanggal DESC")->result_array();
            $tanggal = $distinct_date[0]['tanggal'];
			$where .= " WHERE tanggal = '".$tanggal."'";
			$data['tanggal'] = null;
        }
        
        $data_covid = $this->db->query(
            "select * from tbl_covid_province 
            inner join tbl_province ON tbl_province.province_id = tbl_covid_province.id_province ".$where )->result();
        if(count($data_covid) > 0) {
			$kmeans  = $this->M_kmeans->kmeans_2($data_covid);
			$data_cluster = $kmeans['cluster']['dataCluster'];
			$data['last_iteration'] = array_pop($data_cluster);
        } else {
			$data['last_iteration'] = null;
        }
		
		$data['v_content'] = 'member/dashboard/content_baru';
		$this->load->view('member/layout_pengunjung',$data);
	}
       

}
