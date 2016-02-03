<?php

namespace TwentyThreeAndMe\Exception;

class APIException extends \Exception
{
    public function __construct($error, $description)
    {
        parent::__construct(
            sprintf('Error "%s": %s', $error, $description)
        );
    }
}