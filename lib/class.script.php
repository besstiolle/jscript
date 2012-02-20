<?php

final class Script{

	private $stack='all';
	private $load='sync';
	private $compress='none';
	private $append=true;
	private $priority=100;

	private $content='';

	public function __construct() {
		
	}
	
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
	public function getContent(){
		return $this->content;
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
	public function setContent($param){
		$this->content = $param;
	}

}


?>