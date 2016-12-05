<?php

	require_once("Data/Security/Results_SSL.php");
	require_once("Data/Security/Results_SQLInjection.php");

	class Results_Security {

		public $resultsSSL;
		public $resultsSQLInjection;

		public function parseJSON(){
			$results = array();
			$results["resultsSSL"] = $this->resultsSSL->parseJSON();
			$results["resultsSQLInjection"] = $this->resultsSQLInjection->parseJSON();
			return $results;
			//return json_encode($results);
		}

		public function __construct(){
			$this->resultsSSL = new Results_SSL();
			$this->resultsSQLInjection = new Results_SQLInjection();
		}

	}

?>
