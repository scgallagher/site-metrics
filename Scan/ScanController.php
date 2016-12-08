<?php

	require_once("Data/Results_All.php");
	require_once("Scan/Scan_SearchEngineOptimizations.php");
	require_once("Scan/Scan_Mobile.php");
	require_once("Scan/Scan_Performance.php");
	require_once("Scan/Scan_Security.php");
	require_once("Data/Exceptions/urlException.php");

	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");

	class ScanController {

		public $resultsAll;

		private $header;
		private $source;
		private $dom;
		private $url;

		public function __construct($url){
			$this->url = $url;
			$this->resultsAll = new Results_All();

			$this->header = "";
			$this->source = "";

			$this->getSource();
			$this->getDOM();
		}

		public function scan(){
			$this->resultsAll->resultsSEO = $this->runScan_SearchEngineOptimizations();
			$this->resultsAll->resultsMobile = $this->runScan_Mobile();
			$this->resultsAll->resultsPerformance = $this->runScan_Performance();
			$this->resultsAll->resultsSecurity = $this->runScan_Security();
			return $this->resultsAll;
		}

		public function runScan_SearchEngineOptimizations(){
			$scanSearchEngineOptimizations = new Scan_SearchEngineOptimizations($this->dom);
			return $scanSearchEngineOptimizations->scan();
		}

		public function runScan_Mobile(){
			$scanMobile = new Scan_Mobile($this->dom, $this->url);
			return $scanMobile->scan();
		}

		public function runScan_Performance(){
			$scanPerformance = new Scan_Performance($this->dom, $this->url, $this->source);
			return $scanPerformance->scan($this->dom);
		}

		public function runScan_Security(){
			$scanSecurity = new Scan_Security($this->dom, $this->header, $this->url);
			return $scanSecurity->scan();
		}

		private function getSource(){
			// $srcText = tmpfile();
			$headerText = tmpfile();
			$curlHandle = curl_init();

			curl_setopt($curlHandle, CURLOPT_URL, $this->url);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curlHandle, CURLOPT_CERTINFO, 1);
			curl_setopt($curlHandle, CURLOPT_VERBOSE, 1);
			curl_setopt($curlHandle, CURLOPT_STDERR, $headerText);
			// Follow redirects
			curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, true);
			//curl_setopt($curlHandle, CURLOPT_FILE, $srcText);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			$this->source = curl_exec($curlHandle);


			if(curl_error($curlHandle)){
				throw new urlException(curl_error($curlHandle));
				//FB::log(curl_error($curlHandle));
			}
			$returnCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
			if($returnCode != 200){
				throw new urlException("URL Error: request returned response code $returnCode");
			}
			//FB::log($this->source);
			//Set $header to the verbose output returned by curl_exec
			fseek($headerText, 0);
			while(strlen($this->header .= fread($headerText, 8192)) == 8192);
			// $header now contains header information for the curl
			// operation that can be parsed to get size and load time

			curl_close($curlHandle);

		}

		private function getDOM(){
			$this->dom = new DOMDocument();
			libxml_use_internal_errors(true);
			$this->dom->loadHTML($this->source);
			libxml_use_internal_errors(false);

		}

		private function testDom(){
			$title = $this->dom->getElementsByTagName("title");
			echo "Title Tags: " . $title->length . "\n";

			// Prints inner html of title tag
			foreach($title as $tag){
				echo $tag->nodeValue . "\n";
			}
		}

	}

?>
