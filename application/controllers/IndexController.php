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
		$configlastFM = $this->webserviceConfig->lastfm->merge(Zend_Registry::get('defaultImages'));
    	$configlastFM->setReadOnly();

        $artistRepository = new Application_Model_Artist_Repository();
        $artistRepository->setDataSource(
        	new Resources_Webservices_LastFM($configlastFM));

        $songRepository = new Application_Model_Song_Repository();
        $songRepository->setDataSource(
        	new Resources_Webservices_LastFM($configlastFM));

        $this->view->topArtists = $artistRepository->getTopArtists();
        $this->view->topSongs = $songRepository->getTopSongs();
    }
}