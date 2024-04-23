<?php

namespace ChapterThree\C3Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class C3Extension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        /*$loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../Resources')
        );
        $loader->load('services.xml');
        */
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../Resources')
        );
        $loader->load('services.yml');

/*        $container->addCompilerPass()->addAnnotatedClassesToCompile([
            // you can define the fully qualified class names...
            'Acme\\BlogBundle\\Controller\\AuthorController',
            // ... but glob patterns are also supported:
            'Acme\\BlogBundle\\Form\\**',

            // ...
        ]);*/
    }
}