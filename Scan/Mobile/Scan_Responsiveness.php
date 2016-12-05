<?php

	require_once("Data/Mobile/Results_Responsiveness.php");

	class Scan_Responsiveness {

		private $dom;
		private $resultsResponsiveness;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsResponsiveness = new Results_Responsiveness();
		}

		public function scan(){
			//return $this->resultsResponsiveness;
			$this->CheckTags();
			$this->resultsResponsiveness->testPassed = $this->testPassed();
			//return results
			return $this->resultsResponsiveness;
		}

		public function CheckTags(){
			$linkTags = $this->dom->getElementsByTagName("link");
			//FB::log("got tags!");
			foreach ($linkTags as $linkTag) {
				if($linkTag->hasAttribute("rel")){
					$linkContents = $linkTag->getAttribute("rel");
					if($linkContents == "stylesheet"){
						$url = $linkTag->getAttribute("src");
						$source = getSource($url);
						$this->resultsResponsiveness->hasMediaQueries = CheckMediaQueries($source);
					}
				}
			}

					//checking for bootstrap
					$metaTags = $this->dom->getElementsByTagName("script");
					//FB::log("got tags!");
					foreach ($metaTags as $metaTag) {
						if($metaTag->hasAttribute("src")){
							$metaContents = $metaTag->getAttribute("src");
							if(preg_match('/bootstrap/', $metaContents)){
								//found, is enabled
								$this->resultsResponsiveness->hasBootstrap = "Yes";
								return;
								}
						}
					}
					//if not found, it is not enabled
					$this->resultsViewportOptimization->usesContentViewport = "No";
					return;
		}

		private function CheckMediaQueries($source){
			if(preg_match('/^@media/', $source){
				return "Yes";
			}
			return "No";
		}

		private function getSource($url){
			// $srcText = tmpfile();
			$headerText = tmpfile();
			$curlHandle = curl_init();

			curl_setopt($curlHandle, CURLOPT_URL, $url);
			//curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			//curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 0);
		  //curl_setopt($curlHandle, CURLOPT_CERTINFO, 1);
			//curl_setopt($curlHandle, CURLOPT_VERBOSE, 1);
			curl_setopt($curlHandle, CURLOPT_STDERR, $headerText);
			//curl_setopt($curlHandle, CURLOPT_FILE, $srcText);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			$source = curl_exec($curlHandle);
			curl_close($curlHandle);
			return $source;
		}

		function testPassed(){
			if($this->resultsResponsiveness->hasMediaQueries == "Yes" &&
				$this->resultsResponsiveness->hasBootstrap == "Yes"){
					return true;
				}
				return false;
		}
	}

?>
