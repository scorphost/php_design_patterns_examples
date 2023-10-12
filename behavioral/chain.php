<?php

namespace behavioral;

interface ITask
{
    public function getArray(): ?array;
}

abstract class Handler
{
    public function __construct(private readonly ?Handler $successor)
    {
    }

    final public function handle(ITask $task): ?array
    {
        $proceed = $this->processing($task);
        if (!isset($proceed) && $this->successor) {
            $proceed = $this->successor->handle($task);
        }

        return $proceed;
    }

    abstract public function processing(ITask $task): ?array;
}

class DevTask implements ITask
{
    public function __construct(private array $arr = [1, 2, 3])
    {
    }

    public function getArray(): array
    {
        return $this->arr;
    }
}

class Junior extends Handler
{
    public function processing(ITask $task): ?array
    {
        return null;
    }
}

class Middle extends Handler
{
    public function processing(ITask $task): ?array
    {
        return null;
    }
}

class Senior extends Handler
{
    public function processing(ITask $task): array
    {
        return $task->getArray();
    }
}

$task = new DevTask;

$senior = new Senior(null);
$middle = new Middle($senior);
$junior = new Junior($middle);

var_dump($junior->handle($task));