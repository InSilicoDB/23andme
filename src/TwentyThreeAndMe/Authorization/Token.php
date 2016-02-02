<?php

namespace TwentyThreeAndMe\Authorization;

/**
 * OAuth token to use in API requests to 23AndMe
 */
class Token
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getAccessToken()
    {
        return $this->data['access_token'];
    }

    public function getTokenType()
    {
        return $this->data['token_type'];
    }

    public function getExpiresIn()
    {
        return $this->data['expires_in'];
    }

    public function getRefreshToken()
    {
        return $this->data['refresh_token'];
    }

    public function getScope()
    {
        return $this->data['scope'];
    }
}