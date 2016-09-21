<?php
namespace Test\TwentyThreeAndMe\Test;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    use MockHelper;
    use TokenHelper;
    use GenomeHelper;

    public function setUp()
    {
        parent::setUp();

        @mkdir(__DIR__ . '/../../../data/tmp/', 0777, true);
    }

    public function tearDown()
    {
        array_map('unlink', glob(__DIR__ . '/../../../data/tmp/*.txt'));

        parent::tearDown();
    }
}