<?php

namespace factory_method;

interface Worker {

    public function work();

}

class Developer implements Worker {

    public function work()
    {
        echo 'developer';
    }
}

class Designer implements Worker {

    public function work()
    {
        echo 'designer';
    }
}

interface WorkerFactory {
    public static function make();
}

class DeveloperFactory implements WorkerFactory {

    public static function make(): Developer
    {
        return new Developer;
    }
}

class DesignerFactory implements WorkerFactory {

    public static function make(): Designer
    {
        return new Designer;
    }
}

$developer = DeveloperFactory::make();
$designer = DesignerFactory::make();

$developer->work();