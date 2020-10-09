<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_covid extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getAll(){
		$this->db->select("*");
		$this->db->from("tbl_data_covid");
		$this->db->join("tbl_province","tbl_province.province_id = tbl_data_covid.id_province");
		$this->db->join("tbl_city","tbl_city.city_id = tbl_data_covid.id_kota");
		//$this->db->limit(100);
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getListPenggunaId($id){
		$this->db->select("*");
		$this->db->from("tbl_admin");
		$this->db->where("admin_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}
}