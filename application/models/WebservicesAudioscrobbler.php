<?php
define(WEBSERVICE_AUDIOSCROBBLER_URL, 'http://ws.audioscrobbler.com/2.0/?');
define(WEBSERVICE_FORMAT, 'json');
define(WEBSERVICE_API_KEY, 'b25b959554ed76058ac220b7b2e0a026');
define(LIMIT_TOP_ARTISTS, 10);
define(LIMIT_TOP_SONGS, 10);

class Application_Model_WebservicesAudioscrobbler {
	
	private $webserviceUrl;
	
	public function __construct(){
		 $this->webserviceUrl =  WEBSERVICE_AUDIOSCROBBLER_URL . 'format=' . WEBSERVICE_FORMAT . '&api_key=' . WEBSERVICE_API_KEY;
	}
	
	private function formatWebserviceResponse($webserviceResponse){
		if(WEBSERVICE_FORMAT == 'json'){
			return json_decode($webserviceResponse, true);	
		}else{
			return $webserviceResponse;
		}
	}
	
	private function consumeWebservice($method, $parameters = ''){
		$url = $this->webserviceUrl . '&method=' . $method . $parameters;
		$curlHandler = curl_init(); 
		curl_setopt($curlHandler, CURLOPT_URL, $url); 
		curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true); 
		$webserviceResponse = curl_exec($curlHandler);
		
		return $this->formatWebserviceResponse($webserviceResponse);		
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
		$jsonArtists = $this->consumeWebservice('chart.gettopartists', '&limit=' . LIMIT_TOP_ARTISTS);
		
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
		$jsonSongs = $this->consumeWebservice('chart.gettoptracks', '&limit=' . LIMIT_TOP_SONGS);
		
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
		$jsonArtist = $this->consumeWebservice('artist.getinfo', '&artist=' . urlencode($artistName));
		$jsonArtist = $jsonArtist['artist']; 
		$artist = new Application_Model_Artist();
    	$artist->setName($jsonArtist['name']);
    	$artist->setBiography($jsonArtist['bio']['content']);
    	$this->setImages($artist, $jsonArtist['image']);
    	    	
        return $artist;
	} 
}