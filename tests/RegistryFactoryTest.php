<?php

namespace Test;

use Test\Mock\MockTest;
use Ignaszak\Registry\RegistryFactory;

class RegistryFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testStart()
    {
        $this->assertInstanceOf('\Ignaszak\Registry\Registry', RegistryFactory::start());
    }

    /**
     * @expectedException \Ignaszak\Registry\Exception
     */
    public function testStartException()
    {
        RegistryFactory::start('incorrectArgument');
    }

}
