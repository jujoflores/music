<?php

class IndexController extends Zend_Controller_Action
{
	private $webserviceConfig;
	
    public function init()
    {
    	$this->webserviceConfig = Zend_Registry::get('webserviceConfig');
    }

    public function indexAction()
    {
        $artistRepository = new Application_Model_Repository_Artists();
        $artistRepository->setDataSource(
        	new Resources_Webservices_LastFM($this->webserviceConfig->lastfm));

        $songRepository = new Application_Model_Repository_Songs();
        $songRepository->setDataSource(
        	new Resources_Webservices_LastFM($this->webserviceConfig->lastfm));

        $this->view->topArtists = $artistRepository->getTopArtists();
        $this->view->topSongs = $songRepository->getTopSongs();
    }
}