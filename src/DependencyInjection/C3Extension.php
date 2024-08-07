<?php

namespace ChapterThree\C3Bundle\DependencyInjection;

use Exception;
use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
//use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class C3Extension extends Extension implements PrependExtensionInterface
{
    /**
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        //$configuration = new Configuration();
        //$config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../config')
        );
        $loader->load('services.yaml');

    }

    public function prepend(ContainerBuilder $container): void
    {
        // Register the form theme if TwigBundle is available
        $bundles = $container->getParameter('kernel.bundles');

        #if (isset($bundles['FrameworkBundle'])) {
        #    $container->prependExtensionConfig('framework', ['router' => ['ChapterThree\C3Bundle\Controller\MenuController']]);
        #}
        #if (isset($bundles['TwigBundle'])) {
        #    $container->prependExtensionConfig('twig', ['form_themes' => ['@LiveComponent/form_theme.html.twig']]);
        #}
        if (isset($bundles['TwigComponentBundle'])) {
            $container->prependExtensionConfig('twig_component', ['defaults' => [
                'ChapterThree\\C3Bundle\\Twig\\Components\\' => '@C3/templates/components/']]);
        }

        if ($this->isAssetMapperAvailable($container)) {
            $container->prependExtensionConfig('framework', [
                'asset_mapper' => [
                    'paths' => [
                        __DIR__.'/../../assets' => '@C3',
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