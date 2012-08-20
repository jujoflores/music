<?php
class Resources_Http_CurlAdapter extends Zend_Http_Client{ 

	private $builder;
	
	private function isFormat($format){
		if($this->builder->getParameter('format') == $format){
			return true;
		}
		return false;
	}
	
	private function formatResponse($response){
		if($this->isFormat('json')){
			return Zend_Json_Decoder::decode($response);	
		}
		return $response;
	}
	
	public function __construct($builder){
		$config = array(
			'adapter' => 'Zend_Http_Client_Adapter_Curl',
    		'curloptions' => array(CURLOPT_RETURNTRANSFER => true));
		parent::__construct(null, $config);
		$this->builder = $builder;
	}
	
	public function getBuilder(){
		return $this->builder;
	}
	
	public function execute(){
		parent::setUri($this->builder->getUrl());
		return $this->formatResponse($this->request()->getBody());
	}
}