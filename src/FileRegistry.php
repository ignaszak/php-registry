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
class FileRegistry extends IRegistry
{

    /**
     * @var string
     */
    private $path = __DIR__ . '/tmp';

    /**
     * @param string $name
     * @param object $value
     * @throws Exception
     */
    public function set(string $name, $value)
    {
        if (!is_dir($this->path)) {
            if (!mkdir($this->path, 0777, true))
                throw new Exception("Can't create '{$this->path}' folder");
        }

        if (is_writable($this->path)) {
            parent::set($name, $value);
            file_put_contents("{$this->path}/IgnaszakRegistry_$name.tmp", serialize($value));
        } else {
            throw new Exception("Permission denied ({$this->path})");
        }
    }

    /**
     * {@inheritDoc}
     * @see \Ignaszak\Registry\IRegistry::get($name)
     */
    public function get(string $name)
    {
        $tmpFile = "{$this->path}/IgnaszakRegistry_$name.tmp";

        if (file_exists($tmpFile)) {

            if (!$this->isAdded($name)) {
                $fileContent = file_get_contents($tmpFile);
                parent::set($name, unserialize($fileContent));
            }

            return $this->registryArray[$name];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     * @see \Ignaszak\Registry\IRegistry::remove($name)
     */
    public function remove(string $name): bool
    {
        $tmpFile = "{$this->path}/IgnaszakRegistry_$name.tmp";

        if (file_exists($tmpFile))
            unlink($tmpFile);

        return parent::remove($name);
    }

}
