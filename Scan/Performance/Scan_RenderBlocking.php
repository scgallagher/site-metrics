<?php

	require_once("Data/Performance/Results_RenderBlocking.php");

	class Scan_RenderBlocking {

		private $dom;
		private $resultsRenderBlocking;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsRenderBlocking = new Results_RenderBlocking();
		}

		public function scan(){
			return $this->resultsRenderBlocking;
		}

	}

?>