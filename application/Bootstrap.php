<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{

	function _initConfig(){
		$webserviceConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'webservices');
		Zend_Registry::set('webserviceConfig', $webserviceConfig);
	}
}