<?php

namespace structural;

interface NativeWorker
{
    public function countSalary(): int;
}

interface OutsourceWorker
{
    public function countSalaryByHour($hours): int;
}

class NativeDeveloper implements NativeWorker
{

    public function countSalary(): int
    {
        return 3000 * 20;
    }
}

class OutsourceDeveloper implements OutsourceWorker
{
    public function countSalaryByHour($hours): int
    {
        return $hours * 500;
    }
}

class OutsourceWorkerAdapter implements NativeWorker
{
    public function __construct(private readonly OutsourceWorker $outsourceWorker)
    {
    }

    public function countSalary(): int
    {
        return $this->outsourceWorker->countSalaryByHour(80);
    }
}

$nativeDeveloper = new NativeDeveloper;
$outsourceDeveloper = new OutsourceDeveloper;

$outsourceWorkerAdapter = new OutsourceWorkerAdapter($outsourceDeveloper);

var_dump($outsourceWorkerAdapter->countSalary());

