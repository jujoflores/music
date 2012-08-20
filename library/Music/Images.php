<?php
abstract class Music_Images{
	
	public static function set($object, $images){
		if(count($images)){
	    	foreach($images as $image){
	    		$object->setImage($image['size'], $image['#text']);
			}
		}
	}
}