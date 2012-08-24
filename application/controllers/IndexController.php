<?php
use Application\Model\Artist;
use Application\Model\Artist\Repository as ArtistRepository;
use Application\Model\Song\Repository as SongRepository;
use Resources\DataSource\Webservices\LastFM as DataSource;

class IndexController extends Zend_Controller_Action
{
	private $webserviceConfig;
	
    public function init()
    {
    	$this->webserviceConfig = Zend_Registry::get('webserviceConfig');
    }

    public function indexAction()
    {
		$config = $this->webserviceConfig->lastfm->merge(Zend_Registry::get('defaultImages'));
    	$config->setReadOnly();

        $artistRepository = new ArtistRepository();
        $artistRepository->setDataSource(new DataSource($config));

        $songRepository = new SongRepository();
        $songRepository->setDataSource(new DataSource($config));

        $this->view->topArtists = $artistRepository->getTopArtists();
        $this->view->topSongs = $songRepository->getTopSongs();
    }
}