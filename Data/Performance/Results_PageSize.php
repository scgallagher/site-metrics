<?php

	class Results_PageSize {
		
		//General Metric(s)
		public $pageSizeResult;
		
		//Specific Metric(s)
		public $pageSizeInBytes;

		public function __toString(){
			$output = "";
			return $output;
		}
		
		public function testPassed()
		{
			if (strtolower($this->pageSizeResult) == "good")
			{
				return true;
			}
			
			return false;
		}

	}

?>