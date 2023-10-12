<?php

namespace behavioral;

abstract class Expression
{
    abstract public function interpret(Context $context): bool|string;
}

class Context
{
    private array $workers = [];

    public function setWorker(string $worker): void
    {
        $this->workers[] = $worker;
    }

    public function lookUp($key): bool|string
    {
        if (isset($this->workers[$key])) {
            return $this->workers[$key];
        }

        return false;
    }
}

class VariableExp extends Expression
{
    public function __construct(private readonly int $key)
    {
    }

    public function interpret(Context $context): bool|string
    {
        return $context->lookUp($this->key);
    }
}

class AndExp extends Expression
{
    public function __construct(
        private readonly int $keyOne,
        private readonly int $keyTwo
    )
    {
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyOne)
            && $context->lookUp($this->keyTwo);
    }
}

class OrExp extends Expression
{
    public function __construct(
        private readonly int $keyOne,
        private readonly int $keyTwo
    )
    {
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyOne)
            || $context->lookUp($this->keyTwo);
    }
}

$context = new Context;
$context->setWorker('Laura');
$context->setWorker('Adaya');

$varExpr = new VariableExp(1);
$andExp = new AndExp(1, 3);
$orExp = new OrExp(2, 4);

var_dump($varExpr->interpret($context));
