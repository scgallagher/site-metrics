<?php

	require_once("Data/SEO/Results_PageTitle.php");
	require_once("Data/SEO/Results_MetaDescription.php");
	require_once("Data/SEO/Results_Heading.php");

	class Results_SearchEngineOptimizations {

		public $resultsPageTitle;
		public $resultsMetaDescription;
		public $resulsHeading;

		public function __construct(){
			$this->resultsPageTitle = new Results_PageTitle();
			$this->resultsMetaDescription = new Results_MetaDescription();
			$this->Results_Heading = new Results_Heading();
		}

	}
	
?>