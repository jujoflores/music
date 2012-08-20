<?php
interface Resources_Webservices_Adapter_Artist{

	public function getInformationByArtist($artistName);
	
	public function getTopAlbumsByArtist($artistName);
	
	public function getTopSongsByArtist($artistName);
	
}