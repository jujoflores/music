<?php
namespace Resources\DataSource;
use Application\Model\Artist as ArtistModel;

interface Artist{

	public function getInformationByArtist(ArtistModel $artist);
	
	public function getTopAlbumsByArtist(ArtistModel $artist);
	
	public function getTopSongsByArtist(ArtistModel $artist);
	
	public function getTopArtists();
}