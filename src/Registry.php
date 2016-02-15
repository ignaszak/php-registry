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

/**
 *
 * @author Tomasz Ignaszak <tomek.ignaszak@gmail.com>
 * @link
 *
 */
class Registry
{

    /**
     * @var IRegistry
     */
    private $_registry;

    /**
     * @param IRegistry $_registry
     */
    public function __construct(Scope\IRegistry $_registry)
    {
        $this->_registry = $_registry;
    }

    /**
     * @param string $name
     * @param object $value
     * @return boolean
     */
    public function set(string $name, $value): bool
    {
        if (!empty($name) && $this->isObject($value)) {
            $this->_registry->set($name, $value);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $name
     * @return object|null
     */
    public function get(string $name)
    {
        return $this->_registry->get($name);
    }

    /**
     * @param string $name
     * @return object
     * @throws Exception
     */
    public function register(string $name)
    {
        if (!$this->_registry->isAdded($name) && $this->classExists($name)) {
            $this->set($name, new $name);
        }

        return $this->get($name);
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function remove(string $name): bool
    {
        return $this->_registry->remove($name);
    }

    /**
     * @param string $name
     * @return boolean
     * @throws Exception
     */
    public function reload(string $name): bool
    {
        if ($this->_registry->isAdded($name)) {
            $className = get_class($this->get($name));
            return $this->set($name, new $className);
        } else {
            throw new Exception("Class '$name' not registered");
        }
    }

    /**
     * @param object $value
     * @return boolean
     * @throws Exception
     */
    private function isObject($value): bool
    {
        if (is_object($value)) {
            return true;
        } else {
            throw new Exception('Object not exists');
        }
    }

    /**
     * @param string $name
     * @return boolean
     * @throws Exception
     */
    private function classExists(string $name): bool
    {
        if (class_exists($name)) {
            return true;
        } else {
            throw new Exception("Class '$name' not exists");
        }
    }
}
