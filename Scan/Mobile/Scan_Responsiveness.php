<?php

	require_once("Data/Mobile/Results_Responsiveness.php");

	class Scan_Responsiveness {

		private $dom;
		private $resultsResponsiveness;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsResponsiveness = new Results_Responsiveness();
		}

		public function scan(){
			return $this->resultsResponsiveness;
		}

	}

?>