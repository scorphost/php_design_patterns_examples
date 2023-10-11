<?php

namespace structural;

interface IMail
{
    public function render(): string;
}

abstract class TypeMail
{
    public function __construct(private readonly string $text)
    {
    }

    public function getText(): string
    {
        return $this->text;
    }
}

class BusinessMail extends TypeMail implements IMail
{
    public function render(): string
    {
        return $this->getText() . ' from business mail';
    }
}

class JobMail extends TypeMail implements IMail
{
    public function render(): string
    {
        return $this->getText() . ' from job mail';
    }
}

class MailFactory
{
    public function __construct(private array $pool = [])
    {
    }

    public function getMail(string $id, string $typeMail): IMail
    {
        if (!isset($this->pool[$id])) {
            $this->pool[$id] = $this->make($typeMail);
        }

        return $this->pool[$id];
    }

    private function make(string $typeMail): IMail
    {
        if ('business' == $typeMail) {
            return new BusinessMail('Busyness text');
        } else {
            return new JobMail('Job text');
        }
    }
}

$mailFactory = new MailFactory;
$mail = $mailFactory->getMail('id:13', 'business');

var_dump($mail->render());