<?php


/**
 * 享元模式接口
 * Interface FlyweightInterface
 */
interface FlyweightInterface
{

    public function render(string $extrinsicState): string;
}

/**
 * 具体的享元实例被工厂类的方法共享。
 * Class CharacterFlyweight
 */
class CharacterFlyweight implements FlyweightInterface
{
    /**
     * 任何具体的享元对象存储的状态必须独立于其运行环境。
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $front
     * @return string
     */
    public function render(string $front): string
    {
        return sprintf('Character %s with font %s', $this->name, $front);
    }
}

/**
 * 工厂类会管理分享享元类，客户端不应该直接将他们实例化
 * Class FlyweightFactory
 */
class FlyweightFactory implements Countable
{
    /**
     *　享元特征数组
     * @var array
     */
    private $pool = [];


    /**
     * 输入字符串格式数据
     * @param string $name
     * @return CharacterFlyweight
     */
    public function get(string $name): CharacterFlyweight
    {
        if (!isset($this->pool[$name])) {
            $this->pool[$name] = new CharacterFlyweight($name);
        }
        return $this->pool[$name];
    }

    /**
     * 返回享元特征
     * @return int
     */
    public function count(): int
    {
        return count($this->pool);
    }
}