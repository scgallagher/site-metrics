<?php

	class Results_RenderBlocking {

		//General Metric(s)
		public $cssImportResult;
		public $linkTagsWithMediaAttributeResult;
		public $multipleCssResult;
		public $scriptTagsInHeadResult;
		public $onLoadResult;
		public $testPassed;

		//Specific Metric(s)

		public function __toString(){
			$output = "";
			return $output;
		}

		public function parseJSON(){
			$results = array();
			$results["cssImportResult"] = $this->cssImportResult;
			$results["linkTagsWithMediaAttributeResult"] = $this->linkTagsWithMediaAttributeResult;
			$results["multipleCssResult"] = $this->multipleCssResult;
			$results["scriptTagsInHeadResult"] = $this->scriptTagsInHeadResult;
			$results["onLoadResult"] = $this->onLoadResult;
			$results["testPassed"] = $this->testPassed;
			return $results;
		}

	}

?>
