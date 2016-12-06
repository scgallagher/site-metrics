<?php
	class Results_MetaDescription {

		public $hasMetaDescription;
		public $charCount;
		public $testPassed;
		public $rating;

		public function __construct(){
			$this->charCount = 0;
		}

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			if($this->hasMetaDescription == true){
				$results["hasMetaDescription"] = "Yes";
			}
			else {
				$results["hasMetaDescription"] = "No";
			}
			$results["charCount"] = $this->charCount;
			$results["rating"] = $this->rating;
			return $results;
		}

		public function __toString(){
			$output = "";

			$output .= "Results: Meta Description\n";
			if ($this->hasMetaDescription) {
				$output .= "\tChar Count: " . $this->charCount . "\n";
			}
			else {
				$output .= "\tNo meta description found\n";
			}

			return $output;
		}

	}
?>
