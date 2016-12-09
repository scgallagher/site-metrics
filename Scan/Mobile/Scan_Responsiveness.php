<?php

	require_once("Data/Mobile/Results_Responsiveness.php");

	class Scan_Responsiveness {

		private $dom;
		private $resultsResponsiveness;
		private $mediaQueries = 0;
		private $url;

		public function __construct($dom, $url){
			$this->dom = $dom;
			$this->url = $url;
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
			$this->resultsResponsiveness->rating = $this->getRating();
			//return results
			return $this->resultsResponsiveness;
		}

		public function getFullUrl($href){
			if(!preg_match('/^(http:\/\/|https:\/\/)/', $href)){
				$tokens = explode("/", $this->url);
				$last = $tokens[count($tokens) - 1];
				if(preg_match('/.+\\..+/', $last)){
					$href = substr($this->url, 0, strlen($this->url) - strlen($last)) . $href;
				}
				else {
					$href = $this->url . $href;
				}
			}
			return $href;
		}

		public function CheckTags(){
			$linkTags = $this->dom->getElementsByTagName("link");
			foreach ($linkTags as $linkTag) {
				if($linkTag->hasAttribute("rel")){
					$linkContents = $linkTag->getAttribute("rel");
					if($linkContents == "stylesheet"){
						$href = $linkTag->getAttribute("href");
						$href = $this->getFullUrl($href);
						$source = $this->getSource($href);
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
							if(preg_match('/bootstrap/', $src)){
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

			$curlHandle = curl_init();

			curl_setopt($curlHandle, CURLOPT_URL, $url);
			//curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			//curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 0);
		  //curl_setopt($curlHandle, CURLOPT_CERTINFO, 1);
			//curl_setopt($curlHandle, CURLOPT_VERBOSE, 1);
			// Follow redirects
			curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, true);
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

		function getRating(){
			if($this->resultsResponsiveness->hasMediaQueries === "Yes" &&
				$this->resultsResponsiveness->hasBootstrap === "Yes"){
					return "good";
			}
			else if($this->resultsResponsiveness->hasMediaQueries === "Yes" ||
				$this->resultsResponsiveness->hasBootstrap === "Yes"){
					return "okay";
			}
			else {
				return "bad";
			}
		}
	}

?>
