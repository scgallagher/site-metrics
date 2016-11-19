<?php
	class Results_Heading {

		public $hasH1;
		public $h1Count;
		public $h2Count;
		public $h3Count;
		public $wordCount;

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
