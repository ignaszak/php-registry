<?php

namespace Test;

use Ignaszak\Registry\SessionRegistry;

class SessionRegistryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @runInSeparateProcess
     */
    public function testSetSessionOnDestructorIfRegisterIsNotNull()
    {
        session_start();

        $registry = new SessionRegistry;
        $registry->set('test', $this->getMock('AnyClass'));
        unset($registry);
        $this->assertNotNull($_SESSION['IgnaszakRegistry']);

        $registry = new SessionRegistry;
        $this->assertInstanceOf('AnyClass', $registry->get('test'));
    }
}
