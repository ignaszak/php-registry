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
abstract class Conf
{

    /**
     * @var string
     */
    private static $tmpPath = __DIR__ . '/tmp';

    /**
     * @var integer
     */
    private static $cookieLife = 60*60*24*30;

    /**
     * @return string
     */
    public static function getTmpPath(): string
    {
        return self::$tmpPath;
    }

    /**
     * @param string $tmpPath
     * @return Conf
     */
    public static function setTmpPath(string $tmpPath)
    {
        self::$tmpPath = $tmpPath;
    }

    /**
     * @return integer
     */
    public static function getCookieLife(): int
    {
        return self::$cookieLife;
    }

    /**
     * @param integer $cookieLife
     */
    public static function setCookieLife(int $cookieLife)
    {
        self::$cookieLife = $cookieLife;
    }

}