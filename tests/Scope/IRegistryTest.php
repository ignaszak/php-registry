<?php
namespace Test\Scope;

class IRegistryTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var \Ignaszak\Registry\Scope\IRegistry
     */
    public $IRegistry = null;

    public function setUp()
    {
        $this->IRegistry = $this->getMockForAbstractClass(
            'Ignaszak\Registry\Scope\IRegistry'
        );
    }

    public function testSetAndGetMethods()
    {
        $result = $this->IRegistry->set('name', 'value');
        $this->assertEquals('value', $this->IRegistry->get('name'));
        $this->assertInstanceOf('Ignaszak\Registry\Scope\IRegistry', $result);
    }

    /**
     * @expectedException \Ignaszak\Registry\RegistryException
     */
    public function testRegisterNonClass()
    {
        $this->IRegistry->register('nonClass');
    }

    public function testRegisterClass()
    {
        $className = get_class($this->getMockBuilder('NewClass')->getMock());
        $this->assertInstanceOf(
            $className,
            $this->IRegistry->register($className)
        );
        $this->assertInstanceOf(
            $className,
            $this->IRegistry->register($className)
        );
    }

    public function testRemove()
    {
        $object = $this->getMockBuilder('NewClass')->getMock();
        $this->IRegistry->set('test', $object);
        $this->assertInstanceOf(
            'Ignaszak\Registry\Scope\IRegistry',
            $this->IRegistry->remove('test')
        );
        $this->assertNull($this->IRegistry->get('test'));
    }

    /**
     * @expectedException \Ignaszak\Registry\RegistryException
     */
    public function testReloadUnaddedClass()
    {
        $this->IRegistry->reload('unaddedClass');
    }

    /**
     * @expectedException \Ignaszak\Registry\RegistryException
     */
    public function testReoladNonObject()
    {
        $this->IRegistry->set('name', 'string');
        $this->IRegistry->reload('name');
    }

    public function testReload()
    {
        $object = new class () {
            public static $count = 0;
            public function __construct()
            {
                ++self::$count;
            }
            public function get(): int
            {
                return self::$count;
            }
        };
        $this->assertEquals(1, $object->get());
        $this->IRegistry->set('test', $object);
        $this->IRegistry->reload('test');
        $this->assertEquals(2, $object->get());
    }

    public function testHas()
    {
        $this->assertFalse($this->IRegistry->has('test'));
        $this->IRegistry->set('test', 'string');
        $this->assertTrue($this->IRegistry->has('test'));
    }
}
