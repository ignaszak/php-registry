<?php

namespace Test;

use Ignaszak\Registry\FileRegistry;

class FileRegistryTest extends \PHPUnit_Framework_TestCase
{

    private  $_registry;
    private $path;

    public function setUp()
    {
        $this->_registry = new FileRegistry;
        $this->path = \PHPUnit_Framework_Assert::readAttribute($this->_registry, 'path');
    }

    public function testSaveFileOnSet()
    {
        $stub = $this->getMock('AnyClass');
        $this->_registry->set('name', $stub);
        $this->assertFileExists("{$this->path}/IgnaszakRegistry_name.tmp");
    }

    public function testGetRegistry()
    {
        $this->assertInstanceOf('AnyClass', $this->_registry->get('name'));
    }

    public function testRemove()
    {
        $this->_registry->remove('name');
        $this->assertFileNotExists("{$this->path}/IgnaszakRegistry_name.tmp");
    }

}
