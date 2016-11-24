<?php

	require_once("Data/Results_SearchEngineOptimizations.php");
	require_once("Data/Results_Performance.php");

	class Results_All {
		public $resultsSEO;
		public $resultsPerformance;

		public function __construct(){
			$resultsSEO = new Results_SearchEngineOptimizations();
			$resultsPerformance = new Results_Performance();
		}
	}

?>