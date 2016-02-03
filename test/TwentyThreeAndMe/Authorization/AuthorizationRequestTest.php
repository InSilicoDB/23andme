<?php

namespace Test\TwentyThreeAndMe\Authorization;

use Test\TwentyThreeAndMe\BaseTest;
use TwentyThreeAndMe\Authorization\AuthorizationRequest;
use TwentyThreeAndMe\Authorization\Scope;

/**
 * Feature: Authorization of a 23AndMe account using a OAuth2 handshake
 */
class AuthorizationRequestTest extends BaseTest
{
    public function testAuthorizationRequestUrl()
    {
        $request = (new AuthorizationRequest())
            ->withRedirectURI('http://api.example.com/callback/')
            ->withClientId('u937')
            ->withScope(Scope::BASIC)
            ->withScope(Scope::GENOMES)
            ->withScope(Scope::iXX(45))
            ->withScope(Scope::rsXX(88))
            ->withScope(Scope::readPhenotype('blabla'))
            ->withScope(Scope::writePhenotype('boom'))
            ->withState('do8sujaf89r83uefjsadolg8sauf0g');

        $this->assertEquals(
            'https://api.23andme.com/authorize/?redirect_uri=http%3A%2F%2Fapi.example.com%2Fcallback%2F&response_type=code&client_id=u937&scope=basic+genomes+i45+rs88+phenotypes%3Aread%3Ablabla+phenotypes%3Awrite%3Aboom&state=do8sujaf89r83uefjsadolg8sauf0g',
            (string) $request
        );
    }
}
