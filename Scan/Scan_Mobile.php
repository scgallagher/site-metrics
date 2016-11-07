<?php

	require_once("Data/Results_Mobile.php");
	require_once("Scan/Mobile/Scan_Responsiveness.php");
	require_once("Scan/Mobile/Scan_ViewportOptimization.php");
	
	class Scan_Mobile {

		private $dom;
		public $resultsMobile;

		public function __construct($dom){
			$this->dom = $dom;
			$resultsMobile = new Results_Mobile();
		}

		public function scan(){
			$this->resultsMobile->resultsResponsiveness = $this->runScan_Responsiveness();
			$this->resultsMobile->resultsViewportOptimization = $this->runScan_ViewportOptimization();
			return $this->resultsMobile;
		}

		private function runScan_Responsiveness(){
			$scanResponsiveness = new Scan_Responsiveness($this->dom);
			return $scanResponsiveness->scan();
		}

		private function runScan_ViewportOptimization(){
			$scanViewportOptimization = new Scan_ViewportOptimization($this->dom);
			return $scanViewportOptimization->scan();
		}

	}

?>