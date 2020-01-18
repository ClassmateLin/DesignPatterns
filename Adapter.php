<?php


/**
 * Interface BookInterFace
 */
interface BookInterFace
{
    public function turnPage();

    public function open();

    public function getPage(): int;
}

/**
 * Class Book
 */
class Book implements BookInterFace
{
    private $page;

    public function open()
    {
        $this->page = 1;
    }

    public function turnPage()
    {
        $this->page++;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}

/**
 * Interface EbookInterface
 */
interface EbookInterface
{
    public function unlock();

    public function pressNext();

    public function getPage(): array ;
}


/**
 * Class EBookAdapter
 */
class EBookAdapter implements BookInterFace
{
    protected $eBook;

    public function __construct(EbookInterface $eBook)
    {
        $this->eBook = $eBook;
    }

    public function open()
    {
        $this->eBook->unlock();
    }

    public function turnPage()
    {
        $this->eBook->pressNext();
    }

    public function getPage(): int
    {
        return $this->eBook->getPage()[0];
    }
}


/**
 * Class Kindle
 */
class Kindle implements EbookInterface
{
    private $page = 1;

    private $totalPages = 100;

    /**
     * 下一页
     */
    public function pressNext()
    {
        $this->page++;
    }

    public function unlock()
    {
    }

    /**
     * 返回当前页和总页数
     * @return int[]
     */
    public function getPage(): array
    {
        return [$this->page, $this->totalPages];
    }
}


$book = new Book();
$book->open();
$book->turnPage();
var_dump($book->getPage());

$kindle = new Kindle();
$book = new EBookAdapter($kindle);
$book->open();
$book->turnPage();
var_dump($book->getPage());