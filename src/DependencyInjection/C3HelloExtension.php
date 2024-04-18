<?php
// src/DependencyInjection/AcmeHelloExtension.php
namespace ChapterThree\StislaTwigBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class C3HelloExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        // ... you'll load the files here later
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../config')
        );
        $loader->load('services.xml');
    }
}