<?php

abstract class Script{

	protected $stack='generic';
	protected $load='sync';
	protected $compress='none';
	protected $append=true;
	protected $priority=100;
	protected $hash;
	protected $value;

	//private $content='';

	public function __construct($value) {
		$this->value = $value;
	}
	
	//Must be recoded in subclasses
	public abstract function getContent();
	public abstract function getHash();
	public abstract static function isValidValue($value);
	
	//Basics Getters
	public function getStack(){
		return $this->stack;
	}
	public function getLoad(){
		return $this->load;
	}
	public function getCompress(){
		return $this->compress;
	}
	public function getAppend(){
		return $this->append;
	}
	public function getPriority(){
		return $this->priority;
	}

	//Setters with some controls
	public function setStack($param){
		$this->stack = $param;
	}
	public function setLoad($param){
		$allowed = array('sync','async','defer');
		$param = strtolower($param);
		if(!in_array($param, $allowed)){
			throw new Exception("bad value for param load");
		}
		$this->load = $param;	
		
	}
	public function setCompress($param){
		$allowed = array('none', 'soft', 'jsmin', 'Yui', 'Packer');
		$param = strtolower($param);
		if(!in_array($param, $allowed)){
			throw new Exception("bad value for param compress");
		}
		$this->compress = $param;
	}
	public function setAppend($param){
		$allowed = array('true', 'false');
		$param = strtolower($param);
		if(!in_array($param, $allowed) && !is_bool($param)){
			throw new Exception("bad value for param append");
		}
		$this->append = $param;
	}
	public function setPriority($param){
		if(!is_numeric($param) || strpos($param, '.') || strpos($param, ',') ){
			throw new Exception("bad value for param priority");
		}
		$param = intval($param);
		if($param < 0 || $param > 999)
		{
			throw new Exception("value too high/low for param priority (must be between 0 and 999");
		}
		$this->priority = $param;
	}
}


?>