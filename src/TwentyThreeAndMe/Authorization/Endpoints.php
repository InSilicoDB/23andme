<?php
/**
 * Created by PhpStorm.
 * User: jamescauwelier
 * Date: 03/02/16
 * Time: 15:52
 */

namespace TwentyThreeAndMe\Authorization;


class Endpoints
{
    private $APILocation = 'https://api.23andme.com/';

    public function token()
    {
        return $this->APILocation.'token/';
    }
}