<?php
header("Content-Type: application/json");
	ini_set('display_errors', 'Off');
	error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
	require_once("Scan/ScanController.php");
	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");

	$email = $_GET["email"];

	$scanController = new ScanController("http://localhost/wordpress/");
	//$scanController = new ScanController("https://www.nhl.com");
	//$scanController = new ScanController("http://www.apple.com/imac");
	//$scanController = new ScanController("http://www.google.com");
	$resultsAll = $scanController->scan();

	$json = array();

	$json["results"] = $resultsAll->parseJSON();
	FB::log($results);
	echo json_encode($json);

?>
