<?php

namespace structural;

interface IFormatter
{
    public function format($str): string;
}

class SimpleText implements IFormatter
{

    public function format($str): string
    {
        return $str;
    }
}

class HTMLText implements IFormatter
{

    public function format($str): string
    {
        return "<p>$str</p>";
    }
}

abstract class BridgeService
{
    public function __construct(public readonly IFormatter $formatter)
    {
    }

    abstract public function getFormatter($str): string;
}

class SimpleTextService extends BridgeService
{
    public function getFormatter($str): string
    {
        return $this->formatter->format($str);
    }
}

class HTMLTextService extends BridgeService
{
    public function getFormatter($str): string
    {
        return $this->formatter->format($str);
    }
}

$simpleText = new SimpleText;
$htmlText = new HTMLText;

$simpleTextService = new SimpleTextService($simpleText);
$htmlTextService = new HTMLTextService($htmlText);

var_dump($htmlTextService->getFormatter('Hello'));