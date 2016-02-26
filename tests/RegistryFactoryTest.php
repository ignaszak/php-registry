<?php

namespace Test;

use Ignaszak\Registry\RegistryFactory;

class RegistryFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testStart()
    {
        $this->assertInstanceOf('\Ignaszak\Registry\Registry', RegistryFactory::start());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testStartException()
    {
        RegistryFactory::start('incorrectArgument');
    }
}
