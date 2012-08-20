<?php
class Music_UrlGenerator{
	
	private $url;
	private $savedUrl;
	
	private function validateProtocol($url){
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
	
	private function getParameter($name){
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

	private function formatResponse($response){
		if($this->getParameter('format') == 'json'){
			return json_decode($response, true);	
		}
		return $response;
	}
	
	public function __construct($url){
		if(!$this->validateProtocol($url)){
			$this->url = 'http://';
		}
		$this->url .= $url;

		if(!$this->hasQuestionMark()){
			$this->url .= '?';
		}
	}
	
	public function __call($method, $arguments){
		$this->url .= "&{$method}=" . rawurlencode($arguments[0]);
		return $this;
	}
	
	public function __toString(){
		return $this->url;
	}
	
	public function save(){
		$this->savedUrl = $this->url;
	}
	
	public function restart(){
		$this->url = $this->savedUrl;
		return $this;
	}
	
	public function execute(){
		$curlHandler = curl_init(); 
		curl_setopt($curlHandler, CURLOPT_URL, $this->url); 
		curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true); 
		$response = curl_exec($curlHandler);
		return $this->formatResponse($response);		
	}
}
