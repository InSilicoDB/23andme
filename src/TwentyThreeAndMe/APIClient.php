<?php

namespace TwentyThreeAndMe;

use GuzzleHttp\Client;
use TwentyThreeAndMe\Authorization\ResponseInterpreter;
use TwentyThreeAndMe\Responses\Genome;

/**
 * Exposes the 23AndMe API
 */
class APIClient
{
    private $clientId;
    private $clientSecret;
    private $HTTPClient;
    private $APILocation = 'https://api.23andme.com/1/';

    public function __construct($clientId, $clientSecret, Client $httpClient)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->HTTPClient = $httpClient;
    }

    public function genomes($profileId)
    {
        $rawResponse = $this->HTTPClient->get(
            $uri = $this->APILocation.'genomes/'.$profileId.'/',
            [
                'http_errors' => false
            ]
        );
        $interpretedResponse = new ResponseInterpreter($rawResponse);

        return new Genome($interpretedResponse->asArray());
    }
}