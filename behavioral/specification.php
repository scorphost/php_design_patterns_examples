<?php

namespace behavioral;

interface ISpecification
{
    public function isNormal(Pupil $pupil): bool;
}

class Pupil
{
    public function __construct(private int $rate = 0)
    {
    }

    public function getRate(): int
    {
        return $this->rate;
    }

    public function setRate(int $rate): void
    {
        $this->rate = $rate;
    }
}

class PupilSpecification implements ISpecification
{
    public function __construct(private readonly int $needRate = 0)
    {
    }

    public function isNormal(Pupil $pupil): bool
    {
        return $this->needRate < $pupil->getRate();
    }
}

class AndSpecification implements ISpecification
{

    private array $specification;

    public function __construct(ISpecification ...$specification)
    {
        $this->specification = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        foreach ($this->specification as $specification) {
            if (!$specification->isNormal($pupil)) {
                return false;
            }
        }

        return true;
    }
}

class OrSpecification implements ISpecification
{

    private array $specification;

    public function __construct(ISpecification ...$specification)
    {
        $this->specification = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        foreach ($this->specification as $specification) {
            if ($specification->isNormal($pupil)) {
                return true;
            }
        }

        return false;
    }
}

class NotSpecification implements ISpecification
{
    public function __construct(private readonly ISpecification $specification)
    {
    }

    public function isNormal(Pupil $pupil): bool
    {
        return !$this->specification->isNormal($pupil);
    }
}

$spec1 = new PupilSpecification(5);
$spec2 = new PupilSpecification(10);

$pupil = new Pupil(8);

var_dump($spec1->isNormal($pupil));
var_dump($spec2->isNormal($pupil));

$andSpecification = new AndSpecification($spec1, $spec2);
var_dump($andSpecification->isNormal($pupil));
