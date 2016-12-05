<?php

	require_once("Data/Performance/Results_BrowserCaching.php");

	class Scan_BrowserCaching {

		private $dom;
		private $url;
		private $resultsBrowserCaching;

		public function __construct($dom, $url){
			$this->dom = $dom;
			$this->url = $url;
			$this->resultsBrowserCaching = new Results_BrowserCaching();
		}

		public function scan(){
			$url = $this->url;
			$cookies = $this->getLandingCookies($url);
			$cookiesStr = implode(" ", $cookies);

			$this->resultsBrowserCaching->cookiesSizeInBytes = strlen($cookiesStr);
			$this->resultsBrowserCaching->cookiesCount = count($cookies);

			$grade = 0; //out of 3 possible points
			if($this->resultsBrowserCaching->cookiesCount >= 50)
				$grade += 0;
			elseif($this->resultsBrowserCaching->cookiesCount >= 40)
				$grade += 1;
			elseif($this->resultsBrowserCaching->cookiesCount < 40)
				$grade += 2;

			if($this->resultsBrowserCaching->cookiesSizeInBytes < 4000)
				$grade += 1;
			elseif($this->resultsBrowserCaching->cookiesSizeInBytes >= 4000)
				$grade = 0; //this is the standard max cookie size and is seen as an automatic failure

			if($grade == 3)
				$this->resultsBrowserCaching->browserCachingResult = "Good";
			elseif($grade == 2)
				$this->resultsBrowserCaching->browserCachingResult = "Ok";
			else
				$this->resultsBrowserCaching->browserCachingResult = "Bad";

			$this->resultsBrowserCaching->testPassed = $this->testPassed();
			return $this->resultsBrowserCaching;
		}

		public function testPassed(){
			if (strtolower($this->resultsBrowserCaching->browserCachingResult) == "good")
			{
				return true;
			}

			return false;
		}



		private function getLandingCookies($url){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_HEADER, 1);
			$result = curl_exec($curl);
			preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
			$cookies = array();
			foreach($matches[1] as $item) {
				parse_str($item, $cookie);
				$cookies = array_merge($cookies, $cookie);
			}
			return $cookies;
		}
	}

?>
