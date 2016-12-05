<?php

	require_once("Data/SEO/Results_PageTitle.php");
	require_once("Data/SEO/Results_MetaDescription.php");
	require_once("Data/SEO/Results_Heading.php");

	class Results_SearchEngineOptimizations {

		public $resultsPageTitle;
		public $resultsMetaDescription;
		public $resultsHeading;

		public function parseJSON(){
			$results = array();
			$results["resultsPageTitle"] = $this->resultsPageTitle->parseJSON();
			$results["resultsMetaDescription"] = $this->resultsMetaDescription->parseJSON();
			$results["resultsHeading"] = $this->resultsHeading->parseJSON();
			return $results;
		}

		public function __construct(){
			$this->resultsPageTitle = new Results_PageTitle();
			$this->resultsMetaDescription = new Results_MetaDescription();
			$this->resultsHeading = new Results_Heading();
		}

	}

?>
