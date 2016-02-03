<?php
/**
 * Created by PhpStorm.
 * User: jamescauwelier
 * Date: 03/02/16
 * Time: 15:20
 */

namespace Test\TwentyThreeAndMe\APIEndPoints;


use GuzzleHttp\Psr7\Response;
use Test\TwentyThreeAndMe\Test\BaseTest;

class GetUserTest extends BaseTest
{
    private function provideBasicUserResponse()
    {
        return [
            new Response(200, [], '{ "id": "a42e94634e3f7683", "profiles": [ { "genotyped": true, "id": "c4480ba411939067" }, { "genotyped": false, "id": "c4480ba6843547341" } ] }')
        ];
    }

    public function testGetUser()
    {
        $mockedAPI = $this->mockAPI($this->provideBasicUserResponse());
        $user = $mockedAPI->user();

        $this->assertEquals("a42e94634e3f7683", $user->getUserId());
        $this->assertEquals("c4480ba411939067", $user->getProfiles()[0]->getProfileId());
        $this->assertEquals(true, $user->getProfiles()[0]->getGenotyped());
        $this->assertEquals(false, $user->getProfiles()[1]->getGenotyped());
    }
}