<?php
class Application_Model_Album {
	
	private $position;
	private $name;
	private $artist;
	private $playcount;
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
	
	public function getPlaycount(){
		return $this->playcount;
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
	
	public function setPlaycount($playcount){
		$this->playcount = $playcount;
	}
	
	public function setImage($size, $image){
		$this->image[$size] = $image;
	}	
}