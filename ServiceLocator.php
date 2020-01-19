<?php

class ServiceLocator
{
    private $service = [];

    private $instantiated = [];

    private $shared = [];

    public function addInstance(string $class, $service, bool $share = true)
    {
        $this->service[$class] = $service;
        $this->instantiated[$class] = $service;
        $this->shared[$class] = $share;
    }

    public function addClass(string $class, array $params, bool $share = true)
    {
        $this->service[$class] = $params;
        $this->shared[$class] = $share;
    }

    public function has(string $interface): bool
    {
        return isset($this->services[$interface]) || isset($this->instantiated[$interface]);
    }

    public function get(string $class)
    {
        if (isset($this->instantiated[$class]) && $this->shared[$class]) {
            return $this->instantiated[$class];
        }

        $args = $this->service[$class];
        switch (count($args)) {
            case 0:
                $object = new $class();
                break;
            case 1:
                $object = new $class($args[0]);
                break;
            case 2:
                $object = new $class($args[0], $args[1]);
                break;
            case 3:
                $object = new $class($args[0], $args[1], $args[2]);
                break;
            default:
                die('Too many arguments!');
        }
        if ($this->shared[$class]) {
            $this->instantiated[$class] = $object;
        }
        return $object;
    }
}


class LogService
{

}