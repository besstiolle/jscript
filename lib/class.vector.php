<?php

final class Vector{

	private $scripts = array();

	public function __construct() {
		
	}
	
	public function addScript(Script $script){
		$this->scripts[$script->getStack()][] = $script;
	}

	/**
	 * Do a complex sort on the priority of each Script
	 **/
	public function getOrderedScriptsByStack($stack){
		$subList = $this->scripts[$stack];
		usort($subList, array("Vector", "compare"));

		return $subList;		
	}

	/**
	 * Sort Max Priority => Min Priority and Max Hash => Min Hash (to avoid random sort between script with same priority)
	 **/
	private function compare(Script $s1, Script $s2){
		if ($s1->getPriority() == $s2->getPriority()) {
        	if($s1->getHash() == $s2->getHash()) {
				return 0;
			}
			return ($s1->getHash() > $s2->getHash()) ? -1 : 1;
    	}

    	return ($s1->getPriority() > $s2->getPriority()) ? -1 : 1;
	}
	
	/**
	 * Allow to know if a smilar script have been already push into Vector.
	 **/
	public function doesHashAlreadyExistByStack($stack, $hash){
		$subList = $this->scripts[$stack];
		foreach($subList as $script) {
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
		$subList = $this->scripts[$stack];
		$allHash = '';
		foreach($subList as $script) {
			$allHash .= $script->getHash();
		}
		return md5($allHash);
	}
	
	public function getAllStacks(){
		
		return array_keys($this->scripts);
	}
}


?>