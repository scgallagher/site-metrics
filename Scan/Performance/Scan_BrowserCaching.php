<?php

	require_once("Data/Performance/Results_BrowserCaching.php");

	class Scan_BrowserCaching {

		private $dom;
		private $resultsBrowserCaching;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsBrowserCaching = new Results_BrowserCaching();
		}

		public function scan(){
			$this->resultsBrowserCaching->testPassed = $this->testPassed();
			return $this->resultsBrowserCaching;
		}

		public function testPassed(){
			return false;
		}

	}

?>
