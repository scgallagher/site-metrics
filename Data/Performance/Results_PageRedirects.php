<?php

	class Results_PageRedirects {
		
		//General Metric(s)
		public $redirectsResult;
		
		//Specific Metric(s)
		public $redirectCount;

		public function __toString(){
			$output = "";
			return $output;
		}
		
		public function testPassed()
		{
			if (strtolower($this->redirectsResult) == "good")
			{
				return true;
			}
			
			return false;
		}

	}

?>