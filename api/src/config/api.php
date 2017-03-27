<?php

/**
 * Base url, uncomment for mock or production servers
*/
define(
    'API_BASE_URL',
    /* mock server */
    'https://private-anon-157bd2cafe-mundipaggportal.apiary-mock.com'

    /* production server */
    //'http://4b680d5ffaad4009ac8da8f76d44bd05.cloudapp.net'
);


/**
 * Url for transaction
*/
define('API_BASE_URL_TRANSACTION', 'https://sandbox.mundipaggone.com/Sale');
define(
    'CAINFO',
    dirname(__FILE__) .
        '../vendor/mundipagg/mundipagg-one-php/data/ca-certificates.crt'
);

/**
 * API endpoints
*/
define('ACCESS_TOKENS_EP', '/users/accesstokens');
define('MERCHANTS_EP', '/merchants');

