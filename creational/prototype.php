<?php

namespace creational;

abstract class AWorkerPrototype
{
    protected string $name;
    protected string $position;

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

class Developer extends AWorkerPrototype {
    protected string $position = 'Developer';
}
class Designer extends AWorkerPrototype {
    protected string $position = 'Designer';
}

$developer1 = new Developer;
$developer2 = clone $developer1;
$developer2->setName('Laura');

var_dump($developer2->getName());