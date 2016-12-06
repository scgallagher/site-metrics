<?php

	class Results_PageTitle {

		public $hasTitle;
		public $charCount;
		public $isCompanyNameFirst;
		public $testPassed;
		public $rating;

		public function __construct(){
			$this->charCount = 0;
		}

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			if($this->hasTitle == true){
				$results["hasTitle"] = "Yes";
			}
			else {
				$results["hasTitle"] = "No";
			}
			$results["charCount"] = $this->charCount;
			$results["rating"] = $this->rating;
			return $results;
		}

		public function __toString(){

			$output = "";
			$output .= "Results: Page Title\n";
			if($this->hasTitle){
				$output .= "\tCharacter Count: " . $this->charCount . "\n";
			}
			else {
				$output .= "\tNo page title found\n";
			}
			return $output;
		}
	}

?>
