<?php

	require_once("Data/Performance/Results_PageRedirects.php");

	class Scan_PageRedirects {

		private $dom;
		private $url;
		private $resultsPageRedirects;

		public function __construct($dom, $url){
			$this->dom = $dom;
			$this->url = $url;
			$this->resultsPageRedirects = new Results_PageRedirects();
		}

		public function scan(){
			//Check redirects
			$startUrl = $this->url;
			$endUrl = $this->GetRedirectedUrl($startUrl);
			$redirectCount = 0;
			while ($startUrl != $endUrl) {
				$redirectCount = $redirectCount + 1;
				$startUrl = $endUrl;
				$endUrl = $this->GetRedirectedUrl($startUrl);
			}

			//Set results
			$this->resultsPageRedirects->redirectCount = $redirectCount;
			if ($redirectCount == 0)
				$this->resultsPageRedirects->redirectsResult = "Good";
			elseif ($redirectCount == 1)
				$this->resultsPageRedirects->redirectsResult = "Okay";
			elseif ($redirectCount > 1)
				$this->resultsPageRedirects->redirectsResult = "Bad";
			else
				$this->resultsPageRedirects->redirectsResult = "ERROR";

				$this->resultsPageRedirects->testPassed = $this->testPassed();
				$this->resultsPageRedirects->rating = $this->resultsPageRedirects->redirectsResult;
			//Return results
			return $this->resultsPageRedirects;
		}

		public function GetRedirectedUrl($startUrl) {
			$endUrl = $startUrl;

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($ch, CURLOPT_URL, $startUrl);
			$out = curl_exec($ch);
			$out = str_replace("\r", "", $out); // Remove line endings

			// In the header, check for new location
			$headers_end = strpos($out, "\n\n");
			if( $headers_end !== false ) {
				$out = substr($out, 0, $headers_end);
			}
			$headers = explode("\n", $out);
			foreach($headers as $header) {
				if( substr($header, 0, 10) == "Location: " ) {
					$endUrl = substr($header, 10); //Redirect url found - return new url
					break;
				}
			}

			return $endUrl;
		}

		public function testPassed()
		{
			if (strtolower($this->resultsPageRedirects->redirectsResult) == "good")
			{
				return true;
			}

			return false;
		}
	}

?>
