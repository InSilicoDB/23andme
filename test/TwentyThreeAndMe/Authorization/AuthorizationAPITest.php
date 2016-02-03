<?php

namespace Test\TwentyThreeAndMe\Authorization;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Test\TwentyThreeAndMe\Test\BaseTest;
use TwentyThreeAndMe\Authorization\AuthorizationAPI;
use TwentyThreeAndMe\Exception\APIException;
use TwentyThreeAndMe\Exception\HttpStatusException;

class AuthorizationAPITest extends BaseTest
{
    private $clientId = 1;
    private $clientSecret = 'secret123';
    private $authorizationCode = 'sad874g3a5fdg7';
    private $authorizationScopes = ['rs3094315', 'basic'];
    private $callbackURI = 'https://api.example.com/callback/';

    private function mockValidTokenResponse()
    {
        return [
            new Response(200, [], '{"access_token":"89822b93d2", "token_type":"bearer", "expires_in": 86400, "refresh_token":"33c53cd7bb", "scope":"rs3094315 basic"}')
        ];
    }

    private function mockUnexpectedExceptionResponse()
    {
        return [
            new Response(500, [], '')
        ];
    }

    private function mockExpectedExceptionResponse()
    {
        return [
            new Response(400, [], '{"error": "invalid_scope", "error_description": "The requested scope is invalid, unknown, or malformed."}')
        ];
    }

    public function testTokenRequest()
    {
        $api = $this->mockAuthAPI($this->mockValidTokenResponse());
        $token = $api->requestToken($this->authorizationCode, $this->authorizationScopes);

        $this->assertEquals('89822b93d2', $token->getAccessToken());
        $this->assertEquals('bearer', $token->getTokenType());
        $this->assertEquals('86400', $token->getExpiresIn());
        $this->assertEquals('33c53cd7bb', $token->getRefreshToken());
        $this->assertEquals('rs3094315 basic', $token->getScope());
    }

    public function testUnexpectedException()
    {
        $api = $this->mockAuthAPI($this->mockUnexpectedExceptionResponse());

        try {
            $token = $api->requestToken($this->authorizationCode, $this->authorizationScopes);
            $this->fail('Unexpected exceptions are expected to be thrown with a HttpStatusException');
        } catch (HttpStatusException $e) {
            $this->assertStringStartsWith('23AndMe API failed with 500: ', $e->getMessage());
        }
    }

    public function testDocumentedException()
    {
        $api = $this->mockAuthAPI($this->mockExpectedExceptionResponse());

        try {
            $token = $api->requestToken($this->authorizationCode, $this->authorizationScopes);
            $this->fail('Expected exceptions are expected to be thrown with an APIException');
        } catch (APIException $e) {
            $this->assertStringStartsWith('Error "invalid_scope": The requested scope is invalid, unknown, or malformed.', $e->getMessage());
        }
    }
}
