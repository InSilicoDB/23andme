<?php

namespace TwentyThreeAndMe\Responses;


class User
{
    /**
     * @var int
     */
    private $userId;

    /**
     * @var Profile[]
     */
    private $profiles = [];

    public function __construct(array $data)
    {
        $this->userId = $data['id'];
        foreach ($data['profiles'] as $profileData)
        {
            $this->profiles[] = new Profile($profileData);
        }
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return Profile[]
     */
    public function getProfiles()
    {
        return $this->profiles;
    }
}