<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {

	protected $application;

    public function setUp(){
        $this->bootstrap = array($this, 'appBootstrap');
        parent::setUp();
    }

    public function appBootstrap(){
    	$this->application = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
    	$this->application->bootstrap();
    }

    public function tearDown(){
    	Zend_Controller_Front::getInstance()->resetInstance();
    	$this->resetRequest();
    	$this->resetResponse();
    	$this->request->setPost(array());
    	$this->request->setQuery(array());
    	parent::tearDown();
    }

    public function testIndexController(){
    	$this->dispatch('/');
    	$this->assertController('index');
    }

    public function testIndexAction(){
    	$this->dispatch('/');
    	$this->assertAction('index');
    }

    public function testWebserviceConfig(){
    	$this->dispatch('/');
    	$actualConfig = Zend_Registry::get('webserviceConfig')->toArray();
    	$expectedConfig = array(
			'lastfm' => array(
				'url' => "http://ws.audioscrobbler.com/2.0/?",
		    	'format' => "json",
		    	'apiKey' => "b25b959554ed76058ac220b7b2e0a026",
		    	'limitTopArtists' => '10',
		    	'limitTopSongs' => '10',
		    	'limitArtistTopAlbums' => '10',
		    	'limitArtistTopSongs' => '10',
				'defaultImage' => array(
	    			'album' => "/images/defaultAlbum.png",
	    			'artist' => "/images/defaultArtist.png",
	    			'song' => "/images/defaultSong.png",
				),
			),
    	);
    	$this->assertEquals($expectedConfig, $actualConfig);
    }

    public function testSuccessfullRequest(){
    	$this->dispatch('/');
    	$this->assertFalse($this->response->isException());
    }
}