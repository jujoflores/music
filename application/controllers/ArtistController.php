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

    	$repository = new Application_Model_Repository_Artists();
        $repository->setDataSource(
        	new Resources_Webservices_LastFM($this->webserviceConfig->lastfm));

    	$this->view->artist = $repository->getInformationByArtist($artist);
    	$this->view->topAlbums = $repository->getTopAlbumsByArtist($artist);
    	$this->view->topSongs = $repository->getTopSongsByArtist($artist);
    }
}