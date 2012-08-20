<?php

class ArtistController extends Zend_Controller_Action
{
	private $webserviceConfig;
	
    public function init()
    {
    	$this->webserviceConfig = Zend_Registry::get('webserviceConfig');
    }

    public function indexAction()
    {
    }
    
    public function infoAction(){
    	$request = $this->getRequest();
    	$name = $request->getParam('name');
    	
        $artist = new Webservices_Artist_Adapter(
        	new Webservices_Artist_Lastfm($this->webserviceConfig->lastfm));

    	$this->view->artist = $artist->getInformation($name);
    	$this->view->topAlbums = $artist->getTopAlbums($name);
    	$this->view->topSongs = $artist->getTopSongs($name);
    }
}