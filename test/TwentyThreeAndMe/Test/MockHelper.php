<?php

namespace Test\TwentyThreeAndMe\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use TwentyThreeAndMe\APIClient;
use TwentyThreeAndMe\Authorization\AuthorizationAPI;

trait MockHelper
{
    private $clientId = 1;
    private $clientSecret = 'secret123';

    protected function mockHttpClient(array $responses, $headers)
    {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);

        return new Client(array_merge(['handler' => $handler, 'http_errors' => false], $headers));
    }

    protected function mockAPI(array $responses, array $options = [])
    {
        return new APIClient($this->clientId, $this->clientSecret, $this->mockHttpClient($responses, $options));
    }

    protected function mockAuthAPI(array $responses, array $options = [], $callbackURI = 'https://api.example.com/callback/')
    {
        return new AuthorizationAPI($this->clientId, $this->clientSecret, $this->mockHttpClient($responses, $options), $callbackURI);
    }
}