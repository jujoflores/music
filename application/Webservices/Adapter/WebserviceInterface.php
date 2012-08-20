<?php
interface Webservices_Adapter_WebserviceInterface{

	public function getTopArtists();
	
	public function getTopSongs();
	
	public function getArtistInformation($artistName);
	
}