<?php

namespace structural;

interface IWorker
{
    public function countSalary(): float;
}

abstract class WorkerDecorator implements IWorker
{
    public function __construct(public readonly IWorker $worker)
    {
    }
}

class Developer implements IWorker
{
    public function countSalary(): float
    {
        return 20 * 3000;
    }
}

class DeveloperOvertime extends WorkerDecorator
{
    public function countSalary(): float
    {
        return $this->worker->countSalary()
            + $this->worker->countSalary() * 0.2;
    }
}

$developer = new Developer;
$developerOvertime = new DeveloperOvertime($developer);

var_dump($developer->countSalary());
var_dump($developerOvertime->countSalary());