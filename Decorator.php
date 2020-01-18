<?php

interface RenderablesInterface
{
    public function renderData():string;
}

/**
 * Class Webservice
 */
class Webservice implements RenderablesInterface
{
    private $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function renderData(): string
    {
        return $this->data;
    }
}

/**
 * 装饰抽象类
 * Class RendererDecorator
 */
abstract class RendererDecorator implements RenderablesInterface
{
    protected $wrapper;

    public function __construct(RenderablesInterface $renderer)
    {
        $this->wrapper = $renderer;
    }
}

/**
 * xml渲染
 * Class XmlRenderer
 */
class XmlRenderer extends RendererDecorator
{
    public function renderData(): string
    {
        $doc = new DOMDocument();
        $data = $this->wrapper->renderData();
        $doc->appendChild($doc->createElement('content', $data));
        return  $doc->saveXML();
    }
}


/**
 * json渲染
 * Class JsonRenderer
 */
class JsonRenderer extends RendererDecorator
{
    public function renderData(): string
    {
        return json_encode($this->wrapper->renderData());
    }
}

$service = new Webservice('Hello World');
$service = new XmlRenderer($service);
$service->renderData();

$service = new JsonRenderer($service);
$service->renderData();