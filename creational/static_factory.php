<?php

namespace static_factory;

interface Worker
{

    public function work(): void;
}

class Developer implements Worker
{

    public function work(): void
    {
        echo 'developer';
    }
}

class Designer implements Worker
{

    public function work(): void
    {
        echo 'designer';
    }
}


class WorkerFactory
{
    public static function make(string $ClassName): ?Worker
    {
        if (class_exists($ClassName)) {
            return new $ClassName;
        }

        return null;
    }
}

$developer = WorkerFactory::make('static_factory\Developer');

$developer->work();