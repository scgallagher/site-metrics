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
			//echo $this->httpHeader;
			$this->resultsSSL->hasCert = $this->getCertInfo();
			if($this->resultsSSL->hasCert){
				$this->resultsSSL->certExpired = $this->isExpired($this->certificate->expiration);
				$this->resultsSSL->issuer = $this->certificate->issuer;
				$this->resultsSSL->isVerified = $this->certificate->isVerified;
			}
			$this->resultsSSL->testPassed = $this->testPassed();
			echo $this->resultsSSL;
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
			// Test the fuck out of this, I don't trust it
			$expiration = DateTime::createFromFormat('M  j h:i:s Y e', 	$expirationString);
			//echo $expiration->format('M j h:i:s Y e') . "\n";
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

		// This verifies certs for nhl.com and github on my Arch Linux machine
		// but not my Windows PC.  Potential cause is due to known certs on host
		// so this probably shouldn't be used as a metric since managing client
		// certs is definitely out of scope.
		private function isVerified($offset){
			$searchQuery = "SSL certificate verify ok.";
			$index = strpos($this->httpHeader, $searchQuery, $offset);
			if($index)
				return true;
			return false;
		}

		private function isExpired($expiration){

			$now = new DateTime();
			//echo $expiration->format('M j h:i:s Y e') . "\n";

			if($expiration->diff($now) < 1){
				return true;
			}
			return false;
		}

		private function testPassed(){
			if(!$this->resultsSSL->hasCert){
				return "Not Applicable";
			}
			else if($this->resultsSSL->certExpired){
				return false;
			}
			else {
				return true;
			}
		}

	}

?>
