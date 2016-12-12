<?php

	class Results_SSL {

		public $hasCert;
		public $certExpired;

		public $issuer;
		public $isVerified;

		public $rating;

		public function __construct(){
			$this->hasCert = false;
			$this->certExpired = false;
		}

		public function parseJSON(){
			$results = array();
			if($this->hasCert)
				$results["hasCert"] = "Yes";
			else
				$results["hasCert"] = "No";
			if($this->certExpired)
				$results["certExpired"] = "Yes";
			else
				$results["certExpired"] = "No";
			$results["rating"] = $this->rating;
			return $results;
		}

		public function __toString(){
			$output = "";

			$output .= "\n--Scan: Security - SSL--\n";
			if(!$this->hasCert){
				$output .= "No SSL certificate found\n";
			}
			else {

				$output .= "Issuer: $this->issuer\n";
				$output .= "Expired: ";

				if($this->certExpired)
					$output .= "Yes\n";
				else
					$output .= "No\n";

				$output .= "Verified: ";
				if($this->isVerified)
					$output .= "Yes\n";
				else
					$output .= "No\n";
			}

			return $output;
		}

	}

?>
