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
			$this->resultsMetaDescription->testPassed = $this->testPassed();
			$this->resultsMetaDescription->rating = $this->getRating();
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
				$count >= 150 && $count <= 160){
				return true;
			}
			return false;
		}

		private function getRating(){
			$count = $this->resultsMetaDescription->charCount;
			if($count >= 150 && $count <= 160){
				return "good";
			}
			else if(($count >= 100 && $count < 150) || ($count > 160 && <= 210)){
				return "okay";
			}
			else {
				return "bad";
			}
		}

	}

?>
