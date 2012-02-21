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
			//check if valid url
			if(!preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $params['url'])) {
				return;
			}
			$script->setContent(Generate::getUrlContent($params['url']));
			$script->setHash(md5($params['url'])); //Hash sur l'url
		}

		//Action => file
		if(!empty($params['file']))
		{
			$gcms = cmsms(); 
			$config = $gcms->GetConfig();
			$path = $config['root_path'].'/'.$params['file'];
			
			if(!file_exists($path)) {
				return;
			}
			$script->setContent(Generate::getFileContent($params['file']));	
			$script->setHash(md5($params['file'])); //Hash sur le nom de fichier
			
		}

		//Action => smarty
		if(!empty($params['smarty']))
		{
			$script->setContent(Generate::getSmartyContent($params['smarty']));
			$script->setHash(md5($params['smarty'])); // //Hash sur le contenu
		}

		Generate::$vector->addScript($script);

	}

	private static function getUrlContent($url){
		$content = file_get_contents($url);
		return $content;
	}
	
	private static function getFileContent($file){
		$gcms = cmsms(); 
		$config = $gcms->GetConfig();
		$path = $config['root_path'];
		$content = file_get_contents($path.'/'.$file);
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