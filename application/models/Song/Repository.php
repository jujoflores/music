<?php
namespace Application\Model\Song;
use Resources\DataSource\Song as DataSource;

class Repository implements DataSource {
	
	private $dataSource;
	
	function __construct(){
	}

	public function setDataSource(DataSource $datasource){
		$this->dataSource = $datasource;
	}

	public function getTopSongs(){
		return $this->dataSource->getTopSongs();
	}
}