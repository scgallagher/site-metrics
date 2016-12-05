<?php

	class Results_Compression {
		
		//General Metric(s)
		public $compressionResult;
		
		//Specific Metric(s)
		public $compressionPercentage;

		public function __toString(){
			$output = "";
			return $output;
		}
		
		public function testPassed()
		{
			if (strtolower($this->compressionResult) == "good")
			{
				return true;
			}
			
			return false;
		}

	}

?>