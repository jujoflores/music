<?php
interface Webservices_Adapter_Artist{

	public function getInformation($artistName);
	
	public function getTopAlbums($artistName);
	
	public function getArtistTopSongs($artistName);
	
}