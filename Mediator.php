<?php




interface MediatorInterface
{
    /**
     * 发送响应
     * @param $content
     * @return mixed
     */
    public function sendResponse($content);

    /**
     * 请求
     * @return mixed
     */
    public function makeRequest();

    /**
     * 查询数据库
     * @return mixed
     */
    public function queryDb();
}

abstract class Colleague
{
    protected $mediator;

    /**
     * @param MediatorInterface $mediator
     */
    public function setMediator(MediatorInterface $mediator)
    {
        $this->mediator = $mediator;
    }
}

class Client extends Colleague
{
    public function request()
    {
        $this->mediator->makeRequest();
    }

    public function output(string $content)
    {
        echo $content . PHP_EOL;
    }
}

class Database extends Colleague
{
    public function getData(): string
    {
        return 'World';
    }
}


class Server extends Colleague
{
    public function process()
    {
        $data = $this->mediator->queryDb();
        $this->mediator->sendResponse(sprintf("Hello %s", $data));
    }
}

class Mediator implements MediatorInterface
{
    private $server;

    private $database;

    private $client;

    public function __construct(Database $database, Client $client, Server $server)
    {
        $this->database = $database;
        $this->server = $server;
        $this->client = $client;
        $this->database->setMediator($this);
        $this->database->setMediator($this);
    }

    public function makeRequest()
    {
        $this->server->process();
    }

    public function queryDb()
    {
        $this->database->getData();
    }

    public function sendResponse($content)
    {
        $this->client->output($content);
    }
}