<?php

namespace Test;

use Ignaszak\Registry\RegistryFactory;
use Test\Mock\MockTest;

class RegistryFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testSetNewInstanceAtStart()
    {
        $this->assertInstanceOf(
            'Ignaszak\Registry\Scope\IRegistry',
            RegistryFactory::start()
        );
    }

    public function testReturnSavedInstanceAtStart()
    {
        $stub = $this->getMockBuilder('Ignaszak\Registry\Scope\IRegistry')
        ->disableOriginalConstructor()
        ->setMethods(['test'])
        ->getMock();
        $stub->method('test')->willReturn(true);
        MockTest::injectStatic(
            'Ignaszak\Registry\RegistryFactory',
            'registryArray',
            ['request' => $stub]
        );
        $result = RegistryFactory::start();
        $this->assertTrue($result->test());
    }

    /**
     * @expectedException \Ignaszak\Registry\RegistryException
     */
    public function testInvalidArgument()
    {
        RegistryFactory::start('invalidArgument');
    }

    public function testGetRequestInstance()
    {
        $this->assertInstanceOf(
            'Ignaszak\Registry\Scope\RequestRegistry',
            $this->getRegistryInstance('request')
        );
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetSessionInstance()
    {
        $this->assertInstanceOf(
            'Ignaszak\Registry\Scope\SessionRegistry',
            $this->getRegistryInstance('session')
        );
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetCookieInstance()
    {
        $this->assertInstanceOf(
            'Ignaszak\Registry\Scope\CookieRegistry',
            $this->getRegistryInstance('cookie')
        );
    }

    public function testGetFileInstance()
    {
        $this->assertInstanceOf(
            'Ignaszak\Registry\Scope\FileRegistry',
            $this->getRegistryInstance('file')
        );
    }

    /**
     * @expectedException \Ignaszak\Registry\RegistryException
     */
    public function testStartException()
    {
        RegistryFactory::start('incorrectArgument');
    }

    private function getRegistryInstance(string $registry)
    {
        return MockTest::callMockMethod(
            'Ignaszak\Registry\RegistryFactory',
            'getRegistryInstance',
            [$registry]
        );
    }
}
