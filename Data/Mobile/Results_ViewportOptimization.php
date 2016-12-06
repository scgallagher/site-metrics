<?php

	class Results_ViewportOptimization {

		public $usesContentViewport;
		public $testPassed;
		public $rating;

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			$results["usesContentViewport"] = $this->usesContentViewport;
			$results["rating"] = $this->rating;
			return $results;
		}

		public function __toString(){
			$output = "";
			return $output;
		}

	}

?>
