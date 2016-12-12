<?php


	require_once("Data/Mobile/Results_ViewportOptimization.php");

	class Scan_ViewportOptimization {

		private $dom;
		private $resultsViewportOptimization;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsViewportOptimization = new Results_ViewportOptimization();
		}

		public function scan(){
			$this->CheckforContentViewport();
			$this->resultsViewportOptimization->rating = $this->getRating();
			//return results
			return $this->resultsViewportOptimization;
		}

		private function CheckforContentViewport(){
			$metaTags = $this->dom->getElementsByTagName("meta");
			foreach ($metaTags as $metaTag) {
				if($metaTag->hasAttribute("content")){
					$metaContents = $metaTag->getAttribute("content");
					if(preg_match('/width\s*=\s*device-width/', $metaContents) && preg_match('/initial-scale\s*=\s*(1\.0|1)/', $metaContents)){
						//found, is enabled
						$this->resultsViewportOptimization->usesContentViewport = "Yes";
						return;
						}
				}
			}
			//if not found, it is not enabled
			$this->resultsViewportOptimization->usesContentViewport = "No";
			return;
		}

		private function getRating(){
			if($this->resultsViewportOptimization->usesContentViewport === "Yes"){
				return "good";
			}
			else {
				return "bad";
			}
		}

	}

?>
