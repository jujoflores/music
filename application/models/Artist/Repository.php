<?php
class Application_Model_Artist_Repository implements Application_Model_Artist_Interface{
	
	private $dataSource;
	
	function __construct(){
	}
	
	public function setDataSource(Application_Model_Artist_Interface $datasource){
		$this->dataSource = $datasource;
	}
	
	public function getInformationByArtist(Application_Model_Artist $artist){
		return $this->dataSource->getInformationByArtist($artist);
	}
	
	public function getTopAlbumsByArtist(Application_Model_Artist $artist){
		return $this->dataSource->getTopAlbumsByArtist($artist);
	}
	
	public function getTopSongsByArtist(Application_Model_Artist $artist){
		return $this->dataSource->getTopSongsByArtist($artist);
	}
	
	public function getTopArtists(){
		return $this->dataSource->getTopArtists();
	}
}