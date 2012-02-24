<?php

final class JSFile extends Script{

	public function __construct($value) {
		parent::__construct($value);
	}

	public function getContent(){
		$gcms = cmsms(); 
		$config = $gcms->GetConfig();
		$path = $config['root_path'];
		$content = file_get_contents($path.'/'.$this->value);
		return $content;
	}
	
	public static function isValidValue($value){
		$gcms = cmsms(); 
		$config = $gcms->GetConfig();
		$path = $config['root_path'].'/'.$value;
		
		return file_exists($path);
	}
	
	public function getHash(){
		if($this->hash == null) {
			$this->hash = md5($this->value);
		}
		return $this->hash;
	}
}

?>