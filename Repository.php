<?php

/**
 * 文章
 * Class Post
 */
class Post
{
    private $id;

    private $title;

    private $text;

    public static function fromState(array $state): Post
    {
        return new self(
            $state['id'],
            $state['title'],
            $state['text']
        );
    }

    public function __construct($id, string $title, string $text)
    {
        $this->id = $id;
        $this->text = $text;
        $this->title = $title;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return  $this->text;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}

class MemoryStorage
{
    private $data = [];

    private $lastId = 0;

    public function persist(array $data): int
    {
        $this->lastId++;
        $data['id'] = $this->lastId;
        $this->data[$this->lastId] = $data;
        return  $this->lastId;
    }

    public function retrieve(int $id): array
    {
        if (!isset($this->data[$id])) {
            die('No data found!');
        }
        return $this->data[$id];
    }

    public function delete(int $id)
    {
        if (!isset($this->data[$id])) {
            die('No data found!');
        }
        unset($this->data);
    }
}

class PostRepository
{
    private $persistence;

    public function __construct(MemoryStorage $persistence)
    {
        $this->persistence = $persistence;
    }

    public function findById(int $id): Post
    {
        $arrayData = $this->persistence->retrieve($id);
        if (is_null($arrayData)) {
            die('Post not exists!');
        }
        return Post::fromState($arrayData);
    }

    public function save(Post $post)
    {
        $id = $this->persistence->persist(([
            'text' => $post->getText(),
            'title' => $post->getTitle()
        ]));
        $post->setId($id);
    }
}
