<?php

class M_login extends CI_Model {

    function checkLogin($username,$password){
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get();
        if($query->num_rows()>0){
			$querycheck = $query->row();
			$dataArr = array(
				'UserID'    	=> $querycheck->admin_id,
				'Username'  	=> $querycheck->username,
				'project_name' 	=> 'CLUSTERING ANALYSIS COVID 19',
				'copyright' 	=> '&copy; 2020'
			);
			$this->session->set_userdata('loginData',$dataArr);
            return true;    
        }else{
			$this->session->set_flashdata('GagalLogin', 'Ya');    
            return false;
        }  
    }
}
