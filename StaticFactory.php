<?php
interface FormatterInterface
{
}

class FormatString implements FormatterInterface
{

}

class FormatNumber implements FormatterInterface
{

}

/**
 * Class StaticFactory
 */
final class StaticFactory
{
    public static function factory(string $type): FormatterInterface
    {
        if ($type == 'number') {
            return new FormatNumber();
        }elseif ($type == 'string') {
            return new FormatString();
        }
        else{
            die('type error!');
        }
    }
}

$number_formatter = StaticFactory::factory('number');
var_dump($number_formatter);

$string_formatter = StaticFactory::factory('string');
var_dump($string_formatter);