<?php

	class Results_ViewportOptimization {

		public $usesContentViewport;
		public $testPassed;

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			$results["usesContentViewport"] = $this->usesContentViewport;
			return $results;
		}

		public function __toString(){
			$output = "";
			return $output;
		}

	}

?>
