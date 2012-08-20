<?php
class Resources_Url_Builder{
	
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
		list($url, $query) = explode('?', $this->url);
		$parameters = explode('&', $query);
		if(count($parameters)){
			foreach($parameters as $parameter){
				if($parameter){
					list($variable, $value) = explode('=', $parameter);
					if($variable == $name){
						return rawurldecode($value);
					}
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