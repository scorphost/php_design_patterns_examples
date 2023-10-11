<?php

namespace structural;

interface IWorker
{
    public function closedHours($hours);

    public function countSalary(): float;
}

class WorkerOutsource implements IWorker
{
    public function __construct(private array $hours = [])
    {
    }

    public function countSalary(): float
    {
        return array_sum($this->hours) * 500;
    }

    public function closedHours($hours): void
    {
        $this->hours[] = $hours;
    }
}

class WorkerProxy extends WorkerOutsource implements IWorker
{
    private float $salary = 0;

    public function countSalary(): float
    {
        if (!$this->salary) {
            $this->salary = parent::countSalary();
        }
        return $this->salary;
    }
}

$workerProxy = new WorkerProxy;
$workerProxy->closedHours(8);

var_dump($workerProxy->countSalary());