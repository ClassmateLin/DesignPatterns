<?php

/**
 * spl_object_hash: 函数为指定对象返回一个唯一标识符。这个标识符可用于作为保存对象或区分不同对象的hash key,
 *      对于每个对象它都是唯一的，并且对同一个对象它总是相同。
 */

/**
 * Class StringReverseWorker
 *
 *
 */
class StringReverseWorker
{
    private $createAt;

    public function __construct()
    {
        $this->createAt = new DateTime();
    }

    public function run(string $text)
    {
        return strrev($text);
    }
}

/**
 * worker对象池, 实现接口Countable可用于count函数
 * Class WorkerPool
 */
class WorkerPool implements Countable
{

    private $occupiedWorkers = []; // 使用中对象

    private $freeWorkers = []; // 空闲对象

    public function get(): StringReverseWorker
    {
        if (count($this->freeWorkers) == 0){
            $worker = new StringReverseWorker();
        }else {
            $worker = array_pop($this->freeWorkers);
        }
        $this->occupiedWorkers[spl_object_hash($worker)] = $worker;
        return $worker;
    }

    public function dispose(StringReverseWorker $worker)
    {
        $key = spl_object_hash($worker);
        if (isset($this->occupiedWorkers[$key])){
            unset($this->occupiedWorkers[$key]);
            $this->freeWorkers[$key] = $worker;
        }
    }

    public function count(): int
    {
        return count($this->occupiedWorkers) + count($this->freeWorkers);
    }
}


$pool = new WorkerPool();
$worker1 = $pool->get();
$worker2 = $pool->get();
echo '对象池元素: ' . count($pool) . PHP_EOL;
if ($worker1 !== $worker2){
    echo '两个不同的对象' .PHP_EOL;
}
$pool->dispose($worker1);
echo '释放worker1' . PHP_EOL;
echo '对象池元素: ' . count($pool) . PHP_EOL;
if ($worker1 !== $worker2){
    echo '两个不同的对象' . PHP_EOL;
}