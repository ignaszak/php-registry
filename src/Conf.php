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

/**
 *
 * @author Tomasz Ignaszak <tomek.ignaszak@gmail.com>
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
     * @var string
     */
    private static $cookiePath = '/';

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

    /**
     * @return string
     */
    public static function getCookiePath(): string
    {
        return self::$cookiePath;
    }

    /**
     * @param string $cookiePath
     */
    public static function setCookiePath(string $cookiePath)
    {
        self::$cookiePath = $cookiePath;
    }
}
