<?php

	require_once("Data/Performance/Results_PageSize.php");

	class Scan_PageSize {

		private $dom;
		private $resultsPageSize;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsPageSize = new Results_PageSize();
		}

		public function scan(){
			return $this->resultsPageSize;
		}

	}

?>