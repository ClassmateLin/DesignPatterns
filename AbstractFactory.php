<?php

/**
 * 抽象工厂设计模式
 * 在不指定具体类的情况下创建一系列相关或依赖对象。
 * 通常创建的类都实现相同的接口。
 * 抽象工厂的客户并不关心这些类是如何创建的，它只是知道他们是如何一起运行的。
 */

/**
 * Interface Product
 */
interface Product
{
    public function calculatePrice(): int; // 计算价格
}


/**
 * 秒杀商品
 * Class SecKillProduct
 */
class SecKillProduct implements Product
{

    private $price;

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    /**
     * 计算价格
     * @return int
     */
    public function calculatePrice(): int
    {
        return $this->price;
    }
}


/**
 * 折扣商品
 * Class DiscountProduct
 */
class DiscountProduct implements Product
{
    private $price;
    private $discount;

    public function __construct(int $price, int $discount)
    {
        $this->price = $price;
        $this->discount = $discount;
    }

    /**
     * 计算价格
     * @return int
     */
    public function calculatePrice(): int
    {
        return $this->price - $this->discount;
    }
}


class ProductFactory
{
    const DISCOUNT = 50;

    /**
     * 创建秒杀商品
     * @param int $price
     * @return Product
     */
    public function createSecKillProduct(int $price): Product
    {
        return new SecKillProduct($price);
    }

    /**创建折扣商品
     * @param int $price
     * @return Product
     */
    public function createDiscountProduct(int $price): Product
    {
        return new DiscountProduct($price, self::DISCOUNT);
    }
}


$price = 100;
$factory = new ProductFactory();
$sec_kill_factory = $factory->createSecKillProduct($price);
echo '秒杀商品价格: ' . $sec_kill_factory->calculatePrice() . PHP_EOL;

$discount_factory = $factory->createDiscountProduct($price);
echo '折扣商品价格: ' . $discount_factory->calculatePrice();