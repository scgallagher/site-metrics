<?php

	require_once("Data/Results_SearchEngineOptimizations.php");
	require_once("Scan/SEO/Scan_PageTitle.php");
	require_once("Scan/SEO/Scan_MetaDescription.php");
	require_once("Scan/SEO/Scan_Heading.php");

	class Scan_SearchEngineOptimizations {

		public $resultsSearchEngineOptimizations;
		private $dom;

		function __construct($dom){
			$this->resultsSearchEngineOptimizations = new Results_SearchEngineOptimizations();
			$this->dom = $dom;
		}


		public function scan(){
			$this->resultsSearchEngineOptimizations->resultsPageTitle =
				$this->runScan_PageTitle();
			$this->resultsSearchEngineOptimizations->resultsHeading =
				$this->runScan_Heading();

			return $this->resultsSearchEngineOptimizations;
		}

		private function runScan_PageTitle(){
			$scanPageTitle = new Scan_PageTitle($this->dom);
			return $scanPageTitle->scan();
		}

		private function runScan_MetaDescription(){
			$scanMetaDescription = new Scan_MetaDescription($this->dom);
			return $scanMetaDescription->scan();
		}

		private function runScan_Heading(){
			$scanHeading = new Scan_Heading($this->dom);
			return $scanHeading->scan();
		}

	}

?>
