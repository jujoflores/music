<?php
class Application_Model_Repository_Songs {
	
	private $dataSource;
	
	function __construct(){
	}
	
	public function setDataSource(Resources_Webservices_Adapter_Chart $adapter){
		$this->dataSource = $adapter;
	}
	
	public function getTopSongs(){
		return $this->dataSource->getTopSongs();
	}
}