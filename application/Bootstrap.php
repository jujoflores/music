<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{

	function _initConfig(){
		$webserviceConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'webservices', 
			array('allowModifications'=>true));
		$defaultImagesConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'defaultImages');
		Zend_Registry::set('webserviceConfig', $webserviceConfig);
		Zend_Registry::set('defaultImages', $defaultImagesConfig);
	}
}