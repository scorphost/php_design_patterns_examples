<?php

namespace structural;

interface IRenderable
{
    public function render(): string;
}

class Mail implements IRenderable
{
    private array $parts = [];

    public function render(): string
    {
        $result = '';
        /** @var IRenderable $part */
        foreach ($this->parts as $part) {
            $result .= $part->render();
        }

        return $result;
    }

    public function addPart(IRenderable $part): void
    {
        $this->parts[] = $part;
    }

}

abstract class APart
{
    private string $text;

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text . PHP_EOL;
    }
}

class Header extends APart implements IRenderable
{
    public function render(): string
    {
        return $this->getText();
    }
}

class Body extends APart implements IRenderable
{
    public function render(): string
    {
        return $this->getText();
    }
}

class Footer extends APart implements IRenderable
{
    public function render(): string
    {
        return $this->getText();
    }
}

$mail = new Mail;
$mail->addPart(new Header('Header'));
$mail->addPart(new Body('Body'));
$mail->addPart(new Footer('Footer'));

var_dump($mail->render());

