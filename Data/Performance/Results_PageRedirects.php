<?php

	class Results_PageRedirects {

		//General Metric(s)
		public $redirectsResult;
		public $rating;

		//Specific Metric(s)
		public $redirectCount;

		public function __toString(){
			$output = "";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["redirectsResult"] = $this->redirectsResult;
			$results["redirectCount"] = $this->redirectCount;
			$results["rating"] = $this->rating;
			return $results;
		}

	}

?>
