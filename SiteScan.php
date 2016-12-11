<?php
header("Content-Type: application/json");

	// Dev error settings
	// NOTE: CLI ONLY - Comment this section out when serving
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL | E_STRICT);

	// Prod error settings
	// The following two lines are necessary to suppress a strange warning
	// being thrown by ScanController.php THE PAGE WILL NOT LOAD WITHOUT THIS SET
	ini_set('display_errors', 'Off');
 	error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

	require_once("Scan/ScanController.php");
	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");
	require_once("DataManager.php");
	require_once("Data/Exceptions/urlException.php");

	//cli();
	web();

	function cli(){
		$scanController = new ScanController("https://expired.badssl.com/");
		//$scanController = new ScanController("https://www.nhl.com/");
		$resultsAll = $scanController->scan();
		$resultsAll->parseJSON();
		// $dm = new DataManager("https://expired.badssl.com/", "seangallagher135@gmail.com", $resultsAll);
		// $dm->write();
	}

	function web(){
		$email = $_GET["email"];
		$json = array();
		$validURL = true;

		if(!isset($_POST["url"])){
		  $json["error"] = "URL not set!";
		}
		if(!isset($json["error"])){
			$url = $_POST["url"];
			FB::info("URL: $url");
			FB::info("Server: Running scan on URL $url");
			FB::info("Email: $email");

			try{
				$scanController = new ScanController($url);
				$resultsAll = $scanController->scan();
				$json["results"] = $resultsAll->parseJSON();
			}
			catch(urlException $e){
				//$json["urlError"] = array($e->getHeading(), $e->errorMessage());
				$json["urlError"] = array();
				$json["urlError"]["heading"] = $e->getHeading();
				$json["urlError"]["message"] = $e->errorMessage();
				$validURL = false;
			}

			if($validURL){
				try{
					$dm = new DataManager($url, $email, $resultsAll);
					$dm->write();
				}
				catch(PDOException $e){
					$json["sqlError"] = "SQL Error:\n  " . $e->getMessage() .
						"\nResults were NOT written to database.";
				}
			}

		}

		echo json_encode($json);
	}

?>
