<?php

	require_once("Data/SEO/Results_MetaDescription.php");

	class Scan_MetaDescription {

		private $dom;
		private $resultsMetaDescription;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsMetaDescription = new Results_MetaDescription();
		}

		public function scan(){
			return $this->resultsMetaDescription;
		}

	}

?>