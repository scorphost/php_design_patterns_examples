<?php

namespace singleton;
final class Connection {
    private static ?self $instance = null;

    private static string $name;

    public static function getName(): string
    {
        return self::$name;
    }

    public static function setName(string $name): void
    {
        self::$name = $name;
    }
    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __clone(): void
    {
        // TODO: Implement __clone() method.
    }

    public function __wakeup(): void
    {
        // TODO: Implement __wakeup() method.
    }
}

$connection = Connection::getInstance();
$connection::setName('Laura');

$connection2 = Connection::getInstance();

var_dump($connection2::getName());