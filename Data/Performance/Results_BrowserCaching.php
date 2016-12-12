<?php

	class Results_BrowserCaching {

		public $browserCachingResult;
		public $cookiesSizeInBytes;
		public $cookiesCount;
		public $rating;

		public function __toString(){
			$output = "";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["cookiesSizeInBytes"] = $this->cookiesSizeInBytes;
			$results["cookiesCount"] = $this->cookiesCount;
			$results["browserCachingResult"] = $this->browserCachingResult;
			$results["rating"] = $this->rating;
			return $results;
		}

	}

?>
