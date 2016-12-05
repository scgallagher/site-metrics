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
			$results["resultsSEO"] = $this->resultsSEO->parseJSON();
			$results["resultsMobile"] = $this->resultsMobile->parseJSON();
			$results["resultsPerformance"] = $this->resultsPerformance->parseJSON();
			//echo $this->resultsMobile->resultsResponsiveness->parseJSON() ."\n\n";
			//echo $this->resultsMobile->parseJSON() ."\n\n";
			//echo $this->resultsMobile->resultsViewportOptimization->usesContentViewport;
			return $results;
			//return json_encode($results);
		}

		public function __construct(){
			$this->resultsSEO = new Results_SearchEngineOptimizations();
			$this->resultsPerformance = new Results_Performance();
			$this->resultsMobile = new Results_Mobile();
			$this->resultsSecurity = new Results_Security();
		}
	}

?>
