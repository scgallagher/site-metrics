<?php

	class Results_PageTitle {

		public $hasTitle;
		public $charCount;
		public $isCompanyNameFirst;	

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