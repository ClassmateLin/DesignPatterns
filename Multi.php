<?php

/**
 * 多例模式
 * Class Multi
 */
final class Multi
{
    private static $instances = [];

    // 构造方法私有化，禁止用户创建实例
    private function __construct()
    {
    }

    // 禁止对象克隆
    private function __clone()
    {
    }

    // 阻止实例被序列化
    private function __wakeup()
    {
    }

    public static function getInstance(string $instanceName): Multi
    {
        if (!isset(self::$instances[$instanceName])){
            self::$instances[$instanceName] = new self();
        }
        return self::$instances[$instanceName];
    }
}