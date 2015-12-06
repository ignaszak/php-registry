<?php

namespace Test;

use Ignaszak\Registry\RequestRegistry;

class RequestRegistryTest extends \PHPUnit_Framework_TestCase
{

    private static $_registry;

    public static function setUpBeforeClass()
    {
        self::$_registry = new RequestRegistry;
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

}
