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
		return $this->resultsPageTitle;
	}

	private function getTitle(){
		$titleList = $this->dom->getElementsByTagName("title");
		if(!$titleList){
			return false;
		}
		else {
			$this->title = $titleList[0]->nodeValue;
			return true;
		}
	}

	private function getCharCount(){
		return strlen($this->title);
	}

	private function testPassed(){
		$results = $this->resultsPageTitle;
		if($results->hasTitle && $results->charCount < 60)
			return true;
		return false;
	}

}

?>