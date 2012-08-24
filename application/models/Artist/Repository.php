<?php
namespace Application\Model\Artist;
use Application\Model\Artist as ArtistModel;
use Resources\DataSource\Artist as ArtistDataSource;

class Repository implements ArtistDataSource {
	
	private $dataSource;
	
	function __construct(){
	}
	
	public function setDataSource(ArtistDataSource $datasource){
		$this->dataSource = $datasource;
	}
	
	public function getInformationByArtist(ArtistModel $artist){
		return $this->dataSource->getInformationByArtist($artist);
	}
	
	public function getTopAlbumsByArtist(ArtistModel $artist){
		return $this->dataSource->getTopAlbumsByArtist($artist);
	}
	
	public function getTopSongsByArtist(ArtistModel $artist){
		return $this->dataSource->getTopSongsByArtist($artist);
	}
	
	public function getTopArtists(){
		return $this->dataSource->getTopArtists();
	}
}