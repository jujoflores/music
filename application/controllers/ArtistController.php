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
    	
        $artist = new Application_Model_Artist();
        $artist->setName($name);
        $artist->setDataSource(
        	new Webservices_Lastfm($this->webserviceConfig->lastfm));

    	$this->view->artist = $artist->getInformation();
    	$this->view->topAlbums = $artist->getTopAlbums();
    	$this->view->topSongs = $artist->getArtistTopSongs();
    }
}