<?php

	class Results_Responsiveness {

		public $hasBootstrap;
		public $hasMediaQueries;
		public $rating;

		public function parseJSON(){
			$results = array();
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
