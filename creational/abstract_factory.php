<?php

interface IAbstractFactory
{
    public static function makeDeveloperWorker(): IDeveloperWorker;

    public static function makeDesignerWorker(): IDesignerWorker;
}

interface IWorker
{
    public function work(): void;
}

interface IDeveloperWorker extends IWorker
{

}

interface IDesignerWorker extends IWorker
{
}

class OutsourceWorkerFactory implements IAbstractFactory
{

    public static function makeDeveloperWorker(): IDeveloperWorker
    {
        return new OutsourceDeveloperWorker;
    }

    public static function makeDesignerWorker(): IDesignerWorker
    {
        return new OutsourceDesignerWorker;
    }
}

class NativeWorkerFactory implements IAbstractFactory
{

    public static function makeDeveloperWorker(): IDeveloperWorker
    {
        return new NativeDeveloperWorker;
    }

    public static function makeDesignerWorker(): IDesignerWorker
    {
        return new NativeDesignerWorker;
    }
}

class NativeDeveloperWorker implements IDeveloperWorker
{
    public function work(): void
    {
        echo __METHOD__;
    }
}

class OutsourceDeveloperWorker implements IDeveloperWorker
{
    public function work(): void
    {
        echo __METHOD__;
    }
}

class NativeDesignerWorker implements IDesignerWorker
{
    public function work(): void
    {
        echo __METHOD__;
    }
}

class OutsourceDesignerWorker implements IDesignerWorker
{
    public function work(): void
    {
        echo __METHOD__;
    }
}

$nativeDeveloper = NativeWorkerFactory::makeDeveloperWorker();
$outsourceDeveloper = OutsourceWorkerFactory::makeDeveloperWorker();

$nativeDesigner = NativeWorkerFactory::makeDesignerWorker();
$outsourceDesigner = OutsourceWorkerFactory::makeDesignerWorker();

$nativeDeveloper->work();