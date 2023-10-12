<?php

namespace behavioral;

interface IWorker
{
    public function work();
}

class ObjectManager
{
    public function __construct(private readonly IWorker $worker)
    {
    }

    public function goWork(): void
    {
        $this->worker->work();
    }
}

class Developer implements IWorker
{
    public function work(): void
    {
        echo 'Developer at work!';
    }
}

class NullWorker implements IWorker
{
    public function work()
    {
    }
}

$developer = new Developer;
$nullWorker = new NullWorker;

$objectManager1 = new ObjectManager($developer);
$objectManager2 = new ObjectManager($nullWorker);

$objectManager1->goWork();
$objectManager2->goWork();