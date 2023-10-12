<?php

namespace behavioral;

class WorkerList
{
    private int $index = 0;

    public function __construct(private array $list = [])
    {
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    public function getList(): array
    {
        return $this->list;
    }

    public function setList(array $list): void
    {
        $this->list = $list;
    }

    public function getItem($key): ?Worker
    {
        if ($this->list[$key]) {
            return $key;
        }

        return null;
    }

    public function next(): void
    {
        if ($this->index < count($this->list) - 1) {
            $this->index++;
        }
    }

    public function prev(): void
    {
        if ($this->index) {
            $this->index--;
        }
    }

    public function getByIndex(): Worker
    {
        return $this->list[$this->index];
    }

    public function refresh(): void
    {
        $this->index = 0;
    }
}

class Worker
{
    public function __construct(private readonly string $name = '')
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}

$worker1 = new Worker('Laura');
$worker2 = new Worker('Adaya');
$worker3 = new Worker('Kate');

$workerList = new WorkerList;
$workerList->setList([$worker1, $worker2, $worker3]);
$workerList->next();

var_dump($workerList->getByIndex()->getName());
