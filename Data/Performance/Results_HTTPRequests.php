<?php

	class Results_HTTPRequests {

		public $requestCount;
		public $testPassed;
		public $rating;

		public function __toString(){
			$output = "";
			$output .= "HTTP Requests: $this->requestCount\n";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			$results["requestCount"] = $this->requestCount;
			$results["rating"] = $this->rating;
			return $results;
		}

	}

?>
