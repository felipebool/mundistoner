<?php

use Slim\App;
use MundiStoner\User;
use MundiStoner\Checkout;
use MundiStoner\Merchant;

require_once '../vendor/autoload.php';
require_once '../config/api.php';

$app = new App();

/*
 * Endpoint: /v1/{customerKey}/merchant
 * Method: get
 * Input: customerKey
 * Output: list with all merchants (json)
*/
$app->get('/v1/{customerKey}/merchant', function ($request, $response, $args) {
    $merchant = new Merchant($args['customerKey']);
    $merchants = $merchant->getAllMerchants();

    return $response
        ->withStatus($merchants['statusCode'])
        ->withJson($merchants['response']);
});


/*
 * Endpoint: /v1/login
 * Method: post
 * Input: username and password (json)
 * Output: error messages or customerKey (json)
*/
$app->post('/v1/login', function ($request, $response, $args) {
    $credentials = $request->getParsedBody();

    // return as soon as possible to avoid unnecessary requests
    if (!isset($credentials['username']) || !isset($credentials['password'])) {
        return $response->withStatus(400)->withJson(array(
            'errors' => array('message' => 'Username and password must be set')
        ));
    }

    $user = new User($credentials);
    $result = $user->login();

    return $response
        ->withStatus($result['statusCode'])
        ->withJson($result['response']);
});


$app->post('/v1/checkout', function ($request, $response, $args) {
    $checkout = new Checkout($request->getParsedBody());
    return $response->withStatus(200)->withJson($checkout->proceed());
});

$app->run();

