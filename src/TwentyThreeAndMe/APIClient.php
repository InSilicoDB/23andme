<?php

namespace TwentyThreeAndMe;

use GuzzleHttp\Client;
use TwentyThreeAndMe\Authorization\ResponseInterpreter;
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

    /**
     * @param $profileId
     * @return Genome
     */
    public function genomes($profileId)
    {
        $rawResponse = $this->HTTPClient->get($this->endpoints->genomes($profileId));
        $interpretedResponse = new ResponseInterpreter($rawResponse);

        return new Genome($interpretedResponse->asArray());
    }

    /**
     * @return User
     */
    public function user()
    {
        $rawResponse = $this->HTTPClient->get($this->endpoints->user());
        $interpretedResponse = new ResponseInterpreter($rawResponse);

        return new User($interpretedResponse->asArray());
    }
}