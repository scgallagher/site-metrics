<?php
header("Content-Type: application/json");
	ini_set('display_errors', 'Off');
	error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
	require_once("Scan/ScanController.php");
	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");

	$email = $_GET["email"];


	//$scanController = new ScanController("https://www.nhl.com");
	//$scanController = new ScanController("http://www.apple.com/imac");
	//$scanController = new ScanController("http://www.google.com");


	$json = array();

	if(!isset($_POST["url"])){
	  $json["error"] = "URL not set!";
	}
	if(!isset($json["error"])){
		$url = $_POST["url"];
		FB::info("Server: Running scan on URL $url");
		$scanController = new ScanController($url);
		$resultsAll = $scanController->scan();
		$json["results"] = $resultsAll->parseJSON();
	}
	//FB::log($results);
	echo json_encode($json);

?>
