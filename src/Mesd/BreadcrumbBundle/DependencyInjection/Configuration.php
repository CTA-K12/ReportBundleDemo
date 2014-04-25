<?php

namespace Mesd\BreadcrumbBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mesd_breadcrumb');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->enumNode('placeholder')
                    ->values(array('before', 'after'))
                    ->defaultValue('before')
                ->end()
                ->scalarNode('separator')
                    ->defaultValue('&rarr;')
                ->end()
                ->scalarNode('homeLabel')
                    ->defaultValue('<span class="fa fa-home"></span>')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
