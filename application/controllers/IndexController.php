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
        $chart = new Application_Model_Chart();
        $chart->setDataSource(
        	new Webservices_Lastfm($this->webserviceConfig->lastfm));

        $this->view->topArtists = $chart->getTopArtists();
        $this->view->topSongs = $chart->getTopSongs();
    }
}