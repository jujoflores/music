<?php
interface Webservices_Artist_Interface{

	public function getTop();
	
	public function getInformation($artistName);
	
	public function getTopAlbums($artistName);
	
	public function getTopSongs($artistName);
	
}