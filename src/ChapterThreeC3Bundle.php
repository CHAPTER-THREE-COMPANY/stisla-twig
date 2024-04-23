<?php

namespace ChapterThree\C3Bundle;

use ChapterThree\C3Bundle\DependencyInjection\C3HelloExtension;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use \Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class ChapterThreeC3Bundle extends AbstractBundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (!$this->extension) {
            $this->extension = new C3HelloExtension();
        }

        return $this->extension;
    }
    /*public function getPath(): string
    {
        return dirname(__DIR__);
    }*/
}