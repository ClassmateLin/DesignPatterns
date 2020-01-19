<?php

interface LoggerInterface
{
    public function log(string $str);
}

class PrintLogger implements LoggerInterface
{
    public function log(string $str)
    {
        echo $str;
    }
}


class NullLog implements LoggerInterface
{
    public function log(string $str)
    {
       // 忽略操作　
    }
}

class Services
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function doSomething()
    {
        $this->logger->log('We are in ' .  __METHOD__);
    }
}

$service = new Services(new NullLog());
$service->doSomething();