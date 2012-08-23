<?php
namespace Resources\Webservices;
use Application\Model\Album;
use Application\Model\Artist;
use Application\Model\Artist\IArtist;
use Application\Model\Song;
use Application\Model\Song\ISong;
use Resources\Http\CurlAdapter;
use Resources\Url\Builder;

class LastFM implements IArtist, ISong {

	private $config;
	private $baseUrl;
	
	public function __construct($config){
		$this->config = $config;
		$this->baseUrl = \Zend_Layout::getMvcInstance()->getView()->baseUrl();
	}
	
	public function getInformationByArtist(Artist $artist){
		$curl = new CurlAdapter(new Builder($this->config->get('url')));
		$curl->getBuilder()->format($this->config->get('format'))
			->api_key($this->config->get('apiKey')) 
			->method('artist.getInfo')
			->artist($artist->getName());
		$jsonArtist = $curl->execute();

		$jsonArtist = $jsonArtist['artist'];
    	$artist->setBiography($jsonArtist['bio']['content']);
    	$artist->setDefaultImage($this->baseUrl . $this->config->defaultImage->get('artist'));
		if(isset($jsonArtist['image'])){
	    	foreach($jsonArtist['image'] as $image){
	    		$artist->setImage($image['size'], $image['#text']);
			}
		}

        return $artist;
	}

	public function getTopAlbumsByArtist(Artist $artist){
		$curl = new CurlAdapter(new Builder($this->config->get('url')));
		$curl->getBuilder()->format($this->config->get('format'))
			->api_key($this->config->get('apiKey')) 
			->method('artist.getTopAlbums')
			->artist($artist->getName())
			->limit($this->config->get('limitArtistTopAlbums'));
		$jsonArtistTopAlbums = $curl->execute();
			
    	foreach($jsonArtistTopAlbums['topalbums']['album'] as $position => $jsonArtistTopAlbums){
    		$album = new Album();
    		$album->setPosition(++$position);
    		$album->setName($jsonArtistTopAlbums['name']);
    		$album->setPlaycount($jsonArtistTopAlbums['playcount']);
    		$album->setDefaultImage($this->baseUrl . $this->config->defaultImage->get('album'));
			if(isset($jsonArtistTopAlbums['image'])){
		    	foreach($jsonArtistTopAlbums['image'] as $image){
		    		$album->setImage($image['size'], $image['#text']);
				}
			}

    		$album->setArtist($artist);
    		$topAlbums[] = $album;	 
    	}

        return $topAlbums;
	}
	
	public function getTopSongsByArtist(Artist $artist){
		$curl = new CurlAdapter(new Builder($this->config->get('url')));
		$curl->getBuilder()->format($this->config->get('format'))
			->api_key($this->config->get('apiKey')) 
			->method('artist.getTopTracks')
			->artist($artist->getName())
			->limit($this->config->get('limitArtistTopSongs')); 
		$jsonArtistTopSongs = $curl->execute();

    	foreach($jsonArtistTopSongs['toptracks']['track'] as $position => $jsonArtistTopSongs){
    		$song = new Song();
    		$song->setPosition(++$position);
    		$song->setName($jsonArtistTopSongs['name']);
    		$song->setListeners($jsonArtistTopSongs['listeners']);
			$song->setDefaultImage($this->baseUrl . $this->config->defaultImage->get('song'));
			if(isset($jsonArtistTopSongs['image'])){
		    	foreach($jsonArtistTopSongs['image'] as $image){
		    		$song->setImage($image['size'], $image['#text']);
				}
			}

    		$song->setArtist($artist);
    		$topSongs[] = $song;	 
    	}
    	
        return $topSongs;
	}
	
	public function getTopArtists(){
    	$topArtists = array();
		$curl = new CurlAdapter(new Builder($this->config->get('url')));
		$curl->getBuilder()->format($this->config->get('format'))
			->api_key($this->config->get('apiKey')) 
			->method('chart.getTopArtists')
			->limit($this->config->get('limitTopArtists')); 
    	$jsonArtists = $curl->execute();
			
    	foreach($jsonArtists['artists']['artist'] as $position => $jsonArtist){
    		$artist = new Artist();
    		$artist->setName($jsonArtist['name']);
    		$artist->setPosition(++$position);
    		$artist->setListeners($jsonArtist['listeners']);
    		$artist->setDefaultImage($this->baseUrl . $this->config->defaultImage->get('artist'));
			if(isset($jsonArtist['image'])){
		    	foreach($jsonArtist['image'] as $image){
		    		$artist->setImage($image['size'], $image['#text']);
				}
			}

    		$topArtists[] = $artist;    		 
    	}

        return $topArtists;
	}

	public function getTopSongs(){
    	$topSongs = array();
		$curl = new CurlAdapter(new Builder($this->config->get('url')));
		$curl->getBuilder()->format($this->config->get('format'))
			->api_key($this->config->get('apiKey')) 
    		->method('chart.getTopTracks')
			->limit($this->config->get('limitTopSongs'));
    	$jsonSongs = $curl->execute();

    	foreach($jsonSongs['tracks']['track'] as $position => $jsonSong){
    		$song = new Song();
    		$song->setName($jsonSong['name']);
    		$artist = new Artist();
    		$artist->setName($jsonSong['artist']['name']);
    		$song->setArtist($artist);
    		$song->setPosition(++$position);
    		$song->setListeners($jsonSong['listeners']);
    		$song->setDefaultImage($this->baseUrl . $this->config->defaultImage->get('song'));
			if(isset($jsonSong['image'])){
		    	foreach($jsonSong['image'] as $image){
		    		$song->setImage($image['size'], $image['#text']);
				}
			}

    		$topSongs[] = $song;    		 
    	}

        return $topSongs;
	}
}