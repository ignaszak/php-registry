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
    private static $registryArray = [];

    /**
     *
     * @param string $registry
     * @return \Ignaszak\Registry\Scope\IRegistry
     */
    public static function start(string $registry = 'request'): IRegistry
    {
        if (array_key_exists($registry, self::$registryArray)) {
            return self::$registryArray[$registry];
        } else {
            self::$registryArray[$registry] = self::getRegistryInstance(
                $registry
            );
            return self::$registryArray[$registry];
        }
    }

    /**
     *
     * @param string $registry
     * @throws RegistryException
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
                throw new RegistryException('Incorrect argument');
        }
    }
}
