<?php
class Webservices_Adapter_WebserviceAdapter{

	private $adapter;
	
	public function __construct(Webservices_Adapter_WebserviceInterface $adapter){
		$this->adapter = $adapter;
	}
	
	public function getTopArtists(){
		return $this->adapter->getTopArtists();
	}
	
	public function getTopSongs(){
		return $this->adapter->getTopSongs();
	}
	
	public function getArtistInformation($artistName){
		return $this->adapter->getArtistInformation($artistName);
	}
		
}