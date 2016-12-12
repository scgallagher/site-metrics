<?php
header("Content-Type: application/json");

	// Prod error settings
	ini_set('display_errors', 'Off');
 	error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

	require_once("Scan/ScanController.php");
	require_once("Email/EmailController.php");
	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");
	require_once("DataManager.php");
	require_once("Data/Exceptions/urlException.php");

	web();

	// Use this function when running the plugin through Wordpress
	function web(){
		$email = $_GET["email"];
		$json = array();
		$validURL = true;

		if(!isset($_POST["url"])){
		  $json["error"] = "URL not set!";
		}
		if(!isset($json["error"])){
			$url = $_POST["url"];
			try{
				$scanController = new ScanController($url);
				$resultsAll = $scanController->scan();
				$json["results"] = $resultsAll->parseJSON();

				$emailController = new EmailController();
				$addContactResult = $emailController->addContact(new Contact($email));
			}
			catch(urlException $e){
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

	// Use this function to test plugin from the command line
	function cli(){
		$scanController = new ScanController("https://expired.badssl.com/");
		$resultsAll = $scanController->scan();
		$resultsAll->parseJSON();
		$dm = new DataManager("https://expired.badssl.com/", "seangallagher135@gmail.com", $resultsAll);
		$dm->write();
	}

?>
