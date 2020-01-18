<?php


interface Log
{
    public function log(string $message);
}


class StdoutLogger implements Log
{
    public function log(string $message)
    {
        echo 'stdout: ' . $message . PHP_EOL;
    }
}

class FileLogger implements Log
{
    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function log(string $message)
    {
        file_put_contents($this->filePath, $message . PHP_EOL, FILE_APPEND);
    }
}


interface LoggerFactory
{
    public function createLogger(): Log;
}


class StdoutLogFactory implements LoggerFactory
{
    public function createLogger(): Log
    {
        return new StdoutLogger();
    }
}

class FileLogFactory implements LoggerFactory
{
    private $filePath;
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function createLogger(): Log
    {
        return new FileLogger($this->filePath);
    }
}


$file_log_factory = new FileLogFactory('./log.log');
$logger = $file_log_factory->createLogger();
if ($logger instanceof FileLogger){
    echo 'logger is FileLogger' . PHP_EOL;
}

$std_log_factory = new StdoutLogFactory();
$logger = $std_log_factory->createLogger();
if ($logger instanceof StdoutLogger){
    echo 'logger is StdoutLogger' . PHP_EOL;
}