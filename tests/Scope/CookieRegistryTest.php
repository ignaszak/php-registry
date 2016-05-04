<?php

namespace Test\Scope;

use Ignaszak\Registry\Scope\CookieRegistry;

class CookieRegistryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @runInSeparateProcess
     */
    public function testEmptyCookie()
    {
        $cookie = new CookieRegistry();
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute(
            $cookie,
            'registryArray'
        ));
    }

    /**
     * @runInSeparateProcess
     */
    public function testExistingCookie()
    {
        @$_COOKIE['IgnaszakRegistry'] = 'a:1:{i:0;s:13:"cookieContent";}';
        $cookie = new CookieRegistry();
        $this->assertEquals(
            ['cookieContent'],
            \PHPUnit_Framework_Assert::readAttribute(
                $cookie,
                'registryArray'
            )
        );
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetCookie()
    {
        $cookie = new CookieRegistry();
        unset($cookie);
    }
}
