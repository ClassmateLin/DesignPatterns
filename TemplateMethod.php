<?php

abstract class Journey
{
    private $thingsToDo = [];

    final public function takeATrip()
    {
        $this->thingsToDo[] = $this->buyAFlight();
        $this->thingsToDo[] = $this->takePlane();
        $this->thingsToDo[] = $this->enjoyVacation();
        $buyGift = $this->buyGift();
        if ($buyGift !== null) {
            $this->thingsToDo[] = $buyGift;
        }
        $this->thingsToDo = $this->takePlane();
    }

    /**
     * 该方法必须实现
     * @return string
     */
    abstract protected function enjoyVacation(): string;

    /**
     * 可选方法
     * @return null
     */
    protected function buyGift()
    {
        return null;
    }

    private function buyAFlight(): string
    {
        return 'Buy a flight ticket';
    }

    private function takePlane(): string
    {
        return 'Taking the plane';
    }

    public function getThingsToDo(): array
    {
        return $this->thingsToDo;
    }
}


class BeachJourney extends Journey
{
    protected function enjoyVacation(): string
    {
        return "Swimming and sun-bathing";
    }
}


class CityJourney extends Journey
{
    protected function enjoyVacation(): string
    {
        return "Eat, drink, take photos and sleep";
    }

    protected function buyGift(): string
    {
        return "buy a gift";
    }
}