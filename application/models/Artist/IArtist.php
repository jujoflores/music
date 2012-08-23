<?php
namespace Application\Model\Artist;
use Application\Model\Artist as ArtistModel;

interface IArtist{

	public function getInformationByArtist(ArtistModel $artist);
	
	public function getTopAlbumsByArtist(ArtistModel $artist);
	
	public function getTopSongsByArtist(ArtistModel $artist);
	
	public function getTopArtists();
}