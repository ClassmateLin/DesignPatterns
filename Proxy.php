<?php

class Record
{
    private $data;


    /**
     * Record constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function __set(string $name, string $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param string $name
     * @return string
     */
    public function __get(string $name): string
    {
        if (!isset($this->data[$name])) {
            die('Invalid name');
        }
        return $this->data[$name];
    }
}


class RecordProxy extends Record
{
    private $isDirty = false;

    private $isInitialized = false;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (count($data) > 0) {
            $this->isInitialized = true;
            $this->isDirty = true;
        }
    }

    public function __set(string $name, string $value)
    {
        $this->isDirty = true;
        parent::__set($name, $value);
    }

    public function isDirty(): bool
    {
        return $this->isDirty();
    }
}

$data = [];
$proxy = new RecordProxy($data);
$proxy->xyz = 'wocao';
echo $proxy->xyz;