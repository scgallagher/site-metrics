<?php
header("Content-Type: application/json");
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
	require_once("Scan/ScanController.php");
	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");
	require_once("DataManager.php");

	//cli();
	web();

	function cli(){
		$scanController = new ScanController("http://localhost/wordpress/");
		$resultsAll = $scanController->scan();
		$resultsAll->parseJSON();
		$dm = new DataManager("http://localhost/wordpress/", "seangallagher135@gmail.com", $resultsAll);
		$dm->write();
	}

	function web(){
		$email = $_GET["email"];
		$json = array();

		if(!isset($_POST["url"])){
		  $json["error"] = "URL not set!";
		}
		if(!isset($json["error"])){
			$url = $_POST["url"];
			FB::info("URL: $url");
			FB::info("Server: Running scan on URL $url");
			FB::info("Email: $email");

			$scanController = new ScanController($url);
			$resultsAll = $scanController->scan();
			$json["results"] = $resultsAll->parseJSON();
			$dm = new DataManager($url, $email, $resultsAll);
			$dm->write();
		}

		echo json_encode($json);
	}

?>
