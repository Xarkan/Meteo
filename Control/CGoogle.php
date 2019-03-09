<?php

/**
 * 
 */
class CGoogle 
{
	private $CLIENT_ID = '19968658386-rcg2oo5r02quh7kfq711hi64pqpj1gjs.apps.googleusercontent.com';
    private $CLIENT_SECRET = 'LYuF6qXd_g5XT4xTOPp3-JG8';
    private $REDIRECT_URI = 'http://localhost/Meteo/google';
    private $client;

    function __construct() {
    	require_once 'Utility/vendor/autoload.php';
    	$client = new Google_Client();
        $client->setClientId($this->CLIENT_ID);
        $client->setClientSecret($this->CLIENT_SECRET);
        $client->setRedirectUri($this->REDIRECT_URI);
        $client->setScopes('email','profile');
        $this->client = $client;
    }

    public function getUser() {
    	$service = new Google_Service_Oauth2($this->client);
    	//$people_service = new Google_Service_PeopleService($this->client);
    	$profile = $service->userinfo->get();
    	//$profile = $service->people->get('people/me', array('personFields' => 'names,emailAddresses'));
    	
    	print_r($profile);

    }


    public function getAuthLink() {
    	return $this->client->createAuthUrl();
    }

    public function get_google() {
    	require_once 'Utility/vendor/autoload.php';
    	$session = USingleton::getInstance('USession');
    	$client = new Google_Client();
        $client->setClientId($this->CLIENT_ID);
        $client->setClientSecret($this->CLIENT_SECRET);
        $client->setRedirectUri($this->REDIRECT_URI);
        $client->addScope('email');
        $client->addScope(' https://www.googleapis.com/auth/userinfo.profile');

        $plus = new Google_Service_Plus($client);
        //vedere questa opzione per quando toglieranno Plus
        //https://www.googleapis.com/oauth2/v1/userinfo?alt=json

        if (isset($_GET['code'])) {
          	$client->authenticate($_GET['code']);
          	$session->set_value('access_token', $client->getAccessToken());
            $session->set_value('logged', TRUE);

          	
	    	$me = $plus->people->get('me');

			// Get User data
			$id = $me['id'];
			$name =  $me['displayName'];
			$email =  $me['emails'][0]['value'];
			$profile_url = $me['url'];


    		$user = new EUser($email);
    		$user->setName($name);

    		$dbm = USingleton::getInstance('FDBmanager');
    		if (!$dbm->exist($user)) {
    			$stored = $dbm->store($user);
    		}

    		$session->set_value('user',$user);

          	$redirect = 'http://localhost/Meteo/home';
          	header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
        }
        
    }

}