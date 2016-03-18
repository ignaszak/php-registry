<?php

namespace Test\Scope;

use Test\Mock\MockTest;

class IRegistryTest extends \PHPUnit_Framework_TestCase
{

    public static $_registry;

    public static function setUpBeforeClass()
    {
        new class extends \PHPUnit_Framework_TestCase
        {
            public function __construct()
            {
                \Test\Scope\IRegistryTest::$_registry = $this->getMockForAbstractClass('Ignaszak\Registry\Scope\IRegistry');
            }
        };
    }

    public function testSet()
    {
        $name = 'name';
        $value = 'value';
        self::$_registry->set($name, $value);
        $this->assertEquals(
            \PHPUnit_Framework_Assert::readAttribute(self::$_registry, 'registryArray'),
            array(
                $name => $value
            )
        );
    }

    public function testGet()
    {
        $this->assertEquals(
            self::$_registry->get('name'),
            'value'
        );
    }

    public function testIsAdded()
    {
        $this->assertTrue(self::$_registry->isAdded('name'));
        $this->assertFalse(self::$_registry->isAdded('noExistingName'));
    }

    public function testRemove()
    {
        $this->assertTrue(self::$_registry->remove('name'));
        $registryArray = \PHPUnit_Framework_Assert::readAttribute(self::$_registry, 'registryArray');
        $this->assertFalse(array_key_exists('name', $registryArray));
        $this->assertFalse(self::$_registry->remove('noExistingName'));
    }

    public function testEmptyGet()
    {
        MockTest::inject(self::$_registry, 'registryArray', []);
        $this->assertEmpty(self::$_registry->get('name'));
    }
}
