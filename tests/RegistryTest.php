<?php

namespace Test;

use Test\Mock\MockTest;
use Ignaszak\Registry\Registry;

class RegistryTest extends \PHPUnit_Framework_TestCase
{

    private $_registry;

    public function setUp()
    {
        $this->_registry = new Registry;
    }

    public function testSetWithEmptyValues()
    {
        $this->assertFalse($this->_registry->set('', ''));
    }

    public function testSetValue()
    {
        $stub = $this->getMock('Ignaszak\Registry\IRegistry');
        $stub->expects($this->once())
            ->method('set')
            ->will($this->returnValue(true));

        $this->_registry->setInstance($stub);
        $name = 'SomeName';
        $value = $this->getMock('SomeClass');
        $this->_registry->set($name, $value);
    }

    public function testGet()
    {
        $stub = $this->getMock('Ignaszak\Registry\IRegistry');
        $stub->expects($this->once())
            ->method('get')
            ->will($this->returnValue(true));

        $this->_registry->setInstance($stub);
        $this->assertTrue($this->_registry->get('name'));
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
        $stub = $this->getMock('Ignaszak\Registry\IRegistry');
        $stub->expects($this->once())
            ->method('get')
            ->will($this->returnValue(new self));
        $stub->expects($this->once())
            ->method('isAdded')
            ->will($this->returnValue(true));

        $this->_registry->setInstance($stub);
        $this->assertInstanceOf(__CLASS__, $this->_registry->register(__CLASS__));
    }

    public function testRegisterNew()
    {
        $stub = $this->getMock('Ignaszak\Registry\IRegistry');
        $stub->expects($this->once())
            ->method('isAdded')
            ->will($this->returnValue(false));
        $stub->expects($this->once())
            ->method('set');

        $this->_registry->setInstance($stub);
        $this->_registry->register(__CLASS__);
    }

    /**
     * @expectedException \Ignaszak\Registry\Exception
     */
    public function testRegisterException()
    {
        $stub = $this->getMock('Ignaszak\Registry\IRegistry');
        $stub->expects($this->once())
            ->method('isAdded');

        $this->_registry->setInstance($stub);
        $this->_registry->register('noExistingClass');
    }

    public function testRemove()
    {
        $stub = $this->getMock('Ignaszak\Registry\IRegistry');
        $stub->expects($this->once())
            ->method('remove')
            ->will($this->returnValue(true));

        $this->_registry->setInstance($stub);
        $this->_registry->remove('name');
    }

    /**
     * @expectedException \Ignaszak\Registry\Exception
     */
    public function testReloadNonAddedClass()
    {
        $stub = $this->getMock('Ignaszak\Registry\IRegistry');
        $stub->expects($this->once())
            ->method('isAdded')
            ->will($this->returnValue(false));

        $this->_registry->setInstance($stub);
        $this->_registry->reload('noExistingClass');
    }

    public function testReload()
    {
        $stub = $this->getMock('Ignaszak\Registry\IRegistry');
        $stub->expects($this->once())
        ->method('isAdded')
        ->will($this->returnValue(true));
    
        $this->_registry->setInstance($stub);
        $this->assertTrue($this->_registry->reload(__CLASS__));
    }

    public function testIsObject()
    {
        $value = $this->getMock('SomeClass');
        $isObject = MockTest::callMockMethod($this->_registry, 'isObject', array($value));
        $this->assertTrue($isObject);
    }

    /**
     * @expectedException \Ignaszak\Registry\Exception
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
     * @expectedException \Ignaszak\Registry\Exception
     */
    public function testClassExistsException()
    {
        MockTest::callMockMethod($this->_registry, 'classExists', array('noExistingClass'));
    }

}
