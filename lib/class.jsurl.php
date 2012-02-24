<?php

final class JSUrl extends Script{

	public function __construct($value) {
		parent::__construct($value);
	}

	public function getContent(){
		$content = file_get_contents($this->value);
		return $content;
	}
	
	public static function isValidValue($value){
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $value);
	}
	
	public function getHash(){
		if($this->hash == null) {
			$this->hash = md5($this->value);
		}
		return $this->hash;
	}

}


?>