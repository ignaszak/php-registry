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
class RegistryFactory
{

    /**
     * @var IRegistry[]
     */
    private static $_registryArray = array();

    /**
     * @param string $registry
     * @return Registry
     */
    public static function start(string $registry = 'request'): Registry
    {
        if (array_key_exists($registry, self::$_registryArray)) {
            return self::$_registryArray[$registry];
        } else {
            self::$_registryArray[$registry] = new Registry(self::getRegistryInstance($registry));
            return self::$_registryArray[$registry];
        }
    }

    /**
     * @param string $registry
     * @return string
     * @throws Exception
     */
    private static function getRegistryInstance(string $registry): IRegistry
    {
        switch ($registry) {
            case 'request':
                return new RequestRegistry;
            break;
            case 'session':
                return new SessionRegistry;
            break;
            case 'cookie':
                return new CookieRegistry;
            break;
            case 'file':
                return new FileRegistry;
            break;
            default:
                throw new Exception('Incorrect argument');
        }
    }
}
