<?php
class Webservices_Audioscrobbler implements Webservices_Adapter_WebserviceInterface{
	
	private $config;
	
	public function __construct($config){
		$this->config = $config;
	}
	
	private function createWebserviceUrl($method, $parameters){
		return $this->config->get('url') 
			. 'format=' . $this->config->get('format') 
			. '&api_key=' . $this->config->get('apiKey')
			. '&method=' . $method . $parameters;
	}
	
	private function setImages($object, $images){
		if(count($images)){
	    	foreach($images as $image){
	    		$object->setImage($image['size'], $image['#text']);
			}
		}
	}
	
	public function getTopArtists(){
    	$topArtists = array();
    	$urlTopArtists = $this->createWebserviceUrl('chart.gettopartists', "&limit={$this->config->get('limitTopArtists')}");
		$jsonArtists = Music_GetUrl::curl($urlTopArtists, $this->config->get('format'));
		
    	foreach($jsonArtists['artists']['artist'] as $position => $jsonArtist){
    		$artist = new Application_Model_Artist();
    		$artist->setName($jsonArtist['name']);
    		$artist->setPosition(++$position);
    		$artist->setListeners($jsonArtist['listeners']);
    		$this->setImages($artist, $jsonArtist['image']);
    		
    		$topArtists[] = $artist;    		 
    	}
    	
        return $topArtists;
	}
	
	public function getTopSongs(){
    	$topSongs = array();
    	$urlTopSongs = $this->createWebserviceUrl('chart.gettoptracks', "&limit={$this->config->get('limitTopSongs')}");
    	$jsonSongs = Music_GetUrl::curl($urlTopSongs, $this->config->get('format'));
		
    	foreach($jsonSongs['tracks']['track'] as $position => $jsonSong){
    		$song = new Application_Model_Song();
    		$song->setName($jsonSong['name']);
    		$artist = new Application_Model_Artist();
    		$artist->setName($jsonSong['artist']['name']);
    		$song->setArtist($artist);
    		$song->setPosition(++$position);
    		$song->setListeners($jsonSong['listeners']);
    		$this->setImages($song, $jsonSong['image']);
    		
    		$topSongs[] = $song;    		 
    	}
    	
        return $topSongs;
	}

	public function getArtistInformation($artistName){
		$urlArtist = $this->createWebserviceUrl('artist.getinfo', '&artist=' . urlencode($artistName));
		$jsonArtist = Music_GetUrl::curl($urlArtist, $this->config->get('format'));
		$jsonArtist = $jsonArtist['artist']; 
		$artist = new Application_Model_Artist();
    	$artist->setName($jsonArtist['name']);
    	$artist->setBiography($jsonArtist['bio']['content']);
    	$this->setImages($artist, $jsonArtist['image']);
    	    	
        return $artist;
	} 
}