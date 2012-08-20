<?php
class Resources_Webservices_LastFM implements Resources_Webservices_Adapter_Artist, Resources_Webservices_Adapter_Chart{
	
	private $config;
	
	public function __construct($config){
		$this->config = $config;
	}
	
	public function getInformationByArtist($artistName){
		$curl = new Resources_Http_CurlAdapter(new Resources_Url_Builder($this->config->get('url')));
		$curl->getBuilder()->format($this->config->get('format'))
			->api_key($this->config->get('apiKey')) 
			->method('artist.getInfo')
			->artist($artistName);
		$jsonArtist = $curl->execute();

		$jsonArtist = $jsonArtist['artist'];

		$artist = new Application_Model_Artist();
    	$artist->setName($jsonArtist['name']);
    	$artist->setBiography($jsonArtist['bio']['content']);
		if(isset($jsonArtist['image'])){
	    	foreach($jsonArtist['image'] as $image){
	    		$artist->setImage($image['size'], $image['#text']);
			}
		}

        return $artist;
	}

	public function getTopAlbumsByArtist($artistName){
		$curl = new Resources_Http_CurlAdapter(new Resources_Url_Builder($this->config->get('url')));
		$curl->getBuilder()->format($this->config->get('format'))
			->api_key($this->config->get('apiKey')) 
			->method('artist.getTopAlbums')
			->artist($artistName)
			->limit($this->config->get('limitArtistTopAlbums'));
		$jsonArtistTopAlbums = $curl->execute();
			
    	foreach($jsonArtistTopAlbums['topalbums']['album'] as $position => $jsonArtistTopAlbums){
    		$album = new Application_Model_Album();
    		$album->setPosition(++$position);
    		$album->setName($jsonArtistTopAlbums['name']);
    		$album->setPlaycount($jsonArtistTopAlbums['playcount']);
			if(isset($jsonArtistTopAlbums['image'])){
		    	foreach($jsonArtistTopAlbums['image'] as $image){
		    		$album->setImage($image['size'], $image['#text']);
				}
			}

			$artist = new Application_Model_Artist();
    		$artist->setName($jsonArtistTopAlbums['artist']['name']);
    		$album->setArtist($artist);

    		$topAlbums[] = $album;    		 
    	}
    	
        return $topAlbums;
	}
	
	public function getTopSongsByArtist($artistName){
		$curl = new Resources_Http_CurlAdapter(new Resources_Url_Builder($this->config->get('url')));
		$curl->getBuilder()->format($this->config->get('format'))
			->api_key($this->config->get('apiKey')) 
			->method('artist.getTopTracks')
			->artist($artistName)
			->limit($this->config->get('limitArtistTopSongs')); 
		$jsonArtistTopSongs = $curl->execute();

    	foreach($jsonArtistTopSongs['toptracks']['track'] as $position => $jsonArtistTopSongs){
    		$song = new Application_Model_Song();
    		$song->setPosition(++$position);
    		$song->setName($jsonArtistTopSongs['name']);
    		$song->setListeners($jsonArtistTopSongs['listeners']);

			if(isset($jsonArtistTopSongs['image'])){
		    	foreach($jsonArtistTopSongs['image'] as $image){
		    		$song->setImage($image['size'], $image['#text']);
				}
			}

    		$artist = new Application_Model_Artist();
    		$artist->setName($jsonArtistTopSongs['artist']['name']);
    		$song->setArtist($artist);

    		$topSongs[] = $song;    		 
    	}
    	
        return $topSongs;
	}
	
	public function getTopArtists(){
    	$topArtists = array();
		$curl = new Resources_Http_CurlAdapter(new Resources_Url_Builder($this->config->get('url')));
		$curl->getBuilder()->format($this->config->get('format'))
			->api_key($this->config->get('apiKey')) 
			->method('chart.getTopArtists')
			->limit($this->config->get('limitTopArtists')); 
    	$jsonArtists = $curl->execute();
			
    	foreach($jsonArtists['artists']['artist'] as $position => $jsonArtist){
    		$artist = new Application_Model_Artist();
    		$artist->setName($jsonArtist['name']);
    		$artist->setPosition(++$position);
    		$artist->setListeners($jsonArtist['listeners']);
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
		$curl = new Resources_Http_CurlAdapter(new Resources_Url_Builder($this->config->get('url')));
		$curl->getBuilder()->format($this->config->get('format'))
			->api_key($this->config->get('apiKey')) 
    		->method('chart.getTopTracks')
			->limit($this->config->get('limitTopSongs'));
    	$jsonSongs = $curl->execute();

    	foreach($jsonSongs['tracks']['track'] as $position => $jsonSong){
    		$song = new Application_Model_Song();
    		$song->setName($jsonSong['name']);
    		$artist = new Application_Model_Artist();
    		$artist->setName($jsonSong['artist']['name']);
    		$song->setArtist($artist);
    		$song->setPosition(++$position);
    		$song->setListeners($jsonSong['listeners']);
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