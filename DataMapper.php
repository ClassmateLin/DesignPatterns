<?php

class User
{
    private $username;
    private $email;

    public function __construct(string $username, string $email)
    {
        // 验证参数, 也外部验证可以确保传入的参数合法
        $this->username = $username;
        $this->email = $email;
    }

    public static function fromState(array $state): User
    {
        return new self(
            $state['username'],
            $state['email']
        );
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }
}

class StorageAdapter
{
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function find(int $id)
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }
        return null;
    }
}

class UserMapper
{
    private $adapter;

    public function __construct(StorageAdapter $storage)
    {
        $this->adapter = $storage;
    }

    public function findById(int $id): User
    {
        $result = $this->adapter->find($id);

        if ($result === null){
            die("user #$id not found");
        }
        return $this->mapRowToUser($result);
    }

    public function mapRowToUser(array $row): User
    {
        return User::fromState($row);
    }
}


$storage = new StorageAdapter([1 => ['username' => 'test', 'email' => 'test@qq.com']]);
$mapper = new UserMapper($storage);
$user = $mapper->findById(1);
if ($user instanceof User){
    echo  'True';
}