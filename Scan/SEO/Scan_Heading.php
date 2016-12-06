<?php

	require_once("Data/SEO/Results_Heading.php");

	class Scan_Heading {

		private $dom;
		private $resultsHeading;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsHeading = new Results_Heading();
		}

		public function scan(){
			$this->resultsHeading->h1Count = $this->countH1();
			$this->resultsHeading->h2Count = $this->countH2();
			$this->resultsHeading->h3Count = $this->countH3();
			
			$this->resultsHeading->rating = $this->getRating();
			$this->resultsHeading->testPassed = $this->testPassed();

			return $this->resultsHeading;
		}

		private function countH1(){
			$h1_list = $this->dom->getElementsByTagName("h1");
			$h1_count = $h1_list->length;
			if($h1_count > 0){
				$this->resultsHeading->hasH1 = true;
			}
			else {
				$this->resultsHeading->hasH1 = false;
			}
			return $h1_count;
		}

		private function countH2(){
			$h2_list = $this->dom->getElementsByTagName("h2");
			return $h2_list->length;
		}

		private function countH3(){
			$h3_list = $this->dom->getElementsByTagName("h3");
			return $h3_list->length;
		}

		private function testPassed(){
			if(!$this->resultsHeading->hasH1 ||
				$this->resultsHeading->h1Count > 1){
				return false;
			}
			else{
				return true;
			}
		}

		private function getRating(){
			if($this->resultsHeading->hasH1 && $this->resultsHeading->h1Count == 1){
				return "good";
			}
			else if(!$this->resultsHeading->hasH1 && $this->resultsHeading->hasH2
				&& $this->resultsHeading->hasH3){
					return "okay";
			}
			else {
				return "bad";
			}
		}

	}

?>
