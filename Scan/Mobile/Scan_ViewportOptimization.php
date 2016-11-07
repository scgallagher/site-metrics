<?php

	require_once("Data/Mobile/Results_ViewportOptimization.php");

	class Scan_ViewportOptimization {

		private $dom;
		private $resultsViewportOptimization;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsViewportOptimization = new Results_ViewportOptimization();
		}

		public function scan(){
			return $this->resultsViewportOptimization;
		}

	}

?>