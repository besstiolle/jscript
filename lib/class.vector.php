<?php

final class Vector{

	private $list = array();

	public function __construct() {
		
	}
	
	public function addScript(Script $script){
		$this->list[] = $script;
	}

	/**
	 * Do a complex sort on the priority of each Script
	 **/
	public function getOrderedScripts(){
		usort($this->list, array("Vector", "compare"));

		return $this->list;		
	}

	private function compare(Script $s1, Script $s2){
		if ($s1->getPriority() == $s2->getPriority()) {
        	return 0;
    	}

    	return ($s1->getPriority() > $s2->getPriority()) ? -1 : 1;
	}
	
	/**
	 * Allow to know if a smilar script have been already push into Vector.
	 **/
	public function doesHashAlreadyExist($hash){
		foreach($list as $script) {
			if($hash == $script->getHash()){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Allow to know what would be the hash of a Stack's Vector (and after knowing if the cache file is still ok)
	 **/
	public function getVectorHashByStack($stack){
		$allHash = '';
		foreach($list as $script) {
			$allHash .= $script->getHash();
		}
		return md5($allHash);
	}
}


?>