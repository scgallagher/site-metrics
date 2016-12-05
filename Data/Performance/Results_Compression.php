<?php

	class Results_Compression {

		//General Metric(s)
		public $compressionResult;
		public $testPassed;

		//Specific Metric(s)
		public $compressionPercentage;

		public function __toString(){
			$output = "";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			$results["compressionResult"] = $this->compressionResult;
			return $results;
		}

	}

?>
