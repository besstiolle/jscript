<?php

final class Generate{

	public static $vector;

	protected function __construct() {
	}

	private static function init(){
		if(Generate::$vector == null){
			Generate::$vector = new Vector();
		}
	}
	
	public static function addScript($params){
		//Initiate locale var
		Generate::init();

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

		$script = new Script();
		//Script Priority : between 0 and 999
		if(!empty($params['priority']) && is_numeric($params['priority']) && strpos($params['priority'], '.') === FALSE && strpos($params['priority'], ',') === FALSE){
			$script->setPriority($params['priority']);		
		}

		//Action => url
		if(!empty($params['url']))
		{
			$script->setContent(Generate::getUrlContent($params['url']));
		}

		//Action => file
		if(!empty($params['file']))
		{
			$script->setContent(Generate::getFileContent($params['file']));	
		}

		//Action => smarty
		if(!empty($params['smarty']))
		{
			$script->setContent(Generate::getSmartyContent($params['smarty']));
		}

		Generate::$vector->addScript($script);

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
		//Initiate locale var
		Generate::init();
		
		$pattern = '</body>';

		$scriptBloc = '<table>';
		$scripts = Generate::$vector->getOrderedScripts();
		foreach($scripts as $script){
			$scriptContent = $script->getContent();
			if(strlen($scriptContent) > 200){
				$scriptContent = substr($scriptContent, 0, 200).' [...Script Cutted For Test...] ' ;	
			}
			

			$scriptBloc .= '<tr><td style="border:1px solid #000;">'.$script->getPriority()
						.'</td><td style="border:1px solid #000;">'.$scriptContent.'</td></tr>';
		}
		$scriptBloc .= '</table>';

		$params['content'] = str_replace($pattern, $scriptBloc.$pattern, $params['content']);

	}

}


?>