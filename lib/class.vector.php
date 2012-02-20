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
}


?>