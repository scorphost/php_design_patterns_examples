<?php

namespace behavioral;

interface IState
{
    public function toNext(Task $task): void;

    public function getStatus(): string;
}

class Task
{
    public function __construct(private IState $state)
    {
    }

    public static function make(): self
    {
        return new self(new Created);
    }

    public function getState(): IState
    {
        return $this->state;
    }

    public function setState(IState $state): void
    {
        $this->state = $state;
    }

    public function proceedToNext(): void
    {
        $this->state->toNext($this);
    }
}

class Created implements IState
{
    public function toNext(Task $task): void
    {
        $task->setState(new Process);
    }

    public function getStatus(): string
    {
        return 'Created';
    }
}

class Process implements IState
{
    public function toNext(Task $task): void
    {
        $task->setState(new Test);
    }

    public function getStatus(): string
    {
        return 'Process';
    }
}

class Test implements IState
{
    public function toNext(Task $task): void
    {
        $task->setState(new Done);
    }

    public function getStatus(): string
    {
        return 'Test';
    }
}

class Done implements IState
{
    public function toNext(Task $task): void
    {
    }

    public function getStatus(): string
    {
        return 'Done';
    }
}

$task = Task::make();
$task->proceedToNext();
var_dump($task->getState()->getStatus());
