<?php
	ini_set('display_errors', 'Off');
	error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
	require_once("Scan/ScanController.php");
	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");

	//$scanController = new ScanController("http://localhost/wordpress/");
	//$scanController = new ScanController("https://www.nhl.com");
	$scanController = new ScanController("http://www.apple.com/imac");
	$resultsAll = $scanController->scan();

	$resultsTitle = $resultsAll->resultsSearchEngineOptimizations->resultsPageTitle;
	$resultsHeading = $resultsAll->resultsSearchEngineOptimizations->resultsHeading;
	$resultsCompression = $resultsAll->resultsPerformance->resultsCompression;
	$resultsPageRedirects = $resultsAll->resultsPerformance->resultsPageRedirects;

	// echo "-- Page Title -- <br>";
	// echo "Character Count: " . $resultsTitle->charCount . "<br>";
	// echo "<br>";
	echo $resultsTitle . "<br>";
	echo $resultsHeading . "<br>";
	echo "Compression: " . $resultsCompression->compressionResult . " (" . $resultsCompression->compressionPercentage . "% able to be compressed)<br>";
	echo "Redirects: " . $resultsPageRedirects->redirectsResult . " (" . $resultsPageRedirects->redirectCount . " redirects)<br>";

?>
