<?php

namespace behavioral;

interface IDefiner
{
    public function define(int|string|bool $arg): string;
}

class Data
{
    private int|string|bool $arg;

    public function __construct(private readonly IDefiner $definer)
    {
    }

    public function setArg(bool|int|string $arg): void
    {
        $this->arg = $arg;
    }

    public function executeStrategy(): string
    {
        return $this->definer->define($this->arg);
    }
}

class IntDefiner implements IDefiner
{
    public function define(bool|int|string $arg): string
    {
        return $arg . ' from int strategy';
    }
}

class StringDefiner implements IDefiner
{
    public function define(bool|int|string $arg): string
    {
        return $arg . ' from string strategy';
    }
}

class BoolDefiner implements IDefiner
{
    public function define(bool|int|string $arg): string
    {
        return $arg . ' from bool strategy';
    }
}

$data = new Data(new IntDefiner());
$data->setArg('some arg for first');

var_dump($data->executeStrategy());

