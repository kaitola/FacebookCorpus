<?php

//20171028
//@Author: Matt
class JsonParser{

	private $url;
	private $jsonString;
	private $jsonObject;

	private $pageNumber;

	public $nextArray = array();
	public $objectArray = array();

	public function __construct($url){

		$this->url = $url;
		$this->getNextPageUrl($this->url, 1, 5);

		//var_dump($this->nextlink);

	}

	//facebook 回傳json資料下一筆連結的遞迴模型
	//
	function getNextPageUrl($url, $page, $depth){

		$Object = $this->getJsonObject($url);
		$this->objectArray[$page] = $Object;
		$this->nextArray[$page] = $Object->paging->next;

		if($page >= $depth){
			return;
		}

		$this->getNextPageUrl($Object->paging->next, $page + 1, $depth);

	}

	function getJsonObject($url){
	  
	  	$jsonString = file_get_contents($url);
		$jsonObject = json_decode($jsonString);
		return $jsonObject;
	}

}

?>