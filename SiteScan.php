<?php
	
	require_once("Scan/ScanController.php");

	$scanController = new ScanController("http://localhost/wordpress/");
	$resultsAll = $scanController->scan();

	$resultsTitle = $resultsAll->resultsSearchEngineOptimizations->resultsPageTitle;

	echo "-- Page Title -- <br>";
	echo "Character Count: " . $resultsTitle->charCount . "<br>";
//test
?>