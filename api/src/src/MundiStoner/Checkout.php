<?php

namespace MundiStoner;

use MundiStoner\Request;

/**
 * This class deals with transactions between client and Mundipagg api.
 *
 * @package MundiStoner
 * @author  Felipe Lopes <bolzin@gmail.com>
 */
class Checkout
{
    /**
     * @var array $transaction It holds the transaction details
     */
    private $transaction;

    /**
     * @var string $merchantKey It holds the user's merchantKey
     */
    private $merchantKey;


    /**
     * Class constructor, it sets the transaction details
     *
     * @param array Transaction details
     */
    public function __construct($transaction)
    {
        /**
         * A merchantKey esta hardcoded pq tentei usar a chave
         * da documentação e a da resposta do getAllMerchants
         * mas nenhuma das duas funcionou. Encontrei esta em
         * um dos exemplos da sdk do github.
         */
        $this->merchantKey = '85328786-8BA6-420F-9948-5352F5A183EB';

        $this->transaction = array(
            'CreditCardTransactionCollection' => array(
                array(
                    'AmountInCents' => $transaction['AmountInCents'],
                    'CreditCard' => array(
                        'CreditCardBrand' => $transaction['CreditCardBrand'],
                        'CreditCardNumber' => $transaction['CreditCardNumber'],
                        'ExpMonth' => $transaction['ExpMonth'],
                        'ExpYear' => $transaction['ExpYear'],
                        'HolderName' => $transaction['HolderName'],
                        'SecurityCode' => $transaction['SecurityCode']
                    ),
                    'CreditCardOperation' => 'AuthAndCapture',
                    'Options' => array(
                        'PaymentMethodCode' => 1
                    )
                )
            )
        );
    }


    /**
     * Create a checkout request and send it to Mundipagg api
     *
     * @return Response from Mundipagg api
     */
    public function proceed()
    {
        $request = new Request;

        $request->setUrl(API_BASE_URL_TRANSACTION);
        $request->setMethod('POST');
        $request->setHttpHeaders(array(
            "Content-Type: application/json",
            "MerchantKey: " . $this->merchantKey,
            "Accept: application/json"
        ));
        $request->setFollowLocation();
        $request->setPostFields($this->transaction);
        $response = $request->send();

        return $response;
    }
}

