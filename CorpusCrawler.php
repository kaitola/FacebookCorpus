<?php
require_once('facebook-php-sdk-v4-5.0-dev/src/Facebook/autoload.php');
require_once 'constant.php';

//20171024
//@Author: Matt
class CorpusCrawler{

	public function __construct(){
		

	}

	public function curlHttpRequest($url){

		$connect = curl_init();
		curl_setopt($connect, CURLOPT_URL, $url);
		curl_setopt($connect, CURLOPT_HEADER, false);
		$result = curl_exec($connect);

		return $result;
	}




}

?>