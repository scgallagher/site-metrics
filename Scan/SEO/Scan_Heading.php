<?php

	require_once("Data/SEO/Results_Heading.php");

	class Scan_Heading {

		private $dom;
		private $resultsHeading;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsHeading - new Results_Heading();
		}

		public function scan(){
			return $this->resultsHeading;
		}

	}

?>