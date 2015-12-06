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
     * @var Registry
     */
    private static $_registry;

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
        if (empty(self::$_registry))
            self::$_registry = new Registry;

        self::$_registry->setInstance(self::getRegistryInstance($registry));
        return self::$_registry;
    }

    /**
     * @param string $registry
     * @return IRegistry
     */
    private static function getRegistryInstance(string $registry): IRegistry
    {
        if (array_key_exists($registry, self::$_registryArray)) {

            return self::$_registryArray[$registry];

        } else {

            $registryClass = self::getClassName($registry);
            self::$_registryArray[$registry] = new $registryClass;
            return self::$_registryArray[$registry];

        }
    }

    /**
     * @param string $registry
     * @return string
     */
    private static function getClassName(string $registry): string
    {
        switch ($registry) {
            case 'request': return __NAMESPACE__ . '\RequestRegistry'; break;
            case 'session': return __NAMESPACE__ . '\SessionRegistry'; break;
            case 'coockie': return __NAMESPACE__ . '\CoockieRegistry'; break;
            default: throw new Exception('Incorrect argument');
        }
    }

}
