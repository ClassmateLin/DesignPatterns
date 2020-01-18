<?php

/**
 * 是将一个复杂的对象的构建与它的表示分离，使
 * 得同样的构建过程可以创建不同的表示。创建者模式隐藏了复杂对象的创建过程，
 * 它把复杂对象的创建过程加以抽象，通过子类继承或者重载的方式，动态的创建具有复合属性的对象。
 */


/**
 * 车抽象类
 * Class Vehicle
 */
abstract class Vehicle
{

    private $data = [];

    public function setPart(string $key, object $value)
    {
        $this->data[$key] = $value;
    }
}

/**
 * 货车
 * Class Truck
 */
class Truck extends Vehicle
{

}

/**
 * 轿车
 * Class Car
 */
class Car extends Vehicle
{

}




/**
 * 建造者接口
 * Interface BuilderInterface
 */
interface BuilderInterface
{
    public function createVehicle();

    public function addWheel();

    public function addEngine();

    public function addDoors();

    public function getVehicle(): Vehicle;
}

/**
 * 引擎
 * Class Engine
 */
class Engine
{

}

/**
 * 门
 * Class Doors
 */
class Door
{

}

/**轮子
 * Class Wheel
 */
class Wheel
{

}


/**
 * 建造者
 * Class Director
 */
class Director
{
    public function build(BuilderInterface $builder): Vehicle
    {
        $builder->createVehicle();
        $builder->addDoors();
        $builder->addWheel();
        $builder->addEngine();
        return $builder->getVehicle();
    }
}

/**
 * Class TruckBuilder
 */
class TruckBuilder implements BuilderInterface
{
    private $truck;

    public function createVehicle()
    {
        $this->truck = new Truck();
    }

    public function getVehicle(): Vehicle
    {
        return $this->truck;
    }

    public function addDoors()
    {
        $this->truck->setPart('leftDoor', new Door());
        $this->truck->setPart('rightDoor', new Door());
    }

    public function addEngine()
    {
        $this->truck->setPart('trunkEngine', new Engine());
    }

    public function addWheel()
    {
        $this->truck->setPart('wheel1', new Wheel());
        $this->truck->setPart('wheel2', new Wheel());
        $this->truck->setPart('wheel3', new Wheel());
        $this->truck->setPart('wheel4', new Wheel());
    }
}


class CarBuilder implements BuilderInterface
{
    private $car;

    public function addDoors()
    {
        $this->car->setPart('rightDoor', new Door());
        $this->car->setPart('leftDoor', new Door());
        $this->car->setPart('trunkLid', new Door());
    }

    public function addEngine()
    {
        $this->car->setPart('engine', new Engine());
    }

    public function addWheel()
    {
        $this->car->setPart('wheelLF', new Wheel());
        $this->car->setPart('wheelRF', new Wheel());
        $this->car->setPart('wheelLR', new Wheel());
        $this->car->setPart('wheelRR', new Wheel());
    }

    public function createVehicle()
    {
        $this->car = new Car();
    }

    public function getVehicle(): Vehicle
    {
       return $this->car;
    }
}

$carBuilder = new CarBuilder();
$carVehicle = (new Director())->build($carBuilder);
if ($carVehicle instanceof Car){
    echo 'carVehicle is Car' . PHP_EOL;
}

$truckBuilder = new TruckBuilder();
$truckVehicle = (new Director())->build($truckBuilder);
if ($truckVehicle instanceof Truck){
    echo 'truckVehicle is Truck' . PHP_EOL;
}