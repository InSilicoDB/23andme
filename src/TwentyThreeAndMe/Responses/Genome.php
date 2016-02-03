<?php
/**
 * Created by PhpStorm.
 * User: jamescauwelier
 * Date: 03/02/16
 * Time: 13:58
 */

namespace TwentyThreeAndMe\Responses;

/**
 * Represents a genome
 */
class Genome
{
    private $profileId;
    private $genome;

    public function __construct(array $APIResponseData)
    {
        $this->profileId = $APIResponseData['id'];
        $this->genome = $APIResponseData['genome'];
    }

    public function getProfileId()
    {
        return $this->profileId;
    }

    public function getGenome()
    {
        return $this->genome;
    }
}