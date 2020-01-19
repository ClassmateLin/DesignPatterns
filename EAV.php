<?php

class Entity
{
    private $values;

    private $name;

    public function __construct(string $name, $values)
    {
        $this->values = new SplObjectStorage();
        $this->name = $name;

        foreach ($values as $value) {
            $this->values->attach($value);
        }
    }

    public function toString(): string
    {
        $text = [$this->name];

        foreach ($this->values as $value)
        {
            $text[] = (string)$value;
        }
        return join(', ', $text);
    }
}


class Values
{
    private $attribute;

    private $name;

    public function __construct(Attribute $attribute, string $name)
    {
        $this->name = $name;
        $this->attribute = $attribute;
        $attribute->addValue($this);
    }

    public function __toString()
    {
        return sprintf('%s: %s', $this->attribute, $this->name);
    }
}

class Attribute
{
    private $values;

    private $name;

    public function __construct(string $name)
    {
        $this->values = new SplObjectStorage();
        $this->name = $name;
    }

    public function addValue(Values $value)
    {
        $this->values->attach($value);
    }

    public function getValues(): SplObjectStorage
    {
        return $this->values;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}