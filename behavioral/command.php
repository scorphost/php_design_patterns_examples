<?php

namespace behavioral;

interface ICommand
{
    public function execute();
}

interface Undoable extends ICommand
{
    public function undo();
}

class Output
{
    private bool $isEnable = true;
    private string $body = '';

    public function getBody(): string
    {
        return $this->body;
    }

    public function write(string $str): void
    {
        if ($this->isEnable) {
            $this->body = $str;
        }
    }

    public function enable(): void
    {
        $this->isEnable = true;
    }

    public function disable(): void
    {
        $this->isEnable = false;
    }

}

class Invoker
{
    private ICommand $command;

    public function setCommand(ICommand $command): void
    {
        $this->command = $command;
    }

    public function run(): void
    {
        $this->command->execute();
    }
}

class Message implements ICommand
{
    public function __construct(private readonly Output $output)
    {
    }

    public function execute(): void
    {
        $this->output->write('some string from execute');
    }
}

class ChangerStatus implements Undoable
{

    public function __construct(private readonly Output $output)
    {
    }

    public function execute(): void
    {
        $this->output->enable();
    }

    public function undo(): void
    {
        $this->output->disable();
    }
}

$output = new Output;
$invoker = new Invoker;
$message = new Message($output);
$changerStatus = new ChangerStatus($output);
$changerStatus->undo();
$changerStatus->execute();

$message->execute();

var_dump($output->getBody());