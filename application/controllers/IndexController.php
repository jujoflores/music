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
        $artist = new Webservices_Artist_Adapter(
        	new Webservices_Artist_Lastfm($this->webserviceConfig->lastfm));
        $song = new Webservices_Song_Adapter(
        	new Webservices_Song_Lastfm($this->webserviceConfig->lastfm));

        $this->view->topArtists = $artist->getTop();
        $this->view->topSongs = $song->getTop();
    }	
}