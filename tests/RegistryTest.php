<?php

namespace Test;

use Test\Mock\MockTest;
use Ignaszak\Registry\Registry;

class RegistryTest extends \PHPUnit_Framework_TestCase
{

    private $_registry;

    public function setUp()
    {
        $this->_registry = new Registry($this->getMock('Ignaszak\Registry\Scope\IRegistry'));
    }

    public function testSetWithEmptyValues()
    {
        $this->assertFalse($this->_registry->set('', ''));
    }

    public function testSetValue()
    {
        $stub = $this->getMock('Ignaszak\Registry\Scope\IRegistry');
        $stub->expects($this->once())
            ->method('set')
            ->will($this->returnValue(true));

        $_registry = new Registry($stub);
        $name = 'SomeName';
        $value = $this->getMock('SomeClass');
        $_registry->set($name, $value);
    }

    public function testGet()
    {
        $stub = $this->getMock('Ignaszak\Registry\Scope\IRegistry');
        $stub->expects($this->once())
            ->method('get')
            ->will($this->returnValue(true));

        $_registry = new Registry($stub);
        $this->assertTrue($_registry->get('name'));
    }

    /**
     * @expectedException \TypeError
     */
    public function testGetTypeError()
    {
        $name = $this->getMock('WrongType');
        $this->_registry->get($name);
    }

    public function testRegisterAdded()
    {
        $stub = $this->getMock('Ignaszak\Registry\Scope\IRegistry');
        $stub->expects($this->once())
            ->method('get')
            ->will($this->returnValue(new self));
        $stub->expects($this->once())
            ->method('isAdded')
            ->will($this->returnValue(true));

        $_registry = new Registry($stub);
        $this->assertInstanceOf(__CLASS__, $_registry->register(__CLASS__));
    }

    public function testRegisterNew()
    {
        $stub = $this->getMock('Ignaszak\Registry\Scope\IRegistry');
        $stub->expects($this->once())
            ->method('isAdded')
            ->will($this->returnValue(false));
        $stub->expects($this->once())
            ->method('set');

        $_registry = new Registry($stub);
        $_registry->register(__CLASS__);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testRegisterException()
    {
        $stub = $this->getMock('Ignaszak\Registry\Scope\IRegistry');
        $stub->expects($this->once())
            ->method('isAdded');

        $_registry = new Registry($stub);
        $_registry->register('noExistingClass');
    }

    public function testRemove()
    {
        $stub = $this->getMock('Ignaszak\Registry\Scope\IRegistry');
        $stub->expects($this->once())
            ->method('remove')
            ->will($this->returnValue(true));

        $_registry = new Registry($stub);
        $_registry->remove('name');
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testReloadNonAddedClass()
    {
        $stub = $this->getMock('Ignaszak\Registry\Scope\IRegistry');
        $stub->expects($this->once())
            ->method('isAdded')
            ->will($this->returnValue(false));

        $_registry = new Registry($stub);
        $_registry->reload('noExistingClass');
    }

    public function testReload()
    {
        $stub = $this->getMock('Ignaszak\Registry\Scope\IRegistry');
        $stub->expects($this->once())
            ->method('isAdded')
            ->will($this->returnValue(true));
        $stub->expects($this->once())
            ->method('get')
            ->will($this->returnValue($this->getMock(__CLASS__)));

        $_registry = new Registry($stub);
        $this->assertTrue($_registry->reload(__CLASS__));
    }

    public function testIsObject()
    {
        $value = $this->getMock('SomeClass');
        $isObject = MockTest::callMockMethod($this->_registry, 'isObject', array($value));
        $this->assertTrue($isObject);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testIsObjectException()
    {
        MockTest::callMockMethod($this->_registry, 'isObject', array('NoObject'));
    }

    public function testClassExists()
    {
        $classExists = MockTest::callMockMethod($this->_registry, 'classExists', array(__CLASS__));
        $this->assertTrue($classExists);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testClassExistsException()
    {
        MockTest::callMockMethod($this->_registry, 'classExists', array('noExistingClass'));
    }
}
