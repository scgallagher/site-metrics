<?php

	require_once("Data/Results_Security.php");
	require_once("Scan/Security/Scan_SSL.php");
	require_once("Scan/Security/Scan_SQLInjection.php");

	class Scan_Security {

		private $dom;
		private $httpHeader;
		public $resultsSecurity;

		public function __construct($dom, $httpHeader){
			$this->dom = $dom;
			$this->httpHeader = $httpHeader;
			$this->resultsSecurity = new Results_Security();
		}

		public function scan(){
			$this->resultsSecurity->resultsSSL = $this->runScan_SSL();
			$this->resultsSecurity->resultsSQLInjection = $this->runScan_SQLInjection();
			return $this->resultsSecurity;
		}

		private function runScan_SSL(){
			$scanSSL = new Scan_SSL($this->dom, $this->httpHeader);
			return $scanSSL->scan();
		}

		private function runScan_SQLInjection(){
			$scanSQLInjection = new Scan_SQLInjection($this->dom);
			return $scanSQLInjection->scan();
		}

	}

?>
