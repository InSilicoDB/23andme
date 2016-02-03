<?php

namespace TwentyThreeAndMe\Responses;


class User
{
    private $userId;
    private $profiles = [];

    public function __construct(array $data)
    {
        $this->userId = $data['id'];
        foreach ($data['profiles'] as $profileData)
        {
            $this->profiles[] = new Profile($profileData);
        }
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getProfiles()
    {
        return $this->profiles;
    }
}