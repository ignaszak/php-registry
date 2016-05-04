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

use Ignaszak\Registry\RegistryException;

/**
 *
 * @author Tomasz Ignaszak <tomek.ignaszak@gmail.com>
 *
 */
abstract class IRegistry
{

    /**
     *
     * @var mixed[]
     */
    protected $registryArray = [];

    /**
     *
     * @param string $name
     * @param unknown $value
     * @return IRegistry
     */
    public function set(string $name, $value): IRegistry
    {
        $this->registryArray[$name] = $value;

        return $this;
    }

    /**
     *
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->registryArray[$name] ?? null;
    }

    /**
     *
     * @param string $className
     * @throws RegistryException
     * @return mixed
     */
    public function register(string $className)
    {
        if ($this->has($className)) {
            return $this->registryArray[$className];
        } elseif (class_exists($className)) {
            return $this->registryArray[$className] = new $className();
        } else {
            throw new RegistryException("Class '{$className}' not exists");
        }
    }

    /**
     *
     * @param string $name
     * @return IRegistry
     */
    public function remove(string $name): IRegistry
    {
        if ($this->has($name)) {
            unset($this->registryArray[$name]);
        }

        return $this;
    }

    /**
     *
     * @param string $name
     * @throws RegistryException
     * @return mixed
     */
    public function reload(string $name)
    {
        if ($this->has($name)) {
            if (is_object($this->registryArray[$name])) {
                $className = get_class($this->registryArray[$name]);
                return $this->registryArray[$name] = new $className();
            } else {
                throw new RegistryException("'{$name}' is not a class");
            }
        } else {
            throw new RegistryException("Class '{$name}' not registered");
        }
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->registryArray);
    }
}
