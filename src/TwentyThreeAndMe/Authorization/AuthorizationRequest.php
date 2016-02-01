<?php

namespace TwentyThreeAndMe\Authorization;

/**
 * Helps to construct the authentication URL to redirect clients to
 */
class AuthorizationRequest
{
    /**
     * The redirect uri from your dashboard, e.g. https://exampleapp.com/receive_code/.
     * @var string
     */
    private $redirectURI;

    /**
     * Unclear what this does.  See {@link https://api.23andme.com/docs/authentication/ official docs}
     * @var string
     */
    private $responseType = 'code';

    /**
     * The client id from your dashboard.
     * @var string
     */
    private $clientId;

    /**
     * A list of scopes you're asking the user to allow you to access. See
     * {@link https://api.23andme.com/docs/authentication/#scopes scopes} for a list of them.
     *
     * @var array
     */
    private $scopes = [];

    /**
     * An optional value of your choosing, to maintain state between the request and the callback.
     * @var string
     */
    private $optionalState;

    public function withRedirectURI($uri)
    {
        $this->redirectURI = $uri;

        return $this;
    }

    public function withClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function withScope($scope)
    {
        $this->scopes[] = $scope;
        $this->scopes = array_unique($this->scopes);

        return $this;
    }

    public function withState($state)
    {
        $this->optionalState = $state;

        return $this;
    }

    /**
     * Generates a URL to redirect the user to to gain access to their 23AndMe data
     * @return string
     */
    private function createAuthorizationURI()
    {
        $query = http_build_query([
            'redirect_uri'  => $this->redirectURI,
            'response_type' => $this->responseType,
            'client_id'     => $this->clientId,
            'scope'         => implode(' ', $this->scopes),
            'state'         => $this->optionalState
        ]);
        return sprintf(
            'https://api.23andme.com/authorize/?%s',
            $query
        );
    }

    /**
     * The string representation must be the authorization URL
     * @return string
     */
    public function __toString()
    {
        return $this->createAuthorizationURI();
    }
}