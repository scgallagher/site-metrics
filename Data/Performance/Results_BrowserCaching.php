<?php

	class Results_BrowserCaching {

		public $testPassed;
		public $browserCachingResult;
		public $cookiesSizeInBytes;
		public $cookiesCount;

		public function __toString(){
			$output = "";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			$results["cookiesSizeInBytes"] = $this->cookiesSizeInBytes;
			$results["cookiesCount"] = $this->cookiesCount;
			$results["browserCachingResult"] = $this->browserCachingResult;
			return $results;
		}

	}

?>
