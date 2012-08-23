<?php
namespace Application\Model\Song;

class Repository implements ISong{
	
	private $dataSource;
	
	function __construct(){
	}

	public function setDataSource(ISong $datasource){
		$this->dataSource = $datasource;
	}

	public function getTopSongs(){
		return $this->dataSource->getTopSongs();
	}
}