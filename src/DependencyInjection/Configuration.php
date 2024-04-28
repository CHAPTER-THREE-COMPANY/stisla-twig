<?php

namespace ChapterThree\C3Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder(): TreeBuilder
    {
        // TODO: Implement getConfigTreeBuilder() method.
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('twig_component');

        $rootNode
            ->children()
            ->booleanNode('defaults')->defaultTrue()->end()
#            ->scalarNode('file')->defaultValue('')->end()
#            ->scalarNode('alias')->defaultValue('')->end()
#            ->scalarNode('app_id')->defaultValue('')->end()
#            ->scalarNode('secret')->defaultValue('')->end()
#            ->arrayNode('permissions')
#            ->canBeUnset()->prototype('scalar')->end()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}