<?php

namespace TwentyThreeAndMe;

/**
 * Created by PhpStorm.
 * User: jamescauwelier
 * Date: 01/02/16
 * Time: 14:56
 */
class BasicTest extends \PHPUnit_Framework_TestCase
{
    public function testSomethingTrue()
    {
        $this->assertTrue(true, "All ok");
    }

    public function testSomethingFalse()
    {
        $this->assertTrue(false, "boom");
    }
}
