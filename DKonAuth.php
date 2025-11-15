<?php

class DKonAuth {
    private $clientId;
    private $apiUrl;

    public function __construct($clientId) {
        $this->clientId = $clientId;
        $this->apiUrl = 'https://api.dkon.app/api/v3/method/account.signIn';
    }

    public function login($username, $password) {
        $postData = [
            'clientId' => $this->clientId,
            'username' => $username,
            'password' => $password
        ];

        $response = $this->makeRequest($postData);

        if (isset($response['error']) && $response['error_code'] !== 0) {
            return [
                'success' => false,
                'message' => 'Login failed. ' . ($response['message'] ?? 'Please check your credentials.')
            ];
        }

        // Save the access token and account ID if login is successful
        return [
            'success' => true,
            'accessToken' => $response['accessToken'],
            'accountId' => $response['accountId']
        ];
    }

    private function makeRequest($postData) {
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
