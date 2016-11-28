<?php

	require_once("Data/Results_SearchEngineOptimizations.php");
	require_once("Data/Results_Performance.php");
	require_once("Data/Results_Mobile.php");

	class Results_All {
		public $resultsSEO;
		public $resultsPerformance;
		public $resultsMobile;

		public function __construct(){
			$resultsSEO = new Results_SearchEngineOptimizations();
			$resultsPerformance = new Results_Performance();
			$resultsMobile = new Results_Mobile();
		}
	}

?>
