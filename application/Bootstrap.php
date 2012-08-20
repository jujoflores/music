<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{

	function _initConfig(){
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini');
		Zend_Registry::set('webserviceConfig', $config->webservices);
		Zend_Registry::set('defaultImages', $config->defaultImages);
	}
}