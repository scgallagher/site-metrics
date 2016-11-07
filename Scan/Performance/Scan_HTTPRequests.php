<?php

	require_once("Data/Performance/Results_HTTPRequests.php");

	class Scan_HTTPRequests {

		private $dom;
		private $resultsHTTPRequests;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsHTTPRequests = new Results_HTTPRequests();
		}

		public function scan(){
			return $this->resultsHTTPRequests;
		}

	}

?>