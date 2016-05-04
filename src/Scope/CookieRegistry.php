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

use Ignaszak\Registry\Conf;

/**
 *
 * @author Tomasz Ignaszak <tomek.ignaszak@gmail.com>
 *
 */
class CookieRegistry extends IRegistry
{

    public function __construct()
    {
        if (isset($_COOKIE['IgnaszakRegistry'])) {
            $this->registryArray = unserialize($_COOKIE['IgnaszakRegistry']);
        }
    }

    public function __destruct()
    {
        setcookie(
            'IgnaszakRegistry',
            serialize($this->registryArray),
            time() + Conf::getCookieLife(),
            Conf::getCookiePath()
        );
    }
}
