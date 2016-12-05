<?php

	require_once("Data/Performance/Results_BrowserCaching.php");
	require_once("Data/Performance/Results_Compression.php");
	require_once("Data/Performance/Results_HTTPRequests.php");
	require_once("Data/Performance/Results_PageLoad.php");
	require_once("Data/Performance/Results_PageRedirects.php");
	require_once("Data/Performance/Results_PageSize.php");
	require_once("Data/Performance/Results_RenderBlocking.php");

	class Results_Performance {

		public $resultsBrowserCaching;
		public $resultsCompression;
		public $resultsHTTPRequests;
		public $resultsPageLoad;
		public $resultsPageRedirects;
		public $resultsPageSize;
		public $resultsRenderBlocking;

		public function __construct(){
			$this->resultsBrowserCaching = new Results_BrowserCaching();
			$this->resultsCompression = new Results_Compression();
			$this->resultsHTTPRequests = new Results_HTTPRequests();
			$this->resultsPageLoad = new Results_PageLoad();
			$this->resultsPageRedirects = new Results_PageRedirects();
			$this->resultsPageSize = new Results_PageSize();
			$this->resultsRenderBlocking = new Results_RenderBlocking();
		}

		public function parseJSON(){
			$results = array();
			$results["resultsBrowserCaching"] = $this->resultsBrowserCaching->parseJSON();
			$results["resultsCompression"] = $this->resultsCompression->parseJSON();
			$results["resultsHTTPRequests"] = $this->resultsHTTPRequests->parseJSON();
			$results["resultsPageLoad"] = $this->resultsPageLoad->parseJSON();
			$results["resultsPageRedirects"] = $this->resultsPageRedirects->parseJSON();
			$results["resultsPageSize"] = $this->resultsPageSize->parseJSON();
			$results["resultsRenderBlocking"] = $this->resultsRenderBlocking->parseJSON();
			return $results;
		}

	}

?>
