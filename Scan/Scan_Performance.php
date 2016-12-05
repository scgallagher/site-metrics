<?php

	require_once("Data/Results_Performance.php");
	require_once("Scan/Performance/Scan_BrowserCaching.php");
	require_once("Scan/Performance/Scan_Compression.php");
	require_once("Scan/Performance/Scan_HTTPRequests.php");
	require_once("Scan/Performance/Scan_PageLoad.php");
	require_once("Scan/Performance/Scan_PageRedirects.php");
	require_once("Scan/Performance/Scan_PageSize.php");
	require_once("Scan/Performance/Scan_RenderBlocking.php");

	class Scan_Performance {

		private $dom;
		private $url;
		private $originalRawHTML;
		public $resultsPerformance;

		public function __construct($dom, $url, $source){
			$this->dom = $dom;
			$this->url = $url;
			$this->originalRawHTML = $source;
			$this->resultsPerformance = new Results_Performance();
		}

		public function scan(){

			$this->resultsPerformance->resultsBrowserCaching = $this->runScan_BrowserCaching();
			$this->resultsPerformance->resultsCompression = $this->runScan_Compression();
			$this->resultsPerformance->resultsHTTPRequests = $this->runScan_HTTPRequests();
			$this->resultsPerformance->resultsPageLoad = $this->runScan_PageLoad();
			$this->resultsPerformance->resultsPageRedirects = $this->runScan_PageRedirects();
			$this->resultsPerformance->resultsPageSize = $this->runScan_PageSize();
			$this->resultsPerformance->resultsRenderBlocking = $this->runScan_RenderBlocking();
			return $this->resultsPerformance;
		}

		public function runScan_BrowserCaching(){
			$scanBrowserCaching = new Scan_BrowserCaching($this->dom, $this->url);
			return $scanBrowserCaching->scan();
		}

		public function runScan_Compression(){
			$scanCompresion = new Scan_Compression($this->dom, $this->url, $this->originalRawHTML);
			return $scanCompresion->scan();
		}

		public function runScan_HTTPRequests(){
			$scanHTTPRequests = new Scan_HTTPRequests($this->dom);
			return $scanHTTPRequests->scan();
		}

		public function runScan_PageLoad(){
			$scanPageLoad = new Scan_PageLoad($this->dom, $this->url);
			return $scanPageLoad->scan();
		}

		public function runScan_PageRedirects(){
			$scanPageRedirects = new Scan_PageRedirects($this->dom, $this->url);
			return $scanPageRedirects->scan();
		}

		public function runScan_PageSize(){
			$scanPageSize = new Scan_PageSize($this->dom, $this->url, $this->originalRawHTML);
			return $scanPageSize->scan();
		}

		public function runScan_RenderBlocking(){
			$scanRenderBlocking = new Scan_RenderBlocking($this->dom, $this->url, $this->originalRawHTML);
			return $scanRenderBlocking->scan();
		}


	}

?>
