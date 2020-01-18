<?php

interface OsInterface
{
    /**关机方法
     * @return mixed
     */
    public function halt();

    /**
     * @return string
     */
    public function getName(): string;
}

/**
 * 基础输入输出系统接口类
 * Interface BiosInterFace
 */
interface BiosInterFace
{
    /**
     * 声明执行方法
     * @return mixed
     */
    public function execute();

    /**
     * 声明等待输入密码方法
     * @return mixed
     */
    public function waitForKeyPress();

    /**
     * 声明登录方法
     * @param OsInterface $os
     * @return mixed
     */
    public function launch(OsInterface $os);

    /**
     * 声明关机方法
     * @return mixed
     */
    public function powerDown();
}


class Facade
{
    /**
     * @var OsInterface 操作系统变量
     */
    private $os;


    /**
     * @var BiosInterface
     * 定义基础输入输出系统接口变量
     */
    private $bios;


    public function __construct(BiosInterFace $bios, OsInterface $os)
    {
        $this->bios = $bios;
        $this->os = $os;
    }

    /**
     * 开机
     */
    public function turnOn()
    {
        $this->bios->execute();
        $this->bios->waitForKeyPress();
        $this->bios->launch($this->os);
    }

    /**
     * 关闭
     */
    public function turnOff()
    {
        $this->os->halt();
        $this->bios->powerDown();
    }
}