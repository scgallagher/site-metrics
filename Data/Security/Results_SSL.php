<?php

	class Results_SSL {

		public $hasCert;
		public $certExpired;

		public $issuer;
		public $isVerified;

		public $testPassed;
		public $rating;

		public function parseJSON(){
			$results = array();
			$results["testPassed"] = $this->testPassed;
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

			$output .= "Result: ";
			if($this->testPassed)
				$output .= "Pass\n";
			else
				$output .= "Fail\n";

			return $output;
		}

	}

?>
