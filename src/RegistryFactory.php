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
declare(strict_types=1);

namespace Ignaszak\Registry;

use Ignaszak\Registry\Scope\IRegistry;

/**
 *
 * @author Tomasz Ignaszak <tomek.ignaszak@gmail.com>
 *
 */
class RegistryFactory
{

    /**
     * @var IRegistry[]
     */
    private static $_registryArray = [];

    /**
     *
     * @param string $registry
     * @return \Ignaszak\Registry\IRegistry
     */
    public static function start(string $registry = 'request'): Registry
    {
        if (array_key_exists($registry, self::$_registryArray)) {
            return self::$_registryArray[$registry];
        } else {
            self::$_registryArray[$registry] = new Registry(
                self::getRegistryInstance($registry)
            );
            return self::$_registryArray[$registry];
        }
    }

    /**
     *
     * @param string $registry
     * @throws \InvalidArgumentException
     * @return \Ignaszak\Registry\Scope\IRegistry
     */
    private static function getRegistryInstance(string $registry): IRegistry
    {
        switch ($registry) {
            case 'request':
                return new Scope\RequestRegistry();
            case 'session':
                return new Scope\SessionRegistry();
            case 'cookie':
                return new Scope\CookieRegistry();
            case 'file':
                return new Scope\FileRegistry();
            default:
                throw new \InvalidArgumentException('Incorrect argument');
        }
    }
}
