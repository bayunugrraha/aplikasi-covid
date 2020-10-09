<?php

class M_umum extends CI_Model {
	function __construct() {
        parent::__construct();
		if(!$this->session->userdata('loginData')){
            redirect('login');
        }
        
    }

	
	function generatePesan($pesan, $type) {
        if ($type == "berhasil") {
            $str = '<div class="alert alert-block alert-success">
                        <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                        </button>

                        <!--<i class="ace-icon fa fa-check green"></i>-->
                        '.$pesan.'
                    </div>';
        } elseif($type=="gagal") {
            $str = '<div class="alert alert-block alert-danger">
                        <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                        </button>

                        <!--<i class="ace-icon fa fa-times red"></i>-->
                        '.$pesan.'
                    </div>';
        }else{
            $str = '<div class="alert alert-block alert-warning">
                        <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                        </button>

                        
                        '.$pesan.'
                    </div>';
        }
        
        $this->session->set_flashdata('msgbox',$str);

		return $str;
    }


    function sendWhatsAppMessage($toNumber,$message){
        $key = '9bd664161dc8bcad0c28c30300b86853';
        $secret = 'c65e4abf04cc85a523923a48712f54b6';
        $message = urlencode($message);
        $urlPair = "http://128.199.178.179/whatapi/api/send_message?nomor=".$toNumber."&pesan=".$message."&secret=".$secret."&key=".$key."";
        $exe  = json_decode(file_get_contents($urlPair));
        $status       = $exe->success;

        if($status==1){
            return true;
        }else{
            return false;
        }
        //return $status;

    }
	
	
    function formatTanggal($datetime,$format='d/m/Y'){

        $time = strtotime($datetime);
        $myFormatForView = date($format, $time);
        return $myFormatForView;
    
    }
	
	
}
