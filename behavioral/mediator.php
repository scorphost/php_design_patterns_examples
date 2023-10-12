<?php

namespace behavioral;

interface IMediator
{
    public function getWorker();
}

abstract class Worker
{
    public function __construct(private readonly string $position = '')
    {
    }

    public function sayHello(): void
    {
        echo 'Hello' . PHP_EOL;
    }

    public function work(): string
    {
        return $this->position . ' is working' . PHP_EOL;
    }

}

class InfoBase
{
    public function printInfo(Worker $worker): void
    {
        echo $worker->work();
    }
}

class WorkerInfoBaseMediator implements IMediator
{

    public function __construct(
        private readonly Worker   $worker,
        private readonly InfoBase $infoBase
    )
    {
    }

    public function getWorker()
    {
        $this->infoBase->printInfo($this->worker);
    }
}

class Developer extends Worker
{
}

class Designer extends Worker
{
}

$developer = new Developer('developer middle');
$designer = new Designer('designer senior');

$infoBase = new InfoBase;

$workerInfoBaseMediator1 = new WorkerInfoBaseMediator($developer, $infoBase);
$workerInfoBaseMediator2 = new WorkerInfoBaseMediator($designer, $infoBase);

$workerInfoBaseMediator1->getWorker();
$workerInfoBaseMediator2->getWorker();