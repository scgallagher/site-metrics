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
					if(($metaContents == "width=device-width, initial-scale=1.0") || ($metaContents == "width=device-width, initial-scale=1")){
						//found, is enabled
						$this->resultsViewportOptimization->usesContentViewport = "Viewport optimization enabled.";
						}
				}
		}
		//if not found, it is not enabled
		$this->resultsViewportOptimization->usesContentViewport = "Viewport optimization is not enabled.";
	}

?>
