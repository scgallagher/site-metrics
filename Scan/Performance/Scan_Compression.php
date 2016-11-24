<?php

	require_once("Data/Performance/Results_Compression.php");

	class Scan_Compression {

		private $dom;
		private $url;
		private $resultsCompression;

		public function __construct($dom, $url){
			$this->dom = $dom;
			$this->url = $url;
			$this->resultsCompression = new Results_Compression();
		}

		public function scan(){
			//Read in webpage
			$originalSiteContents = file_get_contents($this->url); //$testString = "I♥NY";
			
			//Check for simple compression
			$originalSizeInBytes = strlen($originalSiteContents);
			$compressedSizeInBytes = strlen(preg_replace('/\s+/', '', $originalSiteContents));
			if ($originalSizeInBytes != 0)
				$this->resultsCompression->compressionPercentage = (($originalSizeInBytes - $compressedSizeInBytes) / $originalSizeInBytes) * 100;
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
			
			//Return result
			//echo "<br>Compression: " . $this->resultsCompression->compressionResult . " " . $this->resultsCompression->compressionPercentage . "<br>";
			return $this->resultsCompression;
		}

	}

?>