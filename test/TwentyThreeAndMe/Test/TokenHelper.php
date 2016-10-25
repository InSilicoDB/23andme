<?php
namespace Test\TwentyThreeAndMe\Test;

use TwentyThreeAndMe\Authorization\Token;

trait TokenHelper
{
    protected function givenThereIsAToken()
    {
        return new Token([
            'access_token'      => '',
            'token_type'        => '',
            'expires_in'        => '',
            'refresh_token'     => '',
            'scope'             => ''
        ]);
    }
}