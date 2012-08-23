<?php
namespace Application\Model;

class Artist {
	
	private $position;
	private $name;
	private $listeners;
	private $biography;
	private $defaultImage;
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
	
	public function getDefaultImage(){
		return $this->defaultImage;
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
	
	public function setDefaultImage($defaultImage){
		$this->defaultImage = $defaultImage;
	}
	
	public function setImage($size, $image){
		$this->image[$size] = $image;
	}

	public function hasImage($size){
		return isset($this->image[$size]);
	}
	
	public function showImage($size){
		if($this->hasImage($size)){
			return $this->getImage($size);
		}
		
		return $this->getDefaultImage();
	}
}