<?php

namespace MundiStoner;

use MundiStoner\Request;

class Merchant
{
    private $customerKey;

    public function __construct($customerKey)
    {
        $this->customerKey = $customerKey;
    }

    public function getAllMerchants()
    {
        $request = new Request;

        $request->setUrl($this->buildUrl());
        $request->setMethod('GET');

        $response = $request->send();

        return $this->cleanUpResponse($response);
    }

    private function buildUrl()
    {
        return API_BASE_URL . "/{$this->customerKey}" . MERCHANTS_EP;
    }

    private function cleanUpResponse($response)
    {
        $result = $response['response'];
        $statusCode = $response['statusCode'];
        $merchants = array();

        foreach ($result['items'] as $merchant) {
            $merchants[] = array(
                'merchantName' => $merchant['merchantName']
            );
        }
        
        return array(
            'response' => $merchants,
            'statusCode' => $statusCode
        );
    }
}

