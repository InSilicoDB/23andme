<?php
/**
 * Created by PhpStorm.
 * User: jamescauwelier
 * Date: 03/02/16
 * Time: 15:43
 */

namespace TwentyThreeAndMe\Responses;


class Profile
{
    private $profileId;
    private $genotyped;

    public function __construct(array $profileData)
    {
        $this->profileId = $profileData['id'];
        $this->genotyped = (bool) $profileData['genotyped'];
    }

    public function getProfileId()
    {
        return $this->profileId;
    }

    public function getGenotyped()
    {
        return $this->genotyped;
    }
}