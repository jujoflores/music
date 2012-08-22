<?php
class Application_Model_Song_Repository implements Application_Model_Song_Interface{
	
	private $dataSource;
	
	function __construct(){
	}

	public function setDataSource(Application_Model_Song_Interface $datasource){
		$this->dataSource = $datasource;
	}

	public function getTopSongs(){
		return $this->dataSource->getTopSongs();
	}
}