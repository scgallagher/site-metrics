<?php

	require_once("Data/Performance/Results_PageRedirects.php");

	class Scan_PageRedirects {

		private $dom;
		private $resultsPageRedirects;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsPageRedirects = new Results_PageRedirects();
		}

		public function scan(){
			return $this->resultsPageRedirects;
		}

	}

?>