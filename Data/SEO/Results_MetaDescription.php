<?php
	class Results_MetaDescription {

		public $hasMetaDescription;
		public $charCount;
		public $testPassed;

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
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
