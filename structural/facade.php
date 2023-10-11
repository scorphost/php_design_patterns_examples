<?php

namespace structural;

class WorkerFacade
{
    public function __construct(
        private readonly Developer $developer,
        private readonly Designer  $designer
    )
    {
    }

    public function startWork(): void
    {
        $this->developer->startDevelop();
        $this->designer->startDesign();
    }

    public function stopWork(): void
    {
        $this->developer->stopDevelop();
        $this->designer->stopDesign();
    }
}

class Developer
{
    public function startDevelop(): void
    {
        echo 'start develop' . PHP_EOL;
    }

    public function stopDevelop(): void
    {
        echo 'stop develop' . PHP_EOL;
    }
}

class Designer
{
    public function startDesign(): void
    {
        echo 'start design' . PHP_EOL;
    }

    public function stopDesign(): void
    {
        echo 'stop design' . PHP_EOL;
    }
}

$developer = new Developer;
$designer = new Designer;

$workerFacade = new WorkerFacade($developer, $designer);
$workerFacade->startWork();
