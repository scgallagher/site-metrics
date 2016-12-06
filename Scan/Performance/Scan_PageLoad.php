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



		private function getRequestTime($url){
			$starttime = microtime(true);
			$file = @fsockopen($url, 80, $errNumber, $errText, 30);
			$endtime = microtime(true);

			$time = 0;
			if(!$file) {
				$time = -1;
			} else {
				fclose($file);
				$time = ($endtime - $starttime) * 1000000;
				$time = round($time, 2);
			}
			return $time;
		}
	}

?>
