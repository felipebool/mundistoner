<?php

namespace MundiStoner;

use MundiStoner\Request;

class Checkout
{
    private $debug = true;

    public function __construct($transaction)
    {
        if ($this->debug) {
            $this->transaction = array(
                'Buyer' => array(
                    'Name' => 'Felipe Mariani Lopes',
                    'Email' => 'bolzin@gmail.com'                
                ),
                'CreditCardTransaction' => array(
                    'CreditCardNumber' => '4111111111111111',
                    'HolderName' => 'LUKE SKYWALKER',
                    'ExpMonth' => '10',
                    'ExpYear' => '2022',
                    'CreditCardBrandEnum' => 'visa',
                    'SecurityCode' => '123',
                    'AmountInCents' => '10000'
                )
            );
        }
    }

    // there must be a better name
    public function proceed()
    {
        $request = new Request;

        $request->setUrl(API_BASE_URL_TRANSACTION);
        $request->setMethod('POST');
        $request->setHttpHeaders(array(
            "Content-Type: application/json",
            "MerchantKey: {$this->merchantKey}",
            "Accept: application/json"
        ));
        $request->setPostFields($this->transaction);
        $response = $request->send();

        return $response;
    }
}

