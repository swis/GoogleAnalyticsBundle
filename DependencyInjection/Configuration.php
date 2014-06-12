<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('swis_google_analytics');

        $rootNode
            ->children()
            ->scalarNode('tracking_id')
                ->isRequired()
                ->cannotBeEmpty()
                ->info('The Google Analytics tracking ID (e.g. UA-xxxxxxxx-x).')
                ->end()
            ->scalarNode('domain')
                ->defaultNull()
                ->info('If set, the configured host name is sent to Google instead of the really one retrieved from the called URL.')
                ->end()
            ->booleanNode('provide_opt_out')
                ->defaultFalse()
                ->info('If set, a javascript function for opting out the Google tracking is provided. The function\'s name then is googleOptOut().')
                ->end()
            ->integerNode('site_speed_sample_rate')
                ->min(0)->max(100)
                ->defaultValue(100)
                ->info('Defines the site speed sample rate. See https://developers.google.com/analytics/devguides/collection/analyticsjs/field-reference#siteSpeedSampleRate for details.')
                ->end()
            ->booleanNode('anonymize_ip')
                ->defaultTrue()
                ->info('Triggers the IP anonymization for privacy reasons. Required in some countries to be true.')
                ->end()
            ->booleanNode('enable_displayfeatures')
                ->defaultTrue()
                ->info('Enables the Google Analytics display features. See https://developers.google.com/analytics/devguides/collection/analyticsjs/display-features for details.')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
