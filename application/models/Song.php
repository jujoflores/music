<?php
class Application_Model_Song {
	
	private $position;
	private $name;
	private $artist;
	private $listeners;
	private $image = array();
	
	function __construct(){
	}
	
	public function getPosition(){
		return $this->position;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getArtist(){
		return $this->artist;
	}
	
	public function getListeners(){
		return $this->listeners;
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
	
	public function setArtist($artist){
		$this->artist = $artist;
	}
	
	public function setListeners($listeners){
		$this->listeners = $listeners;
	}
	
	public function setImage($size, $image){
		$this->image[$size] = $image;
	}	

	public function hasImageSize($size){
		return isset($this->image[$size]);
	}
}