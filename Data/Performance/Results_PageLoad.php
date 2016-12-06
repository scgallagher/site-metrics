<?php

	class Results_PageLoad {

		public $testPassed;
		public $pageLoadResult;
		public $loadTimeInSeconds;
		public $rating;

		public function __toString(){
			$output = "";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			$results["loadTimeInSeconds"] = $this->loadTimeInSeconds;
			$results["pageLoadResult"]= $this->pageLoadResult;
			$results["rating"] = $this->rating;
			return $results;
		}

	}

?>
