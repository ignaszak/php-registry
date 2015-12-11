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
class CookieRegistry extends IRegistry
{

    public function __construct()
    {
        if (isset($_COOKIE['IgnaszakRegistry']))
            $this->registryArray = unserialize($_COOKIE['IgnaszakRegistry']);
    }

    public function __destruct()
    {
        if (count($this->registryArray)) {
            setcookie('IgnaszakRegistry', serialize($this->registryArray), time() + Conf::getCookieLife());
        }
    }

}
