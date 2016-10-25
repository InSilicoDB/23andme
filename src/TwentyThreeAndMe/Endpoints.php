<?php

namespace TwentyThreeAndMe;

class Endpoints
{
    private $APILocation = 'https://api.23andme.com/1/';

    public function genomes($profileId)
    {
        return $this->APILocation.'genomes/'.$profileId.'/';
    }

    public function user()
    {
        return $this->APILocation.'user/';
    }
}