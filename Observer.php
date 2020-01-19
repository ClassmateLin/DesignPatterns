<?php
/**
 * PHP 已经定义了 2 个接口用于快速实现观察者模式：SplObserver 和 SplSubject。
 */


/**
 * 当对象发生变化时通知 User
 * Class User
 */
class User implements SplSubject
{
    private $email;

    private $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function changeEmail(string $email)
    {
        $this->email = $email;
        $this->notify();
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}


class UserObserver implements SplObserver
{
    private $changedUsers = [];

    public function update(SplSubject $subject)
    {
       $this->changedUsers[] = clone $subject;
    }

    public function getChangedUsers(): array
    {
        return $this->changedUsers;
    }
}

$observer = new UserObserver();
$user = new User();
$user->attach($observer);
$user->changeEmail('test@qq.com');
var_dump($observer->getChangedUsers());