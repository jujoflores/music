<?php
namespace Application\Model\Song;

class Repository{
	
	private $dataSource;
	
	function __construct(){
	}

	public function setDataSource($datasource){
		$this->dataSource = $datasource;
	}

	public function getTopSongs(){
		return $this->dataSource->getTopSongs();
	}
}