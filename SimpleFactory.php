<?php

/**
 * 它与静态工厂模式最大的区别是它不是『静态』的。因为非静态，
 * 所以你可以拥有多个不同参数的工厂，你可以为其创建子类.
 * Class Bicycle
 */
class Bicycle
{
    public function driveTo(string  $destination)
    {

    }
}

class SimpleFactory
{
    public function createBicycle(): Bicycle
    {
        return new Bicycle();
    }
}

$factory = new SimpleFactory();
$bicycle = $factory->createBicycle();
$bicycle->driveTo('Paris');