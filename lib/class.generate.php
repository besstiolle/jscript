<?php

final class Generate{

	public static $vector;
	private static $debug = false;

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
			Generate::$debug = true;
			return;
		} 

		$script = null;

		//content source => url
		if(!empty($params['url']))
		{
			$value = $params['url'];
			if(!JSUrl::isValidValue($value)) {
				return;
			}
			$script = new JSUrl($value);
		}

		//content source => file
		if(!empty($params['file']))
		{
			$value = $params['file'];
			if(!JSFile::isValidValue($value)) {
				return;
			}
			$script = new JSFile($value);			
		}

		//content source => smarty var
		if(!empty($params['smarty']))
		{
			$value = $params['smarty'];
			if(!JSSmarty::isValidValue($value)) {
				return;
			}
			$script = new JSSmarty($value);
		}
		
		
		//Script Priority : between 0 and 999
		if(!empty($params['priority']) && is_numeric($params['priority']) && strpos($params['priority'], '.') === FALSE && strpos($params['priority'], ',') === FALSE){
			$script->setPriority($params['priority']);	
		}
		
		//Script Stack.
		if(!empty($params['stack'])){
			$script->setStack($params['stack']);	
		}

		Generate::$vector->addScript($script);

	}

	public static function displayScripts($params){
		//Initiate locale var
		Generate::init();
		
		if(Generate::$debug)
		{
		
			$pattern = '</body>';
			$scriptBloc = '';
			
			$stacks = Generate::$vector->getAllStacks();
			foreach($stacks as $key => $stack)
			{
				$scriptBloc .= '<table><tr><td colspan="3">Stack : <b>#'.$stack.'</b> md5 = <b>'.Generate::$vector->getVectorHashByStack($stack).'</b></td></tr>';
				$scripts = Generate::$vector->getOrderedScriptsByStack($stack);
				foreach($scripts as $script){
					$scriptContent = $script->getContent();
					if(strlen($scriptContent) > 200){
						$scriptContent = substr($scriptContent, 0, 200).' [...Script Cutted For Test...] ' ;	
					}
					

					$scriptBloc .= '<tr><td style="border:1px solid #000;">'.$script->getPriority().'</td>'
								.'<td style="border:1px solid #000;">'.$scriptContent.'</td>'
								.'<td style="border:1px solid #000;">'.$script->getHash().'</td></tr>';
				}
				$scriptBloc .= '</table>';
			}

			$params['content'] = str_replace($pattern, $scriptBloc.$pattern, $params['content']);
		}

	}
	
	/**
	 * Allow parsing multi-value ( | ; :)
	 **/
	private static function parseValue($textValue){
		$pattern = '';
		$multiValues = preg_split($pattern, $textValue);
		return $multiValues;
	}

}


?>