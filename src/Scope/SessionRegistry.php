<?php
/**
 * phpDocumentor
 *
 * PHP Version 7.0
 *
 * @copyright 2016 Tomasz Ignaszak
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 */
declare(strict_types=1);

namespace Ignaszak\Registry\Scope;

/**
 *
 * @author Tomasz Ignaszak <tomek.ignaszak@gmail.com>
 *
 */
class SessionRegistry extends IRegistry
{

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (isset($_SESSION['IgnaszakRegistry'])) {
            $this->registryArray = unserialize($_SESSION['IgnaszakRegistry']);
        }
    }

    public function __destruct()
    {
        $_SESSION['IgnaszakRegistry'] = serialize($this->registryArray);
    }
}
