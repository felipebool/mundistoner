<?php

namespace MundiStoner;

use MundiStoner\Request;


/**
 * This class is responsible for requests to Mundipagg api
 * related to merchants
 *
 * @package    MundiStoner
 * @author     Felipe Lopes <bolzin@gmail.com>
 */
class Merchant
{
    /** 
     * @var string $customerKey It holds the user's customerKey
     */
    private $customerKey;


    /** 
     * Class constructor, it sets the user's customer key
     *
     * @param string User's customer key
     */
    public function __construct($customerKey)
    {
        $this->customerKey = $customerKey;
    }


    /**
     * Create a merchants request and send it to Mundipagg api
     *
     * @return Array of merchants from Mundipagg api
     */
    public function getAllMerchants()
    {
        $request = new Request;

        $request->setUrl($this->buildUrl());
        $request->setMethod('GET');

        $response = $request->send();

        return $this->cleanUpResponse($response);
    }


    /**
     * Helper function, build the url to Mundipagg merchant endpoint
     *
     * @return string Mundipagg merchants endpoint 
     */
    private function buildUrl()
    {
        return API_BASE_URL . "/{$this->customerKey}" . MERCHANTS_EP;
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

        return array(
            'response' => $response['response'],
            'statusCode' => $statusCode
        );
    }
}

