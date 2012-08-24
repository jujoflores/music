<?php
namespace Application\Model\Song;
use Resources\DataSource\Song as SongDataSource;

class Repository implements SongDataSource {
	
	private $dataSource;
	
	function __construct(){
	}

	public function setDataSource(SongDataSource $datasource){
		$this->dataSource = $datasource;
	}

	public function getTopSongs(){
		return $this->dataSource->getTopSongs();
	}
}