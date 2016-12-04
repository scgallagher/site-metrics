<?php

	require_once("Data/Performance/Results_RenderBlocking.php");

	class Scan_RenderBlocking {

		private $dom;
		private $url;
		private $resultsRenderBlocking;
		
		private $originalSiteContents;

		public function __construct($dom, $url, $originalRawHTML){
			$this->dom = $dom;
			$this->url = $url;
			$this->originalSiteContents = $originalRawHTML;
			$this->resultsRenderBlocking = new Results_RenderBlocking();
		}

		public function scan(){
			//$this->originalSiteContents = file_get_contents($this->url);
			$this->originalSiteContents = file_get_contents($this->url);
			
			//Check for CSS @import
			$this->CheckCssImport();
			
			//Check <link> tags for "media" attribute
			$this->CheckLinkTagsForMediaAttribute();
			
			//Check for multiple CSS files
			$this->CheckForMultipleCss();
			
			//Check for JS in heading
			$this->CheckForJavaScriptInHeading();
			
			//Check if onLoad() is used to load JS
			$this->CheckForOnLoad();
			
			//Return results
			return $this->resultsRenderBlocking;
		}
		
		private function CheckCssImport() {
			if(preg_match('/@import +url\("[A-Za-z0-9]+.css"', $this->originalSiteContents))
				$this->resultsRenderBlocking->cssImportResult = "Bad";
			else
				$this->resultsRenderBlocking->cssImportResult = "Good";
		}
		
		private function CheckLinkTagsForMediaAttribute() {
			$numLinkTags = 0;
			$numMediaAttributes = 0;
			
			$linkTags = $this->dom->getElementsByTagName('link');
			foreach ($linkTags as $linkTag) {
				$numLinkTags = $numLinkTags + 1; //echo $linkTag->nodeValue, PHP_EOL;
				
				if ($linkTag->hasAttribute("media"))
					$numMediaAttributes = $numMediaAttributes + 1;
				
				if ($numMediaAttributes > 0 && $numLinkTags > $numMediaAttributes) { //Early quit
					$this->resultsRenderBlocking->linkTagsWithMediaAttributeResult = "Ok";
					return;
				}
			}
			
			//Set result
			if ($numLinkTags == $numMediaAttributes)
				$this->resultsRenderBlocking->linkTagsWithMediaAttributeResult = "Good";
			elseif ($numLinkTags > $numMediaAttributes)
				$this->resultsRenderBlocking->linkTagsWithMediaAttributeResult = "Bad";
			else
				$this->resultsRenderBlocking->linkTagsWithMediaAttributeResult = "ERROR";
		}

		private function CheckForMultipleCss() {
			//Find all css references
			$pattern = "/[A-Za-z0-9]+\.css[^A-Za-z0-9]/";
			preg_match_all($pattern, $this->originalSiteContents, $matches);
			
			//Check if any css references are different
			$matches = $matches[0];
			foreach ($matches as $match) {
				if (substr($match, 0, -1) != substr($matches[0], 0, -1)) { //We trim off the last character because the regular expression includes a non-alphanumeric
					$this->resultsRenderBlocking->multipleCssResult = "Bad";
					return;
				}
			}
			
			//If not, good
			$this->resultsRenderBlocking->multipleCssResult = "Good";
		}
		
		private function CheckForJavaScriptInHeading() {
			$headTags = $this->dom->getElementsByTagName('head');
			foreach ($headTags as $headTag) {
				//Check if it has a <script> child
				$scriptTags = $headTag->getElementsByTagName('script');
				foreach ($scriptTags as $scriptTag) {
					$this->resultsRenderBlocking->scriptTagsInHeadResult = "Bad"; //Found
					return;
				}
			}
			
			//Set result
			$this->resultsRenderBlocking->scriptTagsInHeadResult = "Good";
		}
		
		private function CheckForOnLoad() {
			$bodyTags = $this->dom->getElementsByTagName('body');
			foreach ($bodyTags as $bodyTag) {
				//Check if it has onLoad attribute
				if ($bodyTag->hasAttribute("onLoad")) {
					$this->resultsRenderBlocking->onLoadResult = "Good"; //Found
					return;
				}
			}
			
			//Set result
			if(preg_match('/[Oo][Nn][Ll][Oo][Aa][Dd]/', $this->originalSiteContents))
				$this->resultsRenderBlocking->onLoadResult = "Ok";
			else
				$this->resultsRenderBlocking->onLoadResult = "Bad";
		}
	}

?>