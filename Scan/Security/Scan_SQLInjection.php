<?php

	require_once("Data/Security/Results_SQLInjection.php");

	class Scan_SQLInjection {

		private $dom;
		private $resultsSQLInjection;

		private $non_prepared_statements = 0;
		private $prepared_statements = 0;

		private $url;

		public function __construct($dom, $url){
			$this->dom = $dom;
			$this->url = $url;
			$this->resultsSQLInjection = new Results_SQLInjection();
		}

		public function scan(){
			chdir("../../../");
			$isLocal = $this->isLocal();
			if(!$isLocal){
				$this->resultsSQLInjection->isLocal = false;
			}
			else {
				$this->resultsSQLInjection->isLocal = true;
				$this->crawl(getcwd(), 0);
				$this->resultsSQLInjection->prepared_statements = $this->prepared_statements;
				$this->resultsSQLInjection->non_prepared_statements = $this->non_prepared_statements;
			}
			$this->resultsSQLInjection->rating = $this->getRating();
			return $this->resultsSQLInjection;
		}

		private function isLocal(){
			if(preg_match('/^(http:\/\/|https:\/\/)*localhost/', $this->url) ||
				preg_match('/^(http:\/\/|https:\/\/)*127\.0\.0\.1/', $this->url)){
				return true;
			}
			return false;
		}

		private function crawl($target, $depth){
			$indent = "";
			for($i = 0; $i < $depth; $i++){
				$indent .= "  ";
			}
			$depth++;
			// if target is a php file - scan it
			if(preg_match('/^[a-zA-Z0-9_\\-\\/\\\\:]+.php$/', $target)){
				// scan the file
				$this->searchPHP($target);
			}
			// if target is a directory - call crawl on each child
			if(is_dir($target)){
				if ($dh = opendir($target)){
    			while (($file = readdir($dh)) !== false){
						if(!$this->whitelisted($file)){
							$this->crawl("$target/$file", $depth);
						} // end if
    			} // end while
    			closedir($dh);
				}
			}
			// at this point, target is a non-php file, just return
		}

		// Note: at the moment, this function does not consider Wordpress core
		// files as whitelisted because the user can edit them. (Exception: wp-db.php)
		private function searchPHP($target){

			if(!($fh = @fopen($target, "r"))){
				// file failed to open - perhaps log this?
				return;
			}
			while(!feof($fh)){
				$line = fgets($fh);
				if(preg_match('/mysql_query\\(/', $line) || preg_match('/mysqli_query\\(/', $line)){
					$this->non_prepared_statements++;
				}
				else if(preg_match('/prepare\\(/', $line)){
					$this->prepared_statements++;
				}
			}
			fclose($fh);
		}

		private function whitelisted($target){
			if($target == "." || $target == ".." || $target == "wp-db.php"){
				return true;
			}
			return false;
		}

		private function getRating(){
			$prepared = $this->resultsSQLInjection->prepared_statements;
			$nonPrepared = $this->resultsSQLInjection->non_prepared_statements;
			if($prepared == 0 && $nonPrepared == 0){
				return "Not Applicable";
			}
			else if($nonPrepared > 0){
				return "bad";
			}
			else {
				return "good";
			}
		}

	}

?>
