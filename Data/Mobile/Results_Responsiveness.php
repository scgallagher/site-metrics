<?php

	class Results_Responsiveness {

		public $testPassed;

		public function __construct(){
			$this->testPassed = false;
		}

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
