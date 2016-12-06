<?php

	class Results_Responsiveness {

		public $hasBootstrap;
		public $hasMediaQueries;
		public $testPassed;
		public $rating;

		public function __construct(){
			$this->testPassed = false;
		}

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			$results["hasBootstrap"] = $this->hasBootstrap;
			$results["hasMediaQueries"] = $this->hasMediaQueries;
			$results["rating"] = $this->rating;
			return $results;
		}

		public function __toString(){
			$output = "";
			return $output;
		}

	}

?>
