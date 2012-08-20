<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        //$this->_redirect('Artist/info');
        $webservicesAudioScrobbler = new Application_Model_WebservicesAudioscrobbler(); 
        $this->view->topArtists = $webservicesAudioScrobbler->getTopArtists();
        $this->view->topSongs = $webservicesAudioScrobbler->getTopSongs();
    }	
}

