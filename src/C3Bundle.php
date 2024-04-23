<?php

namespace ChapterThree\C3Bundle;

use ChapterThree\C3Bundle\DependencyInjection\C3Extension;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use \Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class C3Bundle extends AbstractBundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new C3Extension();
    }
    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}