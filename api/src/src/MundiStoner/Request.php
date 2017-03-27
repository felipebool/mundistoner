<?php

namespace MundiStoner;

/**
 * This class does the hard work on sending HTTP requests to the Mundipagg api.
 *
 * @package MundiStoner
 * @author  Felipe Lopes <bolzin@gmail.com>
 */
class Request
{
    /**
     * @var curl handle $curlHandler It holds the return from curl_init
     */
    private $curlHandler;

    /**
     * @var array $curlOptions It holds the options used to set curl
     */
    private $curlOptions;


    /** 
     * Class constructor, it starts init and define $curlOptions as an array
     */
    public function __construct()
    {
        $this->curlHandler = curl_init();
        $this->curlOptions = array();
    }    


    /**
     * It sets a basic set of curl options
     */
    private function setBasicOptions()
    {
        $this->curlOptions[CURLOPT_RETURNTRANSFER] = true;
        $this->curlOptions[CURLOPT_MAXREDIRS] = 10;
        $this->curlOptions[CURLOPT_TIMEOUT] = 30;
        $this->curlOptions[CURLOPT_SSL_VERIFYPEER] = true;
    }


    /**
     * It sets CURLOP_FOLLOWLOCATION
    */
    public function setFollowLocation()
    {
        $this->curlOptions[CURLOPT_FOLLOWLOCATION] = true;
    }


    /**
     * It sets CURLOPT_URL
     *
     * @param string Url endpoint
     */
    public function setUrl($url)
    {
        $this->curlOptions[CURLOPT_URL] = $url;
    }


    /**
     * It sets CURLOPT_CUSTOMREQUEST
     *
     * @param string Request method (GET or POST)
     */
    public function setMethod($method)
    {
        $this->curlOptions[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
    }


    /**
     * It sets CURLOPT_HTTPHEADER
     *
     * @param array The headers that must be sent by the request
     */
    public function setHttpHeaders($headers)
    {
        $this->curlOptions[CURLOPT_HTTPHEADER] = $headers;
    }


    /**
     * It sets CURLOPT_CUSTOMREQUEST
     *
     * @param array The post fields (content) that must be sent by the request
     * @throws Exception If the request method is GET
     */
    public function setPostFields($postFields)
    {
        if (
            !isset($this->curlOptions[CURLOPT_CUSTOMREQUEST]) ||
            $this->curlOptions[CURLOPT_CUSTOMREQUEST] !== 'POST'
        ) {
            throw new \Exception(
                'Cannot set CURLOPT_POSTFIELDS on a non-post request'
            );
        }

        $this->curlOptions[CURLOPT_POSTFIELDS] = json_encode($postFields);
    }


    /**
     * Send request to the Mundipagg api
     *
     * @return array Formatted with status code or the error from Mundipagg api
     */

    public function send()
    {
        $this->setBasicOptions();

        $optarray = curl_setopt_array($this->curlHandler, $this->curlOptions);

        $response = curl_exec($this->curlHandler);
        $responseCode = curl_getinfo($this->curlHandler, CURLINFO_HTTP_CODE);
        $responseError = curl_error($this->curlHandler);

        curl_close($this->curlHandler);

        if ($responseError) {
            return $responseError;
        }

        return array(
            'response' => json_decode($response, true),
            'statusCode' => $responseCode
        );
    }
}

