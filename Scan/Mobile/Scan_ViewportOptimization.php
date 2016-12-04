<?php


	require_once("Data/Mobile/Results_ViewportOptimization.php");

	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");

	class Scan_ViewportOptimization {

		private $dom;
		private $resultsViewportOptimization;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsViewportOptimization = new Results_ViewportOptimization();
		}

		public function scan(){
			FB::log("entered scan!");
			$this->CheckforContentViewport();
			//return results
			return $this->resultsViewportOptimization;
		}

		private function CheckforContentViewport(){
			$metaTags = $this->dom->getElementsByTagName("meta");
			FB::log("got tags!");
			foreach ($metaTags as $metaTag) {
				if($metaTag->hasAttribute("content")){
					$metaContents = $metaTag->getAttribute("content");
					if(preg_match('/width\s*=\s*device-width/', $metaContents) && preg_match('/initial-scale\s*=\s*(1\.0|1)/', $metaContents)){
						//found, is enabled
						$this->resultsViewportOptimization->usesContentViewport = "Viewport optimization enabled.";
						return;
						}
				}
			}
			//if not found, it is not enabled
			$this->resultsViewportOptimization->usesContentViewport = "Viewport optimization is not enabled.";
			return;
		}

	}

?>
