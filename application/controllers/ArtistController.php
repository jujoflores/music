<?php

class ArtistController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        //        $this->_redirect('Artist/info');
    }
    
    public function infoAction(){
    	$request = $this->getRequest();
    	$name = $request->getParam('name');
    	$artist = new Application_Model_WebservicesAudioscrobbler();
    	$this->view->artist = $artist->getArtistInformation($name);
    }
}
