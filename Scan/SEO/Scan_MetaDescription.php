<?php

	require_once("Data/SEO/Results_MetaDescription.php");

	class Scan_MetaDescription {

		private $dom;
		private $resultsMetaDescription;

		private $metaDescription;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsMetaDescription = new Results_MetaDescription();
		}

		public function scan(){
			$this->resultsMetaDescription->hasMetaDescription = $this->getMetaDescription();
			if ($this->resultsMetaDescription->hasMetaDescription) {
				$this->resultsMetaDescription->charCount = $this->getCharCount();
			}
			//echo $this->resultsMetaDescription;
			return $this->resultsMetaDescription;
		}

		private function getMetaDescription(){

			$metaList = $this->dom->getElementsByTagName("meta");

			foreach($metaList as $item){
				if ($item->getAttribute("name") == "description") {
					$this->metaDescription = $item->getAttribute("content");
					return true;
				}
			}
			return false;
		}

		private function getCharCount(){
			return strlen($this->metaDescription);
		}

		private function testPassed(){
			$count = $this->resultsMetaDescription->charCount;
			if($this->resultsMetaDescription->hasMetaDescription &&
				count >= 150 && count <= 160){
				return true;
			}
			return false;
		}

	}

?>
