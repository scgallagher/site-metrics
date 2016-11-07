<?php

	require_once("Data/Results_SearchEngineOptimizations.php");

	class Results_All {
		public $resultsSEO;

		public function __construct(){
			$resultsSEO = new Results_SearchEngineOptimizations();
		}
	}

?>