<?php

	class Results_HTTPRequests {

		public $requestCount;
		public $rating;

		public function __toString(){
			$output = "";
			$output .= "HTTP Requests: $this->requestCount\n";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["requestCount"] = $this->requestCount;
			$results["rating"] = $this->rating;
			return $results;
		}

	}

?>
