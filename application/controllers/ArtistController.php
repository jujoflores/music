<?php
use Application\Model\Artist;
use Application\Model\Artist\Repository;
use Resources\Webservices\LastFM as Datasource;

class ArtistController extends \Zend_Controller_Action
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

    	$config = $this->webserviceConfig->lastfm->merge(Zend_Registry::get('defaultImages'));
    	$config->setReadOnly();

        $artist = new Artist();
        $artist->setName($name);

    	$repository = new Repository();
        $repository->setDataSource(new Datasource($config));

    	$this->view->artist = $repository->getInformationByArtist($artist);
    	$this->view->topAlbums = $repository->getTopAlbumsByArtist($artist);
    	$this->view->topSongs = $repository->getTopSongsByArtist($artist);
    }
}