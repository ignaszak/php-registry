<?php

declare(strict_types=1);

namespace Ignaszak\Registry;

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
