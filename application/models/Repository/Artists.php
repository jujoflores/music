<?php
class Application_Model_Repository_Artists {
	
	private $dataSource;
	
	function __construct(){
	}
	
	public function setDataSource(Resources_Webservices_Adapter_Artist $adapter){
		$this->dataSource = $adapter;
	}
	
	public function getInformationByArtist(Application_Model_Artist $artist){
		return $this->dataSource->getInformationByArtist($artist->getName());
	}
	
	public function getTopAlbumsByArtist(Application_Model_Artist $artist){
		return $this->dataSource->getTopAlbumsByArtist($artist->getName());
	}
	
	public function getTopSongsByArtist(Application_Model_Artist $artist){
		return $this->dataSource->getTopSongsByArtist($artist->getName());
	}
	
	public function getTopArtists(){
		return $this->dataSource->getTopArtists();
	}
}