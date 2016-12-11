<?php

	require_once("ActiveCampaign-activecampaign-api-php-38f340f/includes/ActiveCampaign.class.php");

	class ActiveCampaignInteractor {
		
		private $ac;
		private $url;
		private $key;
		
		public function __construct($api_url, $api_key) {
			$this->ac = new ActiveCampaign($api_url, $api_key);
			$this->url = $api_url;
			$this->key = $api_key;
		}
		
		public function addContact($contact) {
			$params = array(
				'api_key' => $this->key,
				'api_action' => 'contact_add',
				'api_output' => 'json'
			);
			
			$post = array(
				'email' => $contact->email,
				'first_name' => $contact->firstName,
				'last_name' => $contact->lastName,
				'phone' => $contact->phone,
				'orgname' => $contact->organizationName,
				'tags' => 'api'
			);
			foreach(activeCampaign_listIds as $listId) {
				$post["p[" . $listId . "]"] = $listId;
			}
			
			//format input fields
			$query = "";
			foreach($params as $key => $value) {
				$query .= $key . '=' . urlencode($value) . '&';
			}
			$query = rtrim($query, '& ');
			
			//format input data
			$data = "";
			foreach($post as $key => $value) {
				$data .= $key . '=' . urlencode($value) . '&';
			}
			$data = rtrim($data, '& ');
			
			if(!function_exists('curl_init')) {
				die('CURL not supported.');
			}
			if($params['api_output'] == 'json' && !function_exists('json_decode')) {
				die('JSON not supported.');
			}
			
			$parameterizedUrl = $this->url . '/admin/api.php?' . $query;
			
			$request = curl_init($api);
			curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // returns response data instead of TRUE(1)
			curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
			curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
			curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
			
			$response = (string)curl_exec($request);
			
			curl_close($request);
			
			if(!$response) {
				die('No response.');
			}
			
			$result = json_decode($response);
			return $result;
		}
	}

?>