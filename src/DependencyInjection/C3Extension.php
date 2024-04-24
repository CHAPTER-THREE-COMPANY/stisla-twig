<?php

namespace ChapterThree\C3Bundle\DependencyInjection;

use Symfony\Component\AssetMapper\AssetMapperInterface;
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

        dump("Start1");
        if ($this->isAssetMapperAvailable($container)) {
            dump("Start2");
            $container->prependExtensionConfig('framework', [
                'asset_mapper' => [
                    'paths' => [
                        __DIR__.'/../../assets' => '@C3/assets',
                    ],
                ],
            ]);
        }
    }

    private function isAssetMapperAvailable(ContainerBuilder $container): bool
    {
        if (!interface_exists(AssetMapperInterface::class)) {
            return false;
        }

        // check that FrameworkBundle 6.3 or higher is installed
        $bundlesMetadata = $container->getParameter('kernel.bundles_metadata');
        if (!isset($bundlesMetadata['FrameworkBundle'])) {
            return false;
        }

        return is_file($bundlesMetadata['FrameworkBundle']['path'].'/Resources/config/asset_mapper.php');
    }
}