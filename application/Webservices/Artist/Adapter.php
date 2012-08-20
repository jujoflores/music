<?php
class Webservices_Artist_Adapter{

	private $adapter;
	
	public function __construct(Webservices_Artist_Interface $adapter){
		$this->adapter = $adapter;
	}
	
	public function getTop(){
		return $this->adapter->getTop();
	}
	
	public function getInformation($artistName){
		return $this->adapter->getInformation($artistName);
	}

	public function getTopAlbums($artistName){
		return $this->adapter->getTopAlbums($artistName);
	}
	
	public function getTopSongs($artistName){
		return $this->adapter->getTopSongs($artistName);
	}
}