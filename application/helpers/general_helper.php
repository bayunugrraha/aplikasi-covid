<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('vd'))
{
		
		function vd($data){
			echo "<pre>";
			var_dump($data);
			echo "</pre>";
			die;
		}
}
if ( ! function_exists('debugCode')){
	function debugCode($r=array(),$f=TRUE){
	  echo "<pre>";
	  print_r($r);
	  echo "</pre>";

	  if($f==TRUE) 
	     die;
	}
}

if( ! function_exists('getRandomWord')){
	function getRandomWord($len = 10) {
	    $word = array_merge(range('a', 'z'), range('A', 'Z'));
	    shuffle($word);
	    return substr(implode($word), 0, $len);
	}
}

if( ! function_exists('ai_url')){
	function ai_url($len = 10) {
	    // $url = "http://103.101.224.73:1000";
		$url = "http://api-dev.aipos.co.id";
	    return $url;
	}
}

if( ! function_exists('sKey')){
	function sKey($par = "") {
		if ($par <> "") {
			$keyword = str_replace(" ", "%20", $par);
		}else{
			$keyword = "";
		}
		return $keyword;
	}
}

if ( ! function_exists('okHeader')) {
	function okHeader($dataArray){
		foreach ($dataArray as $key => $value) {
			$hresponse[$key] = $value;
		}
		return $hresponse;
	}
}

if ( ! function_exists('okHeader')) {
	function decodeData($paging){
		$result = json_decode($paging);
		return $result;
	}

}

if ( ! function_exists('status_return')) {
	function status_return($status,$msg){
		return json_encode(array("status" => $status , "msg" => $msg));		
	}
}


if ( ! function_exists('checkSideBar')) {
	function checkSideBar($session,$name = "",$second = ""){
		$side = "";
        $CI =& get_instance();    
		$side = $CI->session->$session;
		
		if (empty($second)) {
			return $side[$name];
		}else{
			return $side[$name][$second];
		}
	}
}

if(!function_exists('add_date')) {
   function add_date($date) {
		$date = date_create($date);
		$date = date_format($date,"Y-m-d");
		return $date;
   }
}

if(!function_exists('dateFormat')) {
   function dateFormat($date) {
		$date = date_create($date);
		$date = date_format($date,"Y/m/d");
		return $date;
   }
}

if(!function_exists('status')) {
   function status($data) {
		if($data == '1'){
			$status = '<label style="color:red;">Inactive</label>';
		}else{
			$status = '<label style="color:green;">Active</label>';
		}
		return $status;
   }
}

if(!function_exists('status_word')) {
   function status_word($data) {
		if($data == 'Active'){
			$status = '<label style="color:green;">Active</label>';
		}else{
			$status = '<label style="color:red;">Inactive</label>';
		}
		return $status;
   }
}

if( ! function_exists('sNominal')){
	function sNominal($par = "") {
		if ($par <> "") {
			$keyword = str_replace(",", "", $par);
		}else{
			$keyword = "";
		}
		return $keyword;
	}
}


if( ! function_exists('chCheck')){
	function chCheck($par1, $par2, $par3, $par4 = "") {
		if ($par1 == $par2) {
			$return = $par3;
		}else{
			if ($par4 <> "") {
				$return = $par4;
			}else{
				$return = "";
			}
		}
		return $return;
	}
}

if( ! function_exists('sNilai')){
	function sNilai($par = "") {
		if ($par <> "") {
			$keyword = str_replace(".", "", $par);
		}else{
			$keyword = "";
		}
		return $keyword;
	}
}

if ( ! function_exists('getLoginData')) {
	function getLoginData($param=null){
		$side = "";
        $CI =& get_instance();    
		$side = $CI->session->sessionData;
		// var_dump($side);
		if($side){
			//debugCode($side);
		if($param==null){
			return $side;
		}else{
			return $side[$param];
		}
		}else{

		return false;
		}
	}
}


function generate_radio($data,$name){
	$str = '[{"caption":"Female","value":"F"},{"caption":"Male","value":"M"}]';
	$str = $data;
	$to_json = json_decode($str,true);
	$str_radio="";
	$id=rand(10,900);
	foreach ($to_json as  $value) {
		$id++;
		# code...
		$str_radio.="<input class='form-control formInput1' id='radio_".$id."' type='radio' name='".$name."' value='".$value['value']."' ><label for='radio_".$id."'>".$value['caption']."</label>";
	}
	return $str_radio;
}


function status_booking($isApprove, $bookingStatus){
	if ($isApprove == 0 AND $bookingStatus == 0) {
		$status = "Menunggu Konfirmasi";
	}elseif($isApprove == 1 AND $bookingStatus == 0){
		$status = "Di setujui";
	}elseif($isApprove == 2 AND $bookingStatus == 0){
		$status = "Di tolak";
	}else{
		$status = "Unknown";
	}
	return $status;
}

