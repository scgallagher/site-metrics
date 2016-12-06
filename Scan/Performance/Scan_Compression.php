<?php

	require_once("Data/Performance/Results_Compression.php");

	class Scan_Compression {

		private $dom;
		private $url;
		private $originalRawHTML;
		private $resultsCompression;

		public function __construct($dom, $url, $originalRawHTML){
			$this->dom = $dom;
			$this->url = $url;
			$this->originalRawHTML = $originalRawHTML;
			$this->resultsCompression = new Results_Compression();
		}

		public function scan(){
			//Read in webpage
			//$originalSiteContents = file_get_contents($this->url); //$testString = "I♥NY";
			$originalSiteContents = $this->originalRawHTML;

			//Check for simple compression
			$originalSizeInBytes = strlen($originalSiteContents);
			$compressedSizeInBytes = strlen(preg_replace('/\s+/', '', $originalSiteContents));
			if ($originalSizeInBytes != 0){
				$percentage = (($originalSizeInBytes - $compressedSizeInBytes) / $originalSizeInBytes) * 100;
				$this->resultsCompression->compressionPercentage = round($percentage);
			}

			else
				$this->resultsCompression->compressionPercentage = -1;

			//Set result
			if ($this->resultsCompression->compressionPercentage < 0)
				$this->resultsCompression->compressionResult = "ERROR";
			elseif ($this->resultsCompression->compressionPercentage < 10)
				$this->resultsCompression->compressionResult = "Good";
			elseif ($this->resultsCompression->compressionPercentage < 25)
				$this->resultsCompression->compressionResult = "Ok";
			else
				$this->resultsCompression->compressionResult = "Bad";

				$this->resultsCompression->testPassed = $this->testPassed();
			//Return result
			//echo "<br>Compression: " . $this->resultsCompression->compressionResult . " " . $this->resultsCompression->compressionPercentage . "<br>";
			return $this->resultsCompression;
		}

		public function testPassed()
		{
			if (strtolower($this->resultsCompression->compressionResult) == "good")
			{
				return true;
			}

			return false;
		}

	}

?>
