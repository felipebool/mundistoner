<?php

namespace MundiStoner;

use MundiStoner\Request;

class User
{
    private $username;
    private $password;
    private $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function login()
    {
        $request = new Request;

        $request->setUrl($this->buildUrl());
        $request->setMethod('POST');
        $request->setHttpHeaders(array("Content-Type: application/json"));
        $request->setPostFields($this->credentials);

        $response = $request->send();

        return $this->cleanUpResponse($response);
    }

    private function buildUrl()
    {
        return API_BASE_URL . ACCESS_TOKENS_EP;
    }

    private function cleanUpResponse($response)
    {
        $result = $response['response'];
        $statusCode = $response['statusCode'];

        if (array_key_exists('errors', $result)) {
            return array(
                'response' => array(
                    'errors' => $result['errors']
                ),
                'statusCode' => $statusCode
            );            
        }

        return array(
            'response' => array(
                'customerKey' => $result['customerKey']
            ),
            'statusCode' => $statusCode
        );
    }
}

