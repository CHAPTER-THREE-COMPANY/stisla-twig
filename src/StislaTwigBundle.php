<?php

namespace ChapterThree\StislaTwigBundle;

use ChapterThree\StislaTwigBundle\DependencyInjection\C3HelloExtension;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use \Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class StislaTwigBundle extends AbstractBundle
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