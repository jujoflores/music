<?php
abstract class Music_GetUrl{
	
	public static function formatResponse($response, $format){
		if($format == 'json'){
			return json_decode($response, true);	
		}else{
			return $response;
		}
	}
	
	public static function curl($url, $format){
		$curlHandler = curl_init(); 
		curl_setopt($curlHandler, CURLOPT_URL, $url); 
		curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true); 
		$response = curl_exec($curlHandler);
		
		return self::formatResponse($response, $format);		
	}
}