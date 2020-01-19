<?php

abstract class StateOrder
{
    private $details;

    protected static $state;

    abstract protected function done();

    protected function setStatus(string $status)
    {
        $this->details['status'] = $status;
        $this->details['updatedTime'] = time();
    }

    protected function getStatus(): string
    {
        return $this->details['status'];
    }
}

class ShippingOrder extends StateOrder
{
    public function __construct()
    {
        $this->setStatus('shipping');
    }

    public function done()
    {
        $this->setStatus('completed');
    }
}

class CreateOrder extends StateOrder
{
    public function __construct()
    {
        $this->setStatus('created');
    }

    public function done()
    {
        static::$state = new ShippingOrder();
    }
}

class ContextOrder extends StateOrder
{
    public function getState(): StateOrder
    {
        return static::$state;
    }

    public function done()
    {
        static::$state->done();
    }

    public function getStatus(): string
    {
        return static::$state->getStatus();
    }
}