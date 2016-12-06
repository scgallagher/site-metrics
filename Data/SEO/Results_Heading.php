<?php
	class Results_Heading {

		public $hasH1;
		public $h1Count;
		public $h2Count;
		public $h3Count;
		public $wordCount;
		public $testPassed;
		public $rating;

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
			if($this->hasH1 == true){
				$results["hasH1"] = "Yes";
			}
			else {
				$results["hasH1"] = "No";
			}
			$results["h1Count"] = $this->h1Count;
			$results["h2Count"] = $this->h2Count;
			$results["h3Count"] = $this->h3Count;
			$results["rating"] = $this->rating;
			return $results;
		}

		public function __toString(){
			$output = "";
			$output .= "Results: Heading\n";
			$output .= "\tH1 Count: " . $this->h1Count . "\n";
			$output .= "\tH2 Count: " . $this->h2Count . "\n";
			$output .= "\tH3 Count: " . $this->h3Count . "\n";
			return $output;
		}

	}
?>
