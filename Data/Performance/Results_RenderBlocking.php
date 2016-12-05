<?php

	class Results_RenderBlocking {
		
		//General Metric(s)
		public $cssImportResult;
		public $linkTagsWithMediaAttributeResult;
		public $multipleCssResult;
		public $scriptTagsInHeadResult;
		public $onLoadResult;
		
		//Specific Metric(s)

		public function __toString(){
			$output = "";
			return $output;
		}
		
		public function testPassed()
		{
			if (strtolower($this->cssImportResult) == "good"
				&& strtolower($this->cssImportResult) == "good"
				&& strtolower($this->cssImportResult) == "good"
				&& strtolower($this->cssImportResult) == "good"
				&& strtolower($this->cssImportResult) == "good")
			{
				return true;
			}
			
			return false;
		}

	}

?>