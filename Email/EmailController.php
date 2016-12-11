<?php

	require_once("Email/emailConfig.php");
	include_once("firephp-core-0.4.0/lib/FirePHPCore/fb.php");
	
	class EmailController {
		
		public function addContact($contact) {
			
			$interactor = new ActiveCampaignInteractor(activeCampaign_api_url, activeCampaign_api_key);
			
			$result = $interactor->addContact($contact);
			return $result;
		}
	}

	class Contact {
	
		public $email;
		public $firstName;
		public $lastName;
		public $phone;
		public $organizationName;
	
		public function __construct($emailAddress, $first =  NULL, $last = NULL, $phoneNum = NULL, $org = NULL) {
			$this->email = $emailAddress;
			$this->firstName = $first;
			$this->lastName = $last;
			$this->phone = $phoneNum;
			$this->organizationName = $org;
		}
	}
	
?>