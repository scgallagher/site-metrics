<?php

	class Results_HTTPRequests {

		public $requestCount;

		public function __toString(){
			$output = "";
			$output .= "HTTP Requests: $this->requestCount\n";
			return $output;
		}

	}

?>
