<?php

namespace TwentyThreeAndMe\Authorization;

use GuzzleHttp\Client;

/**
 * Manipulates API endpoints relevant for authentication only
 */
class AuthorizationAPI
{
    private $clientId;
    private $clientSecret;
    private $httpClient;
    private $endpoints;
    private $receiveCodeCallbackURI;

    public function __construct($clientId, $clientSecret, Client $httpClient, $receiveCodeCallbackURI)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->httpClient = $httpClient;
        $this->endpoints = new Endpoints();
        $this->receiveCodeCallbackURI = $receiveCodeCallbackURI;
    }

    public function requestToken($code, array $scopes)
    {
        $rawResponse = $this->httpClient->post(
            $this->endpoints->token(),
            $options = [
                'form_params' => [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'redirect_uri' => $this->receiveCodeCallbackURI,
                    'scope' => urlencode(implode(' ', $scopes))
                ]
            ]
        );
        $interpretedResponse = new ResponseInterpreter($rawResponse);

        return new Token($interpretedResponse->asArray());
    }
}