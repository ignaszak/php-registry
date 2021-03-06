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
use Ignaszak\Registry\RegistryException;

/**
 *
 * @author Tomasz Ignaszak <tomek.ignaszak@gmail.com>
 *
 */
class FileRegistry extends IRegistry
{

    /**
     *
     * {@inheritDoc}
     * @see \Ignaszak\Registry\Scope\IRegistry::set($name, $value)
     */
    public function set(string $name, $value): IRegistry
    {
        // Check if file is exists
        if (is_object($this->get($name))) {
            parent::set($name, $this->get($name));
        } else {
            // If not create new file
            if (! is_dir(Conf::getTmpPath()) &&
                ! @mkdir(Conf::getTmpPath(), 0777, true)) {
                throw new RegistryException(
                    "Can't create '" . Conf::getTmpPath() . "' folder"
                );
            }

            if (is_writable(Conf::getTmpPath())) {
                parent::set($name, $value);
                file_put_contents(
                    Conf::getTmpPath() . "/IgnaszakRegistry_{$name}.tmp",
                    serialize($value)
                );
            } else {
                throw new RegistryException(
                    "Permission denied (" . Conf::getTmpPath() . ")"
                );
            }
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     * @see \Ignaszak\Registry\IRegistry::get($name)
     */
    public function get(string $name)
    {
        $tmpFile = Conf::getTmpPath() . "/IgnaszakRegistry_{$name}.tmp";

        if (file_exists($tmpFile)) {
            if (!$this->has($name)) {
                $fileContent = file_get_contents($tmpFile);
                $this->registryArray[$name] = unserialize($fileContent);
            }

            return $this->registryArray[$name];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     * @see \Ignaszak\Registry\IRegistry::remove($name)
     */
    public function remove(string $name): IRegistry
    {
        $tmpFile = Conf::getTmpPath() . "/IgnaszakRegistry_{$name}.tmp";

        if (file_exists($tmpFile)) {
            unlink($tmpFile);
        }

        return parent::remove($name);
    }
}
