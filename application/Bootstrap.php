<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{

	protected function _initConfig(){
		$webserviceConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'webservices',
			array('allowModifications'=>true));
		$defaultImagesConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'defaultImages');
		Zend_Registry::set('webserviceConfig', $webserviceConfig);
		Zend_Registry::set('defaultImages', $defaultImagesConfig);
	}

	protected function _initAutoloader(){
        $loader = function($className) {
            $className = str_replace('\\', '_', $className);
            Zend_Loader_Autoloader::autoload($className);
        };

        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->pushAutoloader($loader, 'Application\\');
    }
}