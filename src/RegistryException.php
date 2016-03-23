<?php
/**
 * phpDocumentor
 *
 * PHP Version 7.0
 *
 * @copyright 2015 Tomasz Ignaszak
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 */
declare(strict_types=1);

namespace Ignaszak\Registry;

class RegistryException extends \Exception
{

    public function __construct(string $message, int $code = 0)
    {
        parent::__construct($message, $code);
    }
}
