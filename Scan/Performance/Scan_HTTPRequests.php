<?php

	require_once("Data/Performance/Results_HTTPRequests.php");

	class Scan_HTTPRequests {

		private $dom;
		private $resultsHTTPRequests;

		public function __construct($dom){
			$this->dom = $dom;
			$this->resultsHTTPRequests = new Results_HTTPRequests();
		}

		public function scan(){
			$this->resultsHTTPRequests->requestCount = $this->countRequests();
			//echo $this->resultsHTTPRequests;
			return $this->resultsHTTPRequests;
		}

		public function countRequests(){
			$count = 0;
			// count stylesheets
			$count += $this->countStylesheets();
			// count scripts
			$count += $this->countByAttribute("script", "src");
			// count images
			$count += $this->countByAttribute("img", "src");
			// count embed tags
			$count += $this->countByAttribute("embed", "src");
			// count object tags
			$count += $this->countByAttribute("object", "data");
			//count video tags
			$count += $this->countTags("video");
			return $count;
		}

		// Doesn't seem to handle stylesheets inside script tags
		public function countStylesheets(){
			$count = 0;
			$list = $this->dom->getElementsByTagName("link");
			//echo "List length: $list->length\n";
			foreach($list as $link){
				if($link->hasAttribute("rel") && $link->getAttribute("rel") == "stylesheet"
					&& $link->hasAttribute("href")){
					$count++;
				}
			}
			//echo "Stylesheet Count: $count\n";
			return $count;
		}

		public function countScripts(){
			$count = 0;
			$list = $this->dom->getElementsByTagName("script");
			foreach($list as $script){
				if($script->hasAttribute("src")){
					$count++;
				}
			}
			//echo "Script Count: $count\n";
			return $count;
		}

		public function countImages(){
			$count = 0;
			$list = $this->dom->getElementsByTagName("img");
			foreach($list as $image){
				if($image->hasAttribute("src")){
					$count++;
				}
			}
			//echo "Image Count: $count\n";
			return $count;
		}

		public function countByAttribute($tag, $attr){
			$count = 0;
			$list = $this->dom->getElementsByTagName($tag);
			foreach($list as $item){
				if($item->hasAttribute($attr)){
					$count++;
				}
			}
			//echo "$tag count: $count\n";
			return $count;
		}

		public function countTags($tag){
			$count = 0;
			$list = $this->dom->getElementsByTagName($tag);
			$count = $list->length;
			//echo "$tag count: $count\n";
			return $count;
		}

		public function testPassed(){
			// If http requests less than 30 - pass
			if($this->resultsHTTPRequests->requestCount <= 30){
				return true;
			}
			return false;
		}

	}

?>
