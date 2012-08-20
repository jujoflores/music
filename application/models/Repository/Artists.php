<?php
class Application_Model_Repository_Artists {
	
	private $dataSource;
	
	function __construct(){
	}
	
	public function setDataSource(Webservices_Adapter_Artist $adapter){
		$this->dataSource = $adapter;
	}
	
	public function getArtistInformation(Application_Model_Artist $artist){
		return $this->dataSource->getInformation($artist->getName());
	}
	
	public function getArtistTopAlbums(Application_Model_Artist $artist){
		return $this->dataSource->getTopAlbums($artist->getName());
	}
	
	public function getArtistTopSongs(Application_Model_Artist $artist){
		return $this->dataSource->getArtistTopSongs($artist->getName());
	}
	
	public function getTopArtists(){
		return $this->dataSource->getTopArtists();
	}
}