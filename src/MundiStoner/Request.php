<?php

namespace MundiStoner;

class Request
{
    private $curlHandler;
    private $curlOptions;

    public function __construct()
    {
        $this->curlHandler = curl_init();
        $this->curlOptions = array();
    }    

    private function setBasicOptions()
    {
        $this->curlOptions[CURLOPT_RETURNTRANSFER] = 1;
        $this->curlOptions[CURLOPT_MAXREDIRS] = 10;
        $this->curlOptions[CURLOPT_TIMEOUT] = 30;
    }

    public function setUrl($url)
    {
        $this->curlOptions[CURLOPT_URL] = $url;
    }

    public function setMethod($method)
    {
        $this->curlOptions[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
    }


    public function setHttpHeaders($headers)
    {
        $this->curlOptions[CURLOPT_HTTPHEADER] = $headers;
    }

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

