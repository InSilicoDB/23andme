<?php

namespace Test\TwentyThreeAndMe\APIEndPoints;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Test\TwentyThreeAndMe\Test\BaseTest;
use TwentyThreeAndMe\APIClient;

class GetGenomesTest
    extends BaseTest
{
    private function mockValidGenomeResponses()
    {
        return [
            new Response(200, [], '{"id": "c4480ba411939067", "genome": "ACTAGTAG__TTGADDAAIICCTT"}')
        ];
    }

    public function testGetValidGenome()
    {
        $api = $this->mockAPI($this->mockValidGenomeResponses());
        $genome = $api->genomes('c4480ba411939067');

        $this->assertEquals('c4480ba411939067', $genome->getProfileId());
        $this->assertEquals('ACTAGTAG__TTGADDAAIICCTT', $genome->getGenome());
        $this->fail('woops');
    }
}