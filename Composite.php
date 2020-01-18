<?php

/**
 * Interface RenderableInterface
 */
interface RenderableInterface
{
    public function render(): string ;
}

/**
 * Class Form
 */
class Form implements RenderableInterface
{
    private $elements;

    /**
     * 遍历元素调用render方法
     * @return string
     */
    public function render(): string
    {
        $formCode = '<form>';
        foreach ($this->elements as $element) {
            $formCode .= $element->render();
        }
        $formCode .= '</form>';
        return $formCode;
    }

    public function addElement(RenderableInterface $element)
    {
        $this->elements[] = $element;
    }
}

/**
 * Class InputElement
 */
class InputElement implements RenderableInterface
{
    public function render(): string
    {
        return '<input type="text" />';
    }
}

/**
 * Class TextElement
 */
class TextElement implements RenderableInterface
{
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function render(): string
    {
        return $this->text;
    }
}

$form = new Form();
$form->addElement(new TextElement('Email: '));
$form->addElement(new InputElement());
$form->addElement(new TextElement('Password: '));
$form->addElement(new InputElement());
echo $form->render();