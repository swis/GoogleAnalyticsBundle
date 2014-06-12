<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Twig;

use Swis\Bundle\GoogleAnalyticsBundle\Service\RequestAwareHandler;

class GoogleAnalyticsExtension extends \Twig_Extension
{

    protected $environment;
    protected $config;

    /**
     * @param array $config The bundle config array
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('swis_google_analytics', array($this, 'getGoogleAnalyticsTemplate'), array('is_safe' => array('html')))
        );
    }

    public function getGoogleAnalyticsTemplate()
    {
        $error = null;
        return $this->environment->render(
            'SwisGoogleAnalyticsBundle::tracking.html.twig',
            array(
                'config' => $this->config,
                'flashbag_name' => RequestAwareHandler::FLASHBAG_NAME,
                'error' => $error
            )
        );
        return 'Hallo Welt';
    }

    public function getName()
    {
        return 'swis_google_analytics_extension';
    }
}
