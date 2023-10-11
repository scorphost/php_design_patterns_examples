<?php

namespace structural;

class Worker
{
    private string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make($args): Worker
    {
        return new self($args['name']);
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class WorkerMapper
{
    public function __construct(private readonly WorkerStorageAdapter $workerStorageAdapter)
    {
    }

    public function findById($id): false|Worker
    {
        $res = $this->workerStorageAdapter->find($id);
        if (!isset($res)) {
            return false;
        }

        return $this->make($res);
    }

    private function make($args): Worker
    {
        return Worker::make($args);
    }
}

class WorkerStorageAdapter
{
    private array $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function find($id)
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }

        return null;
    }
}

$data = [
    1 => [
        'name' => 'Laura'
    ],
    2 => [
        'name' => 'Adaya'
    ],
];
$workerStorageAdapter = new WorkerStorageAdapter($data);
$workerMapper = new WorkerMapper($workerStorageAdapter);

$worker = $workerMapper->findById(1);
var_dump($worker->getName());