<?php
//
	ini_set('display_errors', 'Off');
	error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
	require_once("Scan/ScanController.php");
	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");

	//$scanController = new ScanController("http://localhost/wordpress/");
	//$scanController = new ScanController("https://www.nhl.com");
	//$scanController = new ScanController("http://www.apple.com/imac");
	$scanController = new ScanController("http://www.google.com");
	$resultsAll = $scanController->scan();

	$resultsTitle = $resultsAll->resultsSearchEngineOptimizations->resultsPageTitle;
	$resultsHeading = $resultsAll->resultsSearchEngineOptimizations->resultsHeading;
	$resultsCompression = $resultsAll->resultsPerformance->resultsCompression;
	$resultsPageRedirects = $resultsAll->resultsPerformance->resultsPageRedirects;
	$resultsPageSize = $resultsAll->resultsPerformance->resultsPageSize;
	$resultsRenderBlocking = $resultsAll->resultsPerformance->resultsRenderBlocking;
	$resultsViewportOptimization = $resultsAll->resultsMobile->resultsViewportOptimization;

	echo "-- Page Title -- <br>";
	echo "Character Count: " . $resultsTitle->charCount . "<br>";
	echo "<br>";
	echo $resultsTitle . "<br>";
	echo $resultsHeading . "<br>";
	echo "Compression: " . $resultsCompression->compressionResult . " (" . round($resultsCompression->compressionPercentage, 2) . "% able to be compressed)<br>";
	echo "Redirects: " . $resultsPageRedirects->redirectsResult . " (" . $resultsPageRedirects->redirectCount . " redirects)<br>";
	echo "Page Size: " . $resultsPageSize->pageSizeResult . " (" . $resultsPageSize->pageSizeInBytes . " bytes)<br>";
	echo "RENDER BLOCKING:<br>";
	echo "- CSS @import: " . $resultsRenderBlocking->cssImportResult . "<br>";
	echo "- 'link' tags: " . $resultsRenderBlocking->linkTagsWithMediaAttributeResult . "<br>";
	echo "- Multiple css: " . $resultsRenderBlocking->multipleCssResult . "<br>";
	echo "- Script in head: " . $resultsRenderBlocking->scriptTagsInHeadResult . "<br>";
	echo "- onload usage: " . $resultsRenderBlocking->onLoadResult . "<br>";
	// echo "VIEWPORT OPTIMIZATION:<br>";
	// echo $resultsViewportOptimization->usesContentViewport . "<br>";

?>
