<?php

final class Generate{

	public static $scripts = array();

	protected function __construct() {
	}
	
	public static function addScript($params){


		if(empty($params['url']) & empty($params['file']) & empty($params['smarty']) & empty($params['debug']))
		{
			$keys = array_keys($params);

			echo '<p>Bad parameter for {JScript} call : miss "url|file|smarty=\'xx\'" or "debug=true". Found : [';
			foreach($keys as $key){
				echo $key.' ';
			}
			echo ']</p>';
			return;
		}

		if(!(!empty($params['url']) ^ !empty($params['file']) ^ !empty($params['smarty']) ^ !empty($params['debug'])))
		{
			$keys = array_keys($params);

			echo '<p>Bad parameter for {JScript} call : mutiples parameters found "url|file|smarty=\'xx\'" or/and "debug=xxx". Found : [';
			foreach($keys as $key){
				echo $key.' ';
			}
			echo ']</p>';
			return;
		}

		//Action => debug 
		if(!empty($params['debug']) && ($params['debug'] || $params['debug']=='true'))
		{
			return;
		} 

		//Action => url
		if(!empty($params['url']))
		{
			Generate::$scripts[] = Generate::getUrlContent($params['url']);	
			return;
		}

		//Action => file
		if(!empty($params['file']))
		{
			Generate::$scripts[] = Generate::getFileContent($params['file']);	
			return;
		}

		//Action => smarty
		if(!empty($params['smarty']))
		{
			Generate::$scripts[] = Generate::getSmartyContent($params['smarty']);
			return;	
		}

	}

	private static function getUrlContent($url){
		$content = file_get_contents($url);
		return $content;
	}

	private static function getFileContent($uri){
		$gcms = cmsms(); 
		$config = $gcms->GetConfig();
		$path = $config['root_path'];
		$content = file_get_contents($path.'/'.$uri);
		return $content;

	}

	private static function getSmartyContent($smarty)
	{
		//maybe more fonctions later ? like remove <script></script> and other
		return $smarty;
	}


	public static function displayScripts($params){

		$pattern = '</body>';

		$scriptBloc = '';
		foreach(Generate::$scripts as $script){
			//$miniscript = htmlentities($script);
			$miniscript = $script;
			if(strlen($miniscript) > 200){
				$miniscript = substr($miniscript, 0, 200).' [...Script Cutted For Test...] ' ;	
			}
			

			$scriptBloc .= '<table style="border:1px solid #000;"><tr><td>'.$miniscript.'</td></tr></table>';
		}

		$params['content'] = str_replace($pattern, $scriptBloc.$pattern, $params['content']);

	}

}


?>