<?php
class Webservices_Song_Adapter{

	private $adapter;
	
	public function __construct(Webservices_Song_Interface $adapter){
		$this->adapter = $adapter;
	}
	
	public function getTop(){
		return $this->adapter->getTop();
	}
}