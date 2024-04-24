<?php

namespace ChapterThree\C3Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class C3Extension extends Extension implements PrependExtensionInterface
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
            //new FileLocator(__DIR__.'/../../Resources')
            new FileLocator(__DIR__.'/../../config')
        );
        $loader->load('services.yaml');
//        $loader->load('routes.yaml');

/*        $container->addCompilerPass()->addAnnotatedClassesToCompile([
            // you can define the fully qualified class names...
            'Acme\\BlogBundle\\Controller\\AuthorController',
            // ... but glob patterns are also supported:
            'Acme\\BlogBundle\\Form\\**',

            // ...
        ]);*/
    }

    public function prepend(ContainerBuilder $container)
    {
        // Register the form theme if TwigBundle is available
        $bundles = $container->getParameter('kernel.bundles');

//        if (isset($bundles['TwigBundle'])) {
//            $container->prependExtensionConfig('twig', ['form_themes' => ['@LiveComponent/form_theme.html.twig']]);
//        }

        if ($this->isAssetMapperAvailable($container)) {
            $container->prependExtensionConfig('framework', [
                'asset_mapper' => [
                    'paths' => [
                        __DIR__.'/../../assets' => '@C3/assets',
                    ],
                ],
            ]);
        }
    }
}