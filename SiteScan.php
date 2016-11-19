<?php
	ini_set('display_errors', 'Off');
	error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
	require_once("Scan/ScanController.php");
	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");

	$scanController = new ScanController("http://localhost/wordpress/");
	$resultsAll = $scanController->scan();

	$resultsTitle = $resultsAll->resultsSearchEngineOptimizations->resultsPageTitle;
	$resultsHeading = $resultsAll->resultsSearchEngineOptimizations->resultsHeading;

	// echo "-- Page Title -- <br>";
	// echo "Character Count: " . $resultsTitle->charCount . "<br>";
	// echo "<br>";
	echo $resultsTitle;
	echo $resultsHeading;

?>
