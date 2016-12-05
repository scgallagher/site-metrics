<?php

	class Results_ViewportOptimization {

		public $usesContentViewport;
		public $testPassed;

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			return $results;
		}

		public function __toString(){
			$output = "";
			return $output;
		}

	}

?>
