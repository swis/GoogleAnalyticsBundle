<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Twig;

use Swis\Bundle\GoogleAnalyticsBundle\Service\AnalyticsHandler;
use Swis\Bundle\GoogleAnalyticsBundle\Service\TestHandler;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class GoogleAnalyticsExtension extends \Twig_Extension
{

    /** @var \Twig_Environment */
    protected $environment;

    /** @var array */
    protected $config;

    /** @var \Symfony\Bundle\FrameworkBundle\Routing\Router */
    protected $router;

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
     * @param array $config The bundle config array
     */
    public function __construct(Router $router, $config)
    {
        $this->config = $config;
        $this->router = $router;
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('route_exists', array($this, 'routeExists'))
        );
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
                'analytics_flashbag_name' => AnalyticsHandler::FLASHBAG_NAME,
                'test_flashbag_name' => TestHandler::FLASHBAG_NAME,
                'error' => $error
            )
        );
    }

    function routeExists($name)
    {
        return (null === $this->router->getRouteCollection()->get($name)) ? false : true;
    }

    public function getName()
    {
        return 'swis_google_analytics_extension';
    }
}
