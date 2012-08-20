<?php
class Music_Url_Builder{
	
	private $url;
	
	private function hasSchema($url){
		if(preg_match('@^http://|^https://@', $url)){
			return true;
		}
		return false;
	}
	
	private function hasQuestionMark(){
		if($this->url[strlen($this->url) - 1] === '?'){
			return true;
		}
		return false;
	}
	
	public function getParameter($name){
		$parameters = explode('&', $this->url);
		if(count($parameters)){
			foreach($parameters as $parameter){
				list($variable, $value) = explode('=', $parameter);
				if($variable == $name){
					return rawurldecode($value);
				}
			}
		}
		return false;
	}

	public function __construct($url){
		if(!$this->hasSchema($url)){
			$this->url = 'http://';
		}
		
		$this->url .= $url;

		if(!$this->hasQuestionMark()){
			$this->url .= '?';
		}
	}
	
	public function getUrl(){
		return $this->url;
	}	
	
	public function __call($method, $arguments){
		$this->url .= "&{$method}=" . rawurlencode($arguments[0]);
		return $this;
	}	
}