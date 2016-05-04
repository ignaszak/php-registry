<?php

namespace Test\Scope;

use Ignaszak\Registry\Scope\FileRegistry;
use Ignaszak\Registry\Conf;
use Test\Mock\MockTest;

class FileRegistryTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var \Ignaszak\Registry\Scope\FileRegistry
     */
    private $fileRegistry = null;

    /**
     *
     * @var string
     */
    private $path = '';

    public function setUp()
    {
        $this->path = MockTest::mockDir('tmpPath');
        Conf::setTmpPath($this->path);
        $this->fileRegistry = new FileRegistry();
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
     * @expectedException \Ignaszak\Registry\RegistryException
     */
    public function testCantCreateTmpFolder()
    {
        Conf::setTmpPath(MockTest::mockFile('tmpPath', 0000));
        $stub = $this->getMock('AnyClass');
        $this->fileRegistry->set('anyName', $stub);
    }

    /**
     * @expectedException \Ignaszak\Registry\RegistryException
     */
    public function testCantSave()
    {
        $dir = MockTest::mockDir('tmpPath');
        chmod($dir, 0000);
        Conf::setTmpPath($dir);
        $stub = $this->getMock('AnyClass');
        $this->fileRegistry->set('anyName', $stub);
    }

    public function testSaveFileOnSet()
    {
        $stub = $this->getMock('AnyClass');
        $this->fileRegistry->set('name', $stub);
        $this->assertFileExists("{$this->path}/IgnaszakRegistry_name.tmp");
    }

    public function testGetNull()
    {
        $this->assertEmpty($this->fileRegistry->get('name'));
    }

    public function testGetContent()
    {
        file_put_contents(
            "{$this->path}/IgnaszakRegistry_name.tmp",
            's:7:"content";'
        );
        $this->assertEquals(
            'content',
            $this->fileRegistry->get('name')
        );
    }

    public function testRemove()
    {
        file_put_contents("{$this->path}/IgnaszakRegistry_name.tmp", 'content');
        $this->fileRegistry->remove('name');
        $this->assertFileNotExists("{$this->path}/IgnaszakRegistry_name.tmp");
    }
}
