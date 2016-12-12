<?php

require_once("Data/SEO/Results_PageTitle.php");

class Scan_PageTitle {

	private $dom;
	private $resultsPageTitle;
	private $title;

	public function __construct($dom){
		$this->dom = $dom;
		$this->resultsPageTitle = new Results_PageTitle();
	}

	public function scan(){
		if($this->resultsPageTitle->hasTitle = $this->getTitle()){
			$this->resultsPageTitle->charCount = $this->getCharCount();
		}
		$this->resultsPageTitle->rating = $this->getRating();
		return $this->resultsPageTitle;
	}

	private function getTitle(){
		$titleList = $this->dom->getElementsByTagName("title");
		if(!$titleList){
			return false;
		}
		else {
			$this->title = $titleList->item(0)->nodeValue;
			return true;
		}
	}

	private function getCharCount(){
		return strlen($this->title);
	}

	private function getRating(){
		$results = $this->resultsPageTitle;
		if($results->charCount > 0 && $results->charCount < 60){
			return "good";
		}
		else if($results->charCount > 60 && $results->charCount <= 80){
			return "okay";
		}
		else{
			return "bad";
		}
	}

}

?>
