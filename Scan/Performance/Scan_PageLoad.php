<?php

	require_once("Data/Performance/Results_PageLoad.php");

	class Scan_PageLoad {

		private $dom;
		private $url;
		private $resultsPageLoad;

		public function __construct($dom, $url){
			$this->dom = $dom;
			$this->url = $url;
			$this->resultsPageLoad = new Results_PageLoad();
		}

		public function scan(){
			$scanTarget = $this->url;
			$this->resultsPageLoad->loadTimeInSeconds = $this->getRequestTime($scanTarget);

			if ($this->resultsPageLoad->loadTimeInSeconds < 0)
				$this->resultsPageLoad->pageLoadResult = "ERROR";
			elseif ($this->resultsPageLoad->loadTimeInSeconds < 3)
				$this->resultsPageLoad->pageLoadResult = "Good";
			elseif ($this->resultsPageLoad->loadTimeInSeconds < 5)
				$this->resultsPageLoad->pageLoadResult = "Okay";
			else
				$this->resultsPageLoad->pageLoadResult = "Bad";

			$this->resultsPageLoad->testPassed = $this->testPassed();
			$this->resultsPageLoad->rating = $this->resultsPageLoad->pageLoadResult;
			return $this->resultsPageLoad;
		}

		public function testPassed(){
			if (strtolower($this->resultsPageLoad->pageLoadResult) == "good")
			{
				return true;
			}

			return false;
		}

		private function stripProtocol($url){
			if(preg_match('/^(http:\/\/|https:\/\/)localhost/', $url)){
				$url = "127.0.0.1";
			}
			else if(preg_match('/^(http:\/\/|https:\/\/)/', $url, $matches)){
				$url = str_replace($matches[0], "", $url);
			}
			return $url;
		}

		private function getRequestTime($url){
			$starttime = microtime(true);
			$content = file_get_contents($url);
			$endtime = microtime(true);

			$time = ($endtime - $starttime);
			$time = round($time, 2);

			return $time;
		}
	}

?>
