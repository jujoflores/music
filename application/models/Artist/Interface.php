<?php
interface Application_Model_Artist_Interface{

	public function getInformationByArtist(Application_Model_Artist $artist);
	
	public function getTopAlbumsByArtist(Application_Model_Artist $artist);
	
	public function getTopSongsByArtist(Application_Model_Artist $artist);
	
	public function getTopArtists();
}