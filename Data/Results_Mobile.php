<?php

	require_once("Data/Mobile/Results_Responsiveness.php");
	require_once("Data/Mobile/Results_ViewportOptimization.php");

	class Results_Mobile {

		public $resultsResponsiveness;
		public $resultsViewportOptimization;

		public function __construct(){
			$this->resultsResponsiveness = new Results_Responsiveness();
			$this->resultsViewportOptimization = new Results_ViewportOptimization();
		}

		public function parseJSON(){
			$results = array();
			$results["resultsViewportOptimization"] = $this->resultsViewportOptimization->parseJSON();
			$results["resultsResponsiveness"] = $this->resultsResponsiveness->parseJSON();
			return $results;
		}

	}

?>
