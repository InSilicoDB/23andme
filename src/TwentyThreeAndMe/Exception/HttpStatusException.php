<?php

namespace TwentyThreeAndMe\Exception;

class HttpStatusException extends \Exception
{
    public function __construct($httpCode, $message)
    {
        parent::__construct(
            '23AndMe API failed with '.$httpCode.': '.$message
        );
    }
}