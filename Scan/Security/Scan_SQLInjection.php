<?php

	require_once("Data/Security/Results_SQLInjection.php");

	class Scan_SQLInjection {

		private $dom;
		private $resultsSQLInjection;

		private $non_prepared_statements = 0;
		private $prepared_statements = 0;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsSQLInjection = new Results_SQLInjection();
		}

		public function scan(){
			chdir("../../../");
			$this->crawl(getcwd(), 0);
			//echo getcwd() . "\n";
			//$this->searchPHP("wp-content/plugins/site-metrics/Testing/Security/TestData/SQLInjection_Test1.php");
			$this->resultsSQLInjection->prepared_statements = $this->prepared_statements;
			$this->resultsSQLInjection->non_prepared_statements = $this->non_prepared_statements;
			echo $this->resultsSQLInjection;
			return $this->resultsSQLInjection;
		}

		private function crawl($target, $depth){
			//echo "Target: $target\n";
			$indent = "";
			for($i = 0; $i < $depth; $i++){
				$indent .= "  ";
			}
			$depth++;
			// if target is a php file - scan it
			if(preg_match('/^[a-zA-Z0-9_\\-\\/\\\\:]+.php$/', $target)){
				//echo $target . "\n";
				// scan the file
				$this->searchPHP($target);
			}
			// if target is a directory - call crawl on each child
			if(is_dir($target)){
				if ($dh = opendir($target)){
    			while (($file = readdir($dh)) !== false){
      			//echo "$target/$file\n";
						//echo "$indent$file\n";
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
				echo "ERROR: failed to open file $target\n";
				return;
			}
			while(!feof($fh)){
				$line = fgets($fh);
				if(preg_match('/mysql_query\\(/', $line) || preg_match('/mysqli_query\\(/', $line)){
					//|| preg_match('/query\\(/', $line) || preg_match('/exec\\(/', $line)){
						//echo $line . "\n";
						//echo "$target\n";
					$this->non_prepared_statements++;
				}
				else if(preg_match('/prepare\\(/', $line)){
					//echo $line . "\n";
					//echo "$target\n";
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

	}

?>
