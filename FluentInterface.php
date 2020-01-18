<?php

class Sql
{
    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var array
     */
    private $from = [];

    /**
     * @var array
     */
    private $where = [];

    public function select(array $fields): Sql
    {
        $this->fields = $fields;
        return $this;
    }

    public function from(string $table, string $alias)
    {
        $this->from[] = $table . ' AS ' . $alias;
        return $this;
    }

    public function where(string $condition): Sql
    {
        $this->where[] = $condition;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s',
            join(', ', $this->fields),
            join(', ', $this->from),
            join(' AND ', $this->where)
        );
    }
}


$query = new Sql();
$query->select(['foo', 'bar'])->from('foobar', 'f')->where('f.bar = ?');
echo $query;