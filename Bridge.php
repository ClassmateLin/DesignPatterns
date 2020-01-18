<?php


/**
 * 创建格式化接口
 * Interface FormattersInterface
 */
interface FormattersInterface
{
    public function format(string $text);
}


/**
 *文本格式类
 * Class PlainTextFormatter
 */
class PlainTextFormatter implements FormattersInterface
{
    public function format(string $text)
    {
        return $text;
    }
}


/**
 * Html格式化
 * Class HtmlFormatter
 */
class HtmlFormatter implements FormattersInterface
{
    public function format(string $text)
    {
        return sprintf('<p>%s</p>', $text);
    }
}


/**
 * 创建抽象类Service
 * Class Service
 */
abstract class Service
{
    // 实现属性
    protected $implementation;

    public function __construct(FormattersInterface $printer)
    {
        $this->implementation = $printer;
    }


    public function setImplementation(FormattersInterface $printer)
    {
        $this->implementation = $printer;
    }

    abstract public function get();
}


class HelloWorldService extends Service
{
    public function get()
    {
        return $this->implementation->format('Hello World!');
    }
}


$service = new HelloWorldService(new PlainTextFormatter());
echo $service->get() . PHP_EOL;

$service = new HelloWorldService(new HtmlFormatter());
echo $service->get() . PHP_EOL;