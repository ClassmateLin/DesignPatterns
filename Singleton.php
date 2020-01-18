<?php


final class Singleton
{
    private static $instance;

    public static function getInstance(): Singleton
    {
        if (null == static::$instance){
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * 不允许从外部调用以防止创建多个实例
     * 要使用单例，必须通过 Singleton::getInstance() 方法获取实例
     */
    public function __construct()
    {
    }

    /**
     * 防止实例被克隆（这会创建实例的副本）
     */
    public function __clone()
    {
    }

    /**
     * 防止反序列化（这将创建它的副本）
     */
    public function __wakeup()
    {
    }
}

$firstCall = Singleton::getInstance();
$secondCall = Singleton::getInstance();
if ($firstCall === $secondCall) {
    echo '同个实例' . PHP_EOL;
}
