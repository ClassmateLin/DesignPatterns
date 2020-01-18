<?php


class DatabaseConfiguration
{
    /**
     * @var string 主机
     */
    private $host;

    /**
     * @var int 端口
     */
    private $port;

    /**
     * @var string 用户名
     */
    private $username;

    /**
     * @var string 密码
     */
    private $password;

    public function __construct(string $host, string $port, string $username, string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return  $this->port;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}


/**
 * 链接
 * Class DatabaseConnection
 */
class DatabaseConnection
{
    private $configuration;

    public function __construct(DatabaseConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getDsn()
    {

        return sprintf(
            '%s:%s@%s:%d',
            $this->configuration->getUsername(),
            $this->configuration->getPassword(),
            $this->configuration->getHost(),
            $this->configuration->getPort()
        );
    }
}

$config = new DatabaseConfiguration('127.0.0.1', 3306, 'root', 'root');
$connection = new DatabaseConnection($config);
echo $connection->getDsn();
