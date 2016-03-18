<?php
namespace Test;

use Ignaszak\Registry\Conf;

class ConfTest extends \PHPUnit_Framework_TestCase
{

    public function testTmpPath()
    {
        Conf::setTmpPath('anyPath');
        $this->assertEquals('anyPath', Conf::getTmpPath());
    }

    public function testCookieLife()
    {
        Conf::setCookieLife(1234);
        $this->assertEquals(1234, Conf::getCookieLife());
    }

    public function testCookiePath()
    {
        Conf::setCookiePath('/');
        $this->assertEquals('/', Conf::getCookiePath());
    }
}
