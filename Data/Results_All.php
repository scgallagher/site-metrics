<?php

	require_once("Data/Results_SearchEngineOptimizations.php");
	require_once("Data/Results_Performance.php");
	require_once("Data/Results_Mobile.php");
	require_once("Data/Results_Security.php");

	class Results_All {
		public $resultsSEO;
		public $resultsPerformance;
		public $resultsMobile;
		public $resultsSecurity;

		public function parseJSON(){
			$results = array();
			$results["resultsSecurity"] = $this->resultsSecurity->parseJSON();
			return $results;
			//return json_encode($results);
		}

		public function __construct(){
			$resultsSEO = new Results_SearchEngineOptimizations();
			$resultsPerformance = new Results_Performance();
			$resultsMobile = new Results_Mobile();
			$resultsSecurity = new Results_Security();
		}
	}

?>
