<?php
/**
 * phpDocumentor
 *
 * PHP Version 7.0
 *
 * @copyright 2015 Tomasz Ignaszak
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace Ignaszak\Registry;

/**
 * 
 * @author Tomasz Ignaszak <tomek.ignaszak@gmail.com>
 * @link
 *
 */
class SessionRegistry extends IRegistry
{

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();

        if (isset($_SESSION['IgnaszakRegistry']))
            $this->registryArray = unserialize($_SESSION['IgnaszakRegistry']);
    }

    public function __destruct()
    {
        $_SESSION['IgnaszakRegistry'] = serialize($this->registryArray);
    }

}
