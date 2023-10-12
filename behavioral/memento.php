<?php

namespace behavioral;

class Memento
{
    public function __construct(private readonly State $state)
    {
    }

    public function getState(): State
    {
        return $this->state;
    }
}

class State
{
    public const CREATED = 'created';
    public const PROCESS = 'process';
    public const TEST = 'test';
    public const DONE = 'done';

    public function __construct(private string $state)
    {
    }

    public function __toString(): string
    {
        return $this->state;
    }
}

class Worker
{

}

class Task
{

}