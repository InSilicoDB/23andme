<?php

namespace TwentyThreeAndMe;

use GuzzleHttp\Client;
use TwentyThreeAndMe\Authorization\ResponseInterpreter;
use TwentyThreeAndMe\Authorization\Token;
use TwentyThreeAndMe\Responses\Genome;
use TwentyThreeAndMe\Responses\User;

/**
 * Exposes the 23AndMe API
 */
class APIClient
{
    private $clientId;
    private $clientSecret;
    private $HTTPClient;
    private $endpoints;

    public function __construct($clientId, $clientSecret, Client $httpClient)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->HTTPClient = $httpClient;
        $this->endpoints = new Endpoints();
    }

    private function options(Token $token, array $options = [])
    {
        return array_merge(
            [
                'http_errors' => false,
                'headers' => [
                    'Authorization: ' . $token->getTokenType() . ' ' . $token->getAccessToken()
                ]
            ],
            $options
        );
    }

    /**
     * @param $profileId
     * @return Genome
     */
    public function genomes(Token $token, $profileId)
    {
        $rawResponse = $this->HTTPClient->get(
            $this->endpoints->genomes($profileId), $this->options($token)
        );
        $interpretedResponse = new ResponseInterpreter($rawResponse);

        return new Genome($interpretedResponse->asArray());
    }

    /**
     * @return User
     */
    public function user(Token $token)
    {
        $rawResponse = $this->HTTPClient->get(
            $this->endpoints->user(), $this->options($token)
        );
        $interpretedResponse = new ResponseInterpreter($rawResponse);

        return new User($interpretedResponse->asArray());
    }
}