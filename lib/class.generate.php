<?php

final class Generate{

	public static $scripts = array();

	protected function __construct() {
	}
	
	public static function addScript($params){
		Generate::$scripts[] = $params['url'];
	}

	public static function displayScripts($params){
		
		$pattern = '</body>';

		$scriptBloc = '';
		foreach(Generate::$scripts as $script){
			$scriptBloc .= '<table style="border:1px solid #000;"><tr><td>'.htmlentities($script).'</td></tr></table>';
		}

		$params['content'] = str_replace($pattern, $scriptBloc, $params['content']);

	}

}


?>