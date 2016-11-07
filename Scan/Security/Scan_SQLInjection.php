<?php

	require_once("Data/Security/Results_SQLInjection.php");

	class Scan_SQLInjection {

		private $dom;
		private $resultsSQLInjection;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsSQLInjection = new Results_SQLInjection();
		}

		public function scan(){
			return $this->resultsSQLInjection;
		}

	}

?>