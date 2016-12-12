<?php

	require_once("Data/Security/Results_SSL.php");

	class Certificate {
		public $expiration;
		public $issuer;
		public $isVerified;

		public function __toString(){
			$output = "";
			$output .= "Expiration: " . $this->expiration->format('M j h:i:s Y e'). "\n";
			$output .= "Issuer: $this->issuer\n";
			$output .= "Verified: ";
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
			$this->resultsSSL->hasCert = $this->getCertInfo();
			if($this->resultsSSL->hasCert){
				$this->resultsSSL->certExpired = $this->isExpired($this->certificate->expiration);
				$this->resultsSSL->issuer = $this->certificate->issuer;
				$this->resultsSSL->isVerified = $this->certificate->isVerified;
			}
			$this->resultsSSL->rating = $this->getRating();
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
			$expirationString = substr($this->httpHeader, $index, ($end - $index));
			$expiration = DateTime::createFromFormat('M d H:i:s Y e', 	$expirationString);

			return $expiration;
		}

		private function getIssuer($offset){
			$searchQuery = "issuer: ";
			$index = strpos($this->httpHeader, $searchQuery, $offset) + strlen($searchQuery);
			$end = strpos($this->httpHeader, "\n", $index);
			$issuer = substr($this->httpHeader, $index, ($end - $index));
			return $issuer;
		}

		private function isVerified($offset){
			$searchQuery = "SSL certificate verify ok.";
			$index = strpos($this->httpHeader, $searchQuery, $offset);
			if($index)
				return true;
			return false;
		}

		private function isExpired($expiration){

			$now = new DateTime();
			if($expiration < $now){
				return true;
			}
			return false;
		}

		private function getRating(){

			if($this->resultsSSL->hasCert && !$this->resultsSSL->certExpired){
				return "good";
			}
			else {
				return "bad";
			}
		}

	}

?>
