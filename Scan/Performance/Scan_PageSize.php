<?php

	require_once("Data/Performance/Results_PageSize.php");

	class Scan_PageSize {

		private $dom;
		private $url;
		private $originalRawHTML;
		private $resultsPageSize;

		public function __construct($dom, $url, $originalRawHTML){
			$this->dom = $dom;
			$this->url = $url;
			$this->originalRawHTML = $originalRawHTML;
			$this->resultsPageSize = new Results_PageSize();
		}

		public function scan(){
			//Read in webpage
			//$originalSiteContents = file_get_contents($this->url); //$testString = "I♥NY";
			$originalSiteContents = $this->originalRawHTML;

			//Get size
			$this->resultsPageSize->pageSizeInBytes = strlen($originalSiteContents);

			//Set results
			if ($this->resultsPageSize->pageSizeInBytes < 0)
				$this->resultsPageSize->pageSizeResult = "ERROR";
			elseif ($this->resultsPageSize->pageSizeInBytes < 200000)
				$this->resultsPageSize->pageSizeResult = "Good";
			elseif ($this->resultsPageSize->pageSizeInBytes < 300000)
				$this->resultsPageSize->pageSizeResult = "Ok";
			else
				$this->resultsPageSize->pageSizeResult = "Bad";

				$this->resultsPageSize->testPassed = $this->testPassed();
			return $this->resultsPageSize;
		}

		public function testPassed()
		{
			if (strtolower($this->resultsPageSize->pageSizeResult) == "good")
			{
				return true;
			}

			return false;
		}

	}

?>
