<?php

	class Results_Compression {

		//General Metric(s)
		public $compressionResult;
		public $testPassed;
		public $rating;

		//Specific Metric(s)
		public $compressionPercentage;

		public function __toString(){
			$output = "";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			$results["compressionPercentage"] = $this->compressionPercentage;
			$results["compressionResult"] = $this->compressionResult;
			$results["rating"] = $this->rating;
			return $results;
		}

	}

?>
