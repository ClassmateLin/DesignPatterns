<?php

/**
 *
 * Class BookPrototype
 */
abstract class BookPrototype
{
    protected $title;

    protected $category;

    abstract public function __clone();

    public function getTitle():string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}


class BarBookPrototype extends BookPrototype
{
    protected $category = 'Bar';

    public function __clone()
    {
    }
}

class FooBookPrototype extends BookPrototype
{
    protected $category = 'Foo';

    public function __clone()
    {
    }
}

$fooPrototype = new FooBookPrototype();

for ($i = 0; $i < 10; $i++)
{
    $book = clone $fooPrototype;
    $book->setTitle('Bar Book No: ' . $i);
    if ($book instanceof FooBookPrototype){
        echo $book->getTitle() . ' is FooBookPrototype' . PHP_EOL;
    }
}

$barPrototype = new BarBookPrototype();
for ($i = 0; $i < 10; $i++)
{
    $book = clone $barPrototype;
    $book->setTitle('Bar Book No: ' . $i);
    if ($book instanceof BarBookPrototype){
        echo $book->getTitle() . ' is BarBookPrototype' . PHP_EOL;
    }
}
