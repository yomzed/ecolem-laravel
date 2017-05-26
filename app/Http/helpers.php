<?php

if(!function_exists('selected_fields')) {

	function selected_fields($name, $data, $checked='checked')
	{
		if(is_array($data) && !empty($data) && in_array($name, $data)) return $checked ;

		if( $name == $data ) return $checked;
		
	}
}