<?php

final class JSSmarty extends Script{

	public function __construct($value) {
		parent::__construct($value);
	}

	public function getContent(){
		//maybe more fonctions later ? like remove <script></script> and other
		return $this->value;
	}
	
	public static function isValidValue($value){
		return true;
	}
	
	public function getHash(){
		if($this->hash == null) {
			$this->hash = md5($this->value);
		}
		return $this->hash;
	}

}


?>