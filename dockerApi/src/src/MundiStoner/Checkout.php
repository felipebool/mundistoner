<?php

namespace MundiStoner;

use MundiStoner\Request;

class Checkout
{
    private $transaction;
    private $merchantKey;

    public function __construct($transaction)
    {
        $this->merchantKey = '87328324-8DA6-459E-9948-5431F5A183FA';
        $this->transaction = array(
            'CreditCardTransactionCollection' => array(
                array(
                    'AmountInCents' => 10000,
                    'CreditCard' => array(
                        'CreditCardBrand' => 'visa',
                        'CreditCardNumber' => '4111111111111111',
                        'ExpMonth' => 10,
                        'ExpYear' => 2022,
                        'HolderName' => 'LUKE SKYWALKER',
                        'SecurityCode' => '123'
                    ),
                    'CreditCardOperation' => 'AuthAndCapture',
                    'Options' => array(
                        'PaymentMethodCode' => 1
                    )
                )
            )
        );
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
        $request->setPostFields(json_encode($this->transaction));
        $response = $request->send();

        return $response;
        //return $this->transaction;
    }
}

