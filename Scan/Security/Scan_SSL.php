<?php

	require_once("Data/Security/Results_SSL.php");

	class Certificate {
		public $expiration;
		public $issuer;
		public $isVerified;

		public function __toString(){
			$output = "";
			$output .= "Expiration: $this->expiration\n";
			$output .= "Issuer: $this->issuer\n";
			$output .= "Valid: ";
			if($this->isVerified)
				$output .= "Yes\n";
			else
				$output .= "No\n";
			return $output;
		}
	}

	class Scan_SSL {

		private $dom;
		private $httpHeader;
		private $resultsSSL;
		private $certificate;

		public function __construct($dom, $httpHeader){
			$this->dom = $dom;
			$this->httpHeader = $httpHeader;
			$this->resultsSSL = new Results_SSL();
			$this->certificate = new Certificate();
		}

		public function scan(){
			//echo $this->httpHeader;
			$this->resultsSSL->hasCert = $this->getCertInfo();
			if($this->resultsSSL->hasCert){
				echo $this->certificate;
			}
			return $this->resultsSSL;
		}

		private function getCertInfo(){
			$certTitle = "Server certificate:";
			$index = strpos($this->httpHeader, $certTitle);
			if($index){
				$index += strlen($certTitle);
				$this->certificate->expiration = $this->getExpiration($index);
				$this->certificate->issuer = $this->getIssuer($index);
				$this->certificate->isVerified = $this->isVerified($index);
				return true;
			}
			else {
				return false;
			}
		}

		private function getExpiration($offset){
			$searchQuery = "expire date: ";
			$index = strpos($this->httpHeader, $searchQuery, $offset) + strlen($searchQuery);
			$end = strpos($this->httpHeader, "\n", $index);
			$expiration = substr($this->httpHeader, $index, ($end - $index));
			//echo "Expiration: $expiration\n";
			return $expiration;
		}

		private function getIssuer($offset){
			$searchQuery = "issuer: ";
			$index = strpos($this->httpHeader, $searchQuery, $offset) + strlen($searchQuery);
			$end = strpos($this->httpHeader, "\n", $index);
			$issuer = substr($this->httpHeader, $index, ($end - $index));
			//echo "Issuer: $issuer\n";
			return $issuer;
		}

		private function isVerified($offset){
			$searchQuery = "SSL certificate verify ok.";
			$index = strpos($this->httpHeader, $searchQuery, $offset);
			if($index)
				return true;
			return false;
		}

		private function testPassed(){
			// Algorithm
			// If site has SSL cert and its not expired - pass
			// Else if site has SSL cert and it is expired - fail
			// Else if site doesn't have SSL cert - pass/not applicable
		}

	}

?>
