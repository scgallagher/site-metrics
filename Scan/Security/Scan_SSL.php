<?php

	require_once("Data/Security/Results_SSL.php");

	class Certificate {
		public $expiration;
		public $issuer;
	}

	class Scan_SSL {

		private $dom;
		private $httpHeader;
		private $resultsSSL;

		public function __construct($dom, $httpHeader){
			$this->dom = $dom;
			$this->httpHeader = $httpHeader;
			$this->resultsSSL = new Results_SSL();
		}

		public function scan(){
			return $this->resultsSSL;
		}

		private function getCertInfo(){

		}

		private function getExpiration(){

		}

		private function getIssuer(){
			
		}

		private function testPassed(){
			// Algorithm
			// If site has SSL cert and its not expired - pass
			// Else if site has SSL cert and it is expired - fail
			// Else if site doesn't have SSL cert - pass/not applicable
		}

	}

?>
