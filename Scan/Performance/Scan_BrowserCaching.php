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
			return $this->resultsBrowserCaching;
		}

	}

?>