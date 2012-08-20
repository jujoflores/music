<?php
class Webservices_Song_Lastfm implements Webservices_Song_Interface{
	
	private $config;
	private $urlHandler;
	
	public function __construct($config){
		$this->config = $config;
		$this->urlHandler = new Music_UrlGenerator($this->config->get('url'));
		$this->urlHandler
			->format($this->config->get('format'))
			->api_key($this->config->get('apiKey'))
			->save();
	}
	
	public function getTop(){
    	$topSongs = array();
    	$jsonSongs = $this->urlHandler
			->restart()
    		->method('chart.gettoptracks')
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
