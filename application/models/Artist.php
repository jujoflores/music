<?php
class Application_Model_Artist {
	private $position;
	private $name;
	private $listeners;
	private $biography;
	private $dataSource;
	private $image = array();
	
	function __construct(){
	}
	
	public function getPosition(){
		return $this->position;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getListeners(){
		return $this->listeners;
	}
	
	public function getBiography(){
		return $this->biography;
	}
	
	public function getImage($size){
		return $this->image[$size];
	}

	public function setPosition($position){
		$this->position = $position;
	}
	
	public function setName($name){
		$this->name = $name;
	}
	
	public function setListeners($listeners){
		$this->listeners = $listeners;
	}
	
	public function setBiography($biography){
		return $this->biography = $biography;
	}
	
	public function setImage($size, $image){
		$this->image[$size] = $image;
	}
	
	public function setDataSource(Webservices_Adapter_Artist $adapter){
		$this->dataSource = $adapter;
	}
	
	public function getInformation(){
		return $this->dataSource->getInformation($this->name);
	}
	
	public function getTopAlbums(){
		return $this->dataSource->getTopAlbums($this->name);
	}
	
	public function getArtistTopSongs(){
		return $this->dataSource->getArtistTopSongs($this->name);
	}
}