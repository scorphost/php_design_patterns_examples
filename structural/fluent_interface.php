<?php

namespace structural;

class QueryBuilder
{
    public function __construct(
        private array $select = [],
        private array $from = [],
        private array $where = []
    )
    {
    }

    public function select(array $select): self
    {
        $this->select = $select;
        return $this;
    }

    public function from(array $from): self
    {
        $this->from = $from;
        return $this;
    }

    public function where(array $where): self
    {
        $this->where = $where;
        return $this;
    }

    public function get(): string
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s;',
            join(', ', $this->select),
            join(', ', $this->from),
            join(' AND ', $this->where),
        );
    }
}

$queryBuilder = new QueryBuilder();
$query = $queryBuilder
    ->select(['user', 'login'])
    ->from(['users'])
    ->where(['id > 0', "login != 'test'"])
    ->get();

var_dump($query);