<?php

	class Results_PageSize {

		//General Metric(s)
		public $pageSizeResult;
		public $testPassed;
		public $rating;

		//Specific Metric(s)
		public $pageSizeInBytes;

		public function __toString(){
			$output = "";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			$results["pageSizeResult"] = $this->pageSizeResult;
			$results["rating"] = $this->rating;
			return $results;
		}

	}

?>
