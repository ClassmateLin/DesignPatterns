<?php

/**
 * 创建注册表抽象类
 * Class Registry
 */
abstract class Registry
{
    const LOGGER = 'logger';

    private static $storedValues = [];

    private static $allowedKeys = [
        self::LOGGER
    ];

    public static function set(string $key, $value)
    {
        if (!in_array($key, self::$allowedKeys)) {
            die('Invalid key given!');
        }
        self::$storedValues[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function get(string $key)
    {
        if (!in_array($key, self::$allowedKeys) || !isset(self::$storedValues[$key])){
            die('Invalid Key!');
        }
        return self::$storedValues[$key];
    }
}