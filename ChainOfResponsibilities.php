<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class Handler
{
    /**
     * 定义继承处理器
     * @var Handler|null
     */
    private $successor = null;

    /**
     * Handler constructor.
     * @param Handler|null $handler
     */
    public function __construct(Handler $handler=null)
    {
        $this->successor = $handler;
    }

    abstract protected function processing(RequestInterface $request);

    /**
     *  通过使用模板方法模式这种方法可以确保每个子类不会忽略调用继承。
     * @param RequestInterface $request
     */
    final public function handle(RequestInterface $request)
    {
        $processed = $this->processing($request);
        if ($processed == null){ // 请求尚未处理会传递到下一个处理器
            if ($this->successor !== null){
                $processed = $this->successor->handle($request);
            }
        }
        return $processed;
    }
}


/**
 * 创建http缓存类
 * Class HttpInMemoryCacheHandler
 */
class HttpInMemoryCacheHandler extends Handler
{
    private $data;


    public function __construct(array $data, Handler $successor = null)
    {
        parent::__construct($successor);
        $this->data = $data;
    }

    protected function processing(RequestInterface $request)
    {
        $key = sprintf(
            '%s?%s',
            $request->getUri()->getPath(),
            $request->getUri()->getQuery()
        );
        if ($request->getMethod() == 'GET' && isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }
}


/**
 * 创建数据库处理器
 * Class SlowDatabaseHandler
 */
class SlowDatabaseHandler extends Handler
{
    protected function processing(RequestInterface $request)
    {
        sleep(1); // 数据库慢查询
        return 'Hello World!';

    }
}