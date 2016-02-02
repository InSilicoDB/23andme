<?php

namespace TwentyThreeAndMe\Authorization;

use Psr\Http\Message\ResponseInterface;
use TwentyThreeAndMe\Exception\APIException;
use TwentyThreeAndMe\Exception\HttpStatusException;

/**
 * Wraps an HTTP response so that it is easier to handle common errors and parse common responses (JSON)
 */
class ResponseInterpreter
{
    /**
     * @var ResponseInterface
     */
    private $httpResponse;

    /**
     * @var array
     */
    private $responseData;

    public function __construct(ResponseInterface $httpResponse)
    {
        $this->httpResponse = $httpResponse;
    }

    /**
     * Parses the body as Json and returns the results as an array
     */
    public function asArray()
    {
        if (empty($this->responseData))
        {
            $this->responseData = json_decode($this->httpResponse->getBody()->getContents(), true);
            $this->handleHttpErrors();
        }

        return $this->responseData;
    }

    private function handleHttpErrors()
    {
        if ($this->httpResponse->getStatusCode() !== 200) {
            if (is_null($this->responseData)) {
                // unexpected exception
                throw new HttpStatusException($this->httpResponse->getStatusCode(), 'Failed to request token for unknown reason');
            } else {
                // proxy 23andMe exception
                throw new APIException($this->responseData['error'], $this->responseData['error_description']);
            }
        }
    }
}