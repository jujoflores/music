<?php
namespace Application\Model\Artist;
use Application\Model\Artist;
use Resources\DataSource\Artist as DataSource;

class Repository implements DataSource {
	
	private $dataSource;
	
	function __construct(){
	}
	
	public function setDataSource(DataSource $datasource){
		$this->dataSource = $datasource;
	}
	
	public function getInformationByArtist(Artist $artist){
		return $this->dataSource->getInformationByArtist($artist);
	}
	
	public function getTopAlbumsByArtist(Artist $artist){
		return $this->dataSource->getTopAlbumsByArtist($artist);
	}
	
	public function getTopSongsByArtist(Artist $artist){
		return $this->dataSource->getTopSongsByArtist($artist);
	}
	
	public function getTopArtists(){
		return $this->dataSource->getTopArtists();
	}
}