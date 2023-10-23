<?php

namespace App;
use Google_Client;

class GoogleClientConnection {
    private $google_client;
    public function __construct() {
        $this->google_client = new Google_Client();
        $this->google_client->setClientId('507659364380-r46dgt4n19dm6felj0bindbsdmgbsvrh.apps.googleusercontent.com');
        $this->google_client->setClientSecret('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');

        $this->google_client->addScope('email');
        $this->google_client->addScope('profile');
        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false, ), ));
        $this->google_client->setHttpClient($guzzleClient);
        $this->google_client->setAccessType('offline');
        $this->google_client->setPrompt('consent');
        $this->google_client->setApprovalPrompt("consent");
        $this->google_client->setIncludeGrantedScopes(true);
    }

    public function getConnection() {
        return $this->google_client;
    }
}

?>