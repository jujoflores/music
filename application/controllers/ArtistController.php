<?php

class ArtistController extends Zend_Controller_Action
{
	private $webserviceConfig;
	
    public function init()
    {
    	$this->webserviceConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'webservices');
    }

    public function indexAction()
    {
        //$this->_redirect('Artist/info');
    }
    
    public function infoAction(){
    	$request = $this->getRequest();
    	$name = $request->getParam('name');
        $webservice = new Webservices_Adapter_WebserviceAdapter(
        	new Webservices_Audioscrobbler($this->webserviceConfig->audioscrobbler)); 
    	$this->view->artist = $webservice->getArtistInformation($name);
    }
}