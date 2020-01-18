<?php

/**
 * 接收方是特定的服务,　只能是具体的实例，应该有自己的contract
 * Class Receiver
 */
class Receiver
{

    private $enableDate = false;

    private $output = [];


    public function write(string $str)
    {
        if ($this->enableDate) {
            $str .= ' ['.date('Y-m-d').']';
        }
        $this->output[] = $str;
    }

    public function getOutput(): string
    {
        return join("\n", $this->output);
    }

    public function enableDate()
    {
        $this->enableDate = true;
    }

    public function disableDate()
    {
        $this->enableDate = false;
    }
}


interface CommandInterface
{
    public function execute();
}



class HelloCommand implements CommandInterface
{
    private $output;

    /**
     *
     * HelloCommand constructor.
     * @param Receiver $console
     */
    public function __construct(Receiver $console)
    {
        $this->output = $console;
    }

    public function execute()
    {
        $this->output->write('Hello World');
    }
}


class Invoker
{
    private $command;

    public function setCommand(CommandInterface $cmd)
    {
        $this->command = $cmd;
    }

    /**
     *
     */
    public function run()
    {
        $this->command->execute();
    }
}


$invoker = new Invoker();
$receiver = new Receiver();
$invoker->setCommand(new HelloCommand($receiver));
$invoker->run();
echo $receiver->getOutput();