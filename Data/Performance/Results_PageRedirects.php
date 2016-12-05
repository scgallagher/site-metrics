<?php

	class Results_PageRedirects {

		//General Metric(s)
		public $redirectsResult;
		public $testPassed;

		//Specific Metric(s)
		public $redirectCount;

		public function __toString(){
			$output = "";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			$results["redirectsResult"] = $this->redirectsResult;
			return $results;
		}

	}

?>
