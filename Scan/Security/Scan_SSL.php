<?php

	require_once("Data/Security/Results_SSL.php");

	class Scan_SSL {

		private $dom;
		private $resultsSSL;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsSSL = new Results_SSL();
		}

		public function scan(){
			return $this->resultsSSL;
		}

	}

?>