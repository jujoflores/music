<?php

class IndexController extends Zend_Controller_Action
{
	private $webserviceConfig;
	
    public function init()
    {
    	$this->webserviceConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'webservices');
    }

    public function indexAction()
    {
        $webservice = new Webservices_Adapter_WebserviceAdapter(
        	new Webservices_Audioscrobbler($this->webserviceConfig->audioscrobbler)); 
        $this->view->topArtists = $webservice->getTopArtists();
        $this->view->topSongs = $webservice->getTopSongs();
    }	
}