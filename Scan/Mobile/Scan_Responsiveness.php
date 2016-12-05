<?php

	require_once("Data/Mobile/Results_Responsiveness.php");

	class Scan_Responsiveness {

		private $dom;
		private $resultsResponsiveness;
		private $mediaQueries = 0;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsResponsiveness = new Results_Responsiveness();
		}

		public function scan(){
			//return $this->resultsResponsiveness;
			$this->CheckTags();
			if($this->mediaQueries > 0){
				$this->resultsResponsiveness->hasMediaQueries = "Yes";
			}
			else {
				$this->resultsResponsiveness->hasMediaQueries = "No";
			}
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
						$url = $linkTag->getAttribute("href");
						$source = $this->getSource($url);
						if($this->CheckMediaQueries($source)){
								$this->mediaQueries++;
						}
					}
				}
			}

					//checking for bootstrap
					$scriptTags = $this->dom->getElementsByTagName("script");
					//FB::log("got tags!");
					foreach ($scriptTags as $script) {
						if($script->hasAttribute("src")){
							$src = $script->getAttribute("src");
							if(preg_match('/bootstrap/', $metaContents)){
								//found, is enabled
								$this->resultsResponsiveness->hasBootstrap = "Yes";
								return;
								}
						}
					}
					//if not found, it is not enabled
					$this->resultsResponsiveness->hasBootstrap = "No";
					return;
		}

		private function CheckMediaQueries($source){
			if(preg_match('/^@media/', $source)){
				return true;
			}
			return false;
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
