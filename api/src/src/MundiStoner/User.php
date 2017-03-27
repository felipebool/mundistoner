<?php

namespace MundiStoner;

use MundiStoner\Request;


/**
 * This class is responsible for requests to Mundipagg api
 * related to user
 *
 * @package MundiStoner
 * @author  Felipe Lopes <bolzin@gmail.com>
 */
class User
{
    /**
     * @var array $credentials Contain the user's credentials 
    */
    private $credentials;


    /**
     * Class constructor
     *
     * @param array It holds user's credentials
    */
    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }


    /**
     * Responsible for request customer key
     *
     * @return array Formatted response array
    */
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


    /**
     * Helper function, build the url to Mundipagg users endpoint
     *
     * @return string Mundipagg users endpoint
    */
    private function buildUrl()
    {
        return API_BASE_URL . ACCESS_TOKENS_EP;
    }


    /** 
     * Helper function, it is used to get the necessary fields from response
     *
     * @param array The response from Mundipagg api
     * @return array Cleaned array
     */
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

