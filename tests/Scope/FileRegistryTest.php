<?php

namespace Test\Scope;

use Ignaszak\Registry\Scope\FileRegistry;
use Ignaszak\Registry\Conf;
use Test\Mock\MockTest;

class FileRegistryTest extends \PHPUnit_Framework_TestCase
{

    private $_registry;

    private $path;

    public function setUp()
    {
        $this->path = MockTest::mockDir('tmpPath');
        Conf::setTmpPath($this->path);
        $this->_registry = new FileRegistry();
    }

    public function testSetAgain()
    {
        $stub = $this->getMock('Ignaszak\Registry\Scope\FileRegistry', ['get']);
        $stub->method('get')->willReturnSelf();
        $stub->set('anyName', $stub);
        $this->assertInstanceOf(
            get_class($stub),
            \PHPUnit_Framework_Assert::readAttribute(
                $stub,
                'registryArray'
            )['anyName']
        );
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testCantCreateTmpFolder()
    {
        Conf::setTmpPath(MockTest::mockFile('tmpPath', 0000));
        $stub = $this->getMock('AnyClass');
        $this->_registry->set('anyName', $stub);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testCantSave()
    {
        $dir = MockTest::mockDir('tmpPath');
        chmod($dir, 0000);
        Conf::setTmpPath($dir);
        $stub = $this->getMock('AnyClass');
        $this->_registry->set('anyName', $stub);
    }

    public function testSaveFileOnSet()
    {
        $stub = $this->getMock('AnyClass');
        $this->_registry->set('name', $stub);
        $this->assertFileExists("{$this->path}/IgnaszakRegistry_name.tmp");
    }

    public function testGetNull()
    {
        $this->assertEmpty($this->_registry->get('name'));
    }

    public function testGetContent()
    {
        file_put_contents(
            "{$this->path}/IgnaszakRegistry_name.tmp",
            's:7:"content"'
        );
        $this->assertEquals(
            'content',
            $this->_registry->get('name')
        );
    }

    public function testRemove()
    {
        file_put_contents("{$this->path}/IgnaszakRegistry_name.tmp", 'content');
        $this->_registry->remove('name');
        $this->assertFileNotExists("{$this->path}/IgnaszakRegistry_name.tmp");
    }
}
