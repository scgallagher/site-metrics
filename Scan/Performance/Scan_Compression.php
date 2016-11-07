<?php

	require_once("Data/Performance/Results_Compression.php");

	class Scan_Compression {

		private $dom;
		private $resultsCompression;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsCompression = new Results_Compression();
		}

		public function scan(){
			return $this->resultsCompression;
		}

	}

?>