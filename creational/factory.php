<?php

namespace creational;

class Worker {
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

class WorkerFactory {
    public static function make(): Worker
    {
        return new Worker;
    }
}

$worker = WorkerFactory::make();
$worker->setName('Laura');

var_dump($worker->getName());