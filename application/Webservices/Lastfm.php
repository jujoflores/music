<?php
class Webservices_Lastfm implements Webservices_Adapter_Artist, Webservices_Adapter_Chart{
	
	private $config;
	private $url;
	
	public function __construct($config){
		$this->config = $config;
		$this->url = new Music_UrlGenerator($this->config->get('url'));
		$this->url
			->format($this->config->get('format'))
			->api_key($this->config->get('apiKey'))
			->save();
	}
	
	public function getInformation($artistName){
		$jsonArtist = $this->url
			->restart()
			->method('artist.getInfo')
			->artist($artistName)
			->execute();

		$jsonArtist = $jsonArtist['artist'];
		 
		$artist = new Application_Model_Artist();
    	$artist->setName($jsonArtist['name']);
    	$artist->setBiography($jsonArtist['bio']['content']);
    	Music_Images::set($artist, $jsonArtist['image']);
    	    	
        return $artist;
	}
	
	public function getTopAlbums($artistName){
		$jsonArtistTopAlbums = $this->url
			->restart()
			->method('artist.getTopAlbums')
			->artist($artistName)
			->limit($this->config->get('limitArtistTopAlbums'))
			->execute(); 
		
    	foreach($jsonArtistTopAlbums['topalbums']['album'] as $position => $jsonArtistTopAlbums){
    		$album = new Application_Model_Album();
    		$album->setPosition(++$position);
    		$album->setName($jsonArtistTopAlbums['name']);
    		$album->setPlaycount($jsonArtistTopAlbums['playcount']);
    		Music_Images::set($album, $jsonArtistTopAlbums['image']);
    		
			$artist = new Application_Model_Artist();
    		$artist->setName($jsonArtistTopAlbums['artist']['name']);
    		$album->setArtist($artist);
    		
    		$topAlbums[] = $album;    		 
    	}
    	
        return $topAlbums;
	}
	
	public function getArtistTopSongs($artistName){
		$jsonArtistTopSongs = $this->url
			->restart()
			->method('artist.getTopTracks')
			->artist($artistName)
			->limit($this->config->get('limitArtistTopSongs'))
			->execute(); 
		
    	foreach($jsonArtistTopSongs['toptracks']['track'] as $position => $jsonArtistTopSongs){
    		$song = new Application_Model_Song();
    		$song->setPosition(++$position);
    		$song->setName($jsonArtistTopSongs['name']);
    		$song->setListeners($jsonArtistTopSongs['listeners']);
    		Music_Images::set($song, $jsonArtistTopSongs['image']);
    		
    		$artist = new Application_Model_Artist();
    		$artist->setName($jsonArtistTopSongs['artist']['name']);
    		$song->setArtist($artist);
    		
    		$topSongs[] = $song;    		 
    	}
    	
        return $topSongs;
	}
	
	public function getTopArtists(){
    	$topArtists = array();
		$jsonArtists = $this->url
			->restart()
			->method('chart.getTopArtists')
			->limit($this->config->get('limitTopArtists'))
			->execute(); 
		
    	foreach($jsonArtists['artists']['artist'] as $position => $jsonArtist){
    		$artist = new Application_Model_Artist();
    		$artist->setName($jsonArtist['name']);
    		$artist->setPosition(++$position);
    		$artist->setListeners($jsonArtist['listeners']);
    		Music_Images::set($artist, $jsonArtist['image']);
    		
    		$topArtists[] = $artist;    		 
    	}
    	
        return $topArtists;
	}
	
	public function getTopSongs(){
    	$topSongs = array();
    	$jsonSongs = $this->url
			->restart()
    		->method('chart.getTopTracks')
			->limit($this->config->get('limitTopSongs'))
			->execute();

    	foreach($jsonSongs['tracks']['track'] as $position => $jsonSong){
    		$song = new Application_Model_Song();
    		$song->setName($jsonSong['name']);
    		$artist = new Application_Model_Artist();
    		$artist->setName($jsonSong['artist']['name']);
    		$song->setArtist($artist);
    		$song->setPosition(++$position);
    		$song->setListeners($jsonSong['listeners']);
    		Music_Images::set($song, $jsonSong['image']);
    		
    		$topSongs[] = $song;    		 
    	}
    	
        return $topSongs;
	}
}
