<?php
class Application_Model_Chart {
	private $dataSource;
	
	function __construct(){
	}
	
	public function setDataSource(Webservices_Adapter_Chart $adapter){
		$this->dataSource = $adapter;
	}
	
	public function getTopArtists(){
		return $this->dataSource->getTopArtists();
	}
	
	public function getTopSongs(){
		return $this->dataSource->getTopSongs();
	}
}