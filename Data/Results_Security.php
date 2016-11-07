<?php

	require_once("Data/Security/Results_SSL.php");
	require_once("Data/Security/Results_SQLInjection.php");

	class Results_Security {

		public $resultsSSL;
		public $resultsSQLInjection;

		public function __construct(){
			$this->resultsSSL = new Results_SSL();
			$this->resultsSQLInjection = new Results_SQLInjection();
		}

	}

?>