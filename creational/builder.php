<?php

namespace creational;

interface IBuilder
{
    public function makeHeader(): self;

    public function makeBody(): self;

    public function makeFooter(): self;

    public function makeCustom(): self;

    public function getText(): Message;
}

class Operator
{
    public function make(IBuilder $builder): Message
    {
        return $builder->makeHeader()
            ->makeBody()
            ->makeCustom()
            ->makeFooter()
            ->getText();
    }
}

class TextBuilder implements IBuilder
{
    private Message $message;

    public function make(): Message
    {
        return $this->message = new Message;
    }

    public function makeHeader(): self
    {
        $this->message->setPart(new Header('Header line'));
        return $this;
    }

    public function makeBody(): self
    {
        $this->message->setPart(new Body('Body line'));
        return $this;
    }

    public function makeFooter(): self
    {
        $this->message->setPart(new Footer('Footer line'));
        return $this;
    }

    public function makeCustom(): self
    {
        $this->message->setPart(new Custom('Custom line'));
        return $this;
    }

    public function getText(): Message
    {
        return $this->message;
    }
}

class Section
{
    private string $text;

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function __toString(): string
    {
        return $this->text;
    }

}

class Header extends Section
{

}

class Body extends Section
{

}

class Footer extends Section
{

}

class Custom extends Section
{

}

class Message
{
    private string $text = '';

    public function setPart(string $part): void
    {
        $this->text .= $part . PHP_EOL;
    }

    public function getText(): string
    {
        return $this->text;
    }
}

$operator = new Operator;
$builder = new TextBuilder;
$builder->make();
$message = $operator->make($builder);

var_dump($message->getText());